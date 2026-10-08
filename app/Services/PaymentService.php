<?php

namespace App\Services;

use App\Contracts\PaymentGatewayInterface;
use App\Models\Order;
use App\Models\Payment;
use Illuminate\Support\Facades\DB;
use InvalidArgumentException;
use Symfony\Component\HttpKernel\Exception\HttpException;

class PaymentService
{
    public function __construct(
        protected PaymentGatewayInterface $gateway,
        protected OrderService $orderService,
    ) {}

    /**
     * Get the active payment gateway instance.
     */
    public function getGateway(): PaymentGatewayInterface
    {
        return $this->gateway;
    }

    /**
     * Initialize or retrieve payment record for an order.
     */
    public function initializePayment(Order $order, ?string $paymentMethod = null): Payment
    {
        if ($order->status === 'cancelled') {
            throw new InvalidArgumentException('Tidak dapat memproses pembayaran untuk pesanan yang telah dibatalkan.');
        }

        if ($order->payment_status === 'paid') {
            return $order->payments()->where('status', 'paid')->firstOrFail();
        }

        return DB::transaction(function () use ($order, $paymentMethod) {
            $paymentResult = $this->gateway->createPayment($order, [
                'payment_method' => $paymentMethod,
            ]);

            $existingPendingPayment = $order->payments()
                ->where('status', 'pending')
                ->latest('id')
                ->first();

            if ($existingPendingPayment) {
                $existingPendingPayment->update([
                    'provider' => $this->gateway->getName(),
                    'payment_method' => $paymentResult['payment_method'] ?? $paymentMethod ?? 'midtrans_snap',
                    'transaction_reference' => $paymentResult['transaction_reference'],
                    'amount' => $order->grand_total,
                    'metadata' => array_merge($existingPendingPayment->metadata ?? [], $paymentResult['metadata'] ?? []),
                ]);

                return $existingPendingPayment->fresh();
            }

            return $order->payments()->create([
                'provider' => $this->gateway->getName(),
                'payment_method' => $paymentResult['payment_method'] ?? $paymentMethod ?? 'midtrans_snap',
                'transaction_reference' => $paymentResult['transaction_reference'],
                'amount' => $order->grand_total,
                'status' => 'pending',
                'metadata' => $paymentResult['metadata'] ?? [],
            ]);
        });
    }

    /**
     * Process incoming webhook callback from payment provider with signature verification and idempotency.
     *
     * @param  array<string, mixed>  $payload
     * @return array{status: string, payment: Payment, order: Order}
     */
    public function handleWebhook(array $payload, ?string $signature = null): array
    {
        // 1. Authenticity verification
        if (! $this->gateway->verifyWebhook($payload, $signature)) {
            throw new HttpException(400, 'Tanda tangan atau payload webhook tidak valid.');
        }

        // 2. Parse and normalize
        $parsed = $this->gateway->parseWebhook($payload);

        // 3. Find matching Order
        $order = Order::where('order_number', $parsed['order_number'])->first();
        if (! $order) {
            throw new HttpException(404, "Pesanan #{$parsed['order_number']} tidak ditemukan.");
        }

        // 4. Server-side amount verification (tolerance 1 IDR)
        if (abs((float) $parsed['amount'] - (float) $order->grand_total) > 1.0) {
            throw new HttpException(422, 'Jumlah nominal pembayaran tidak sesuai dengan total tagihan pesanan.');
        }

        // 5. Retrieve or initialize payment record
        /** @var ?Payment $payment */
        $payment = $order->payments()->latest('id')->first();
        if (! $payment) {
            $payment = $order->payments()->create([
                'provider' => $this->gateway->getName(),
                'payment_method' => $parsed['payment_method'],
                'transaction_reference' => $parsed['transaction_reference'],
                'amount' => $order->grand_total,
                'status' => 'pending',
                'metadata' => ['raw_webhook' => $payload],
            ]);
        }

        // 6. Idempotency protection: Prevent duplicate processing if payment is already marked paid
        if ($payment->status === 'paid' && $parsed['status'] === 'paid') {
            return [
                'status' => 'already_processed',
                'payment' => $payment,
                'order' => $order,
            ];
        }

        // 7. Atomic update
        return DB::transaction(function () use ($order, $payment, $parsed, $payload) {
            $updateData = [
                'status' => $parsed['status'],
                'payment_method' => $parsed['payment_method'] ?? $payment->payment_method,
                'transaction_reference' => $parsed['transaction_reference'] ?: $payment->transaction_reference,
                'metadata' => array_merge($payment->metadata ?? [], ['latest_webhook' => $payload]),
            ];

            if ($parsed['status'] === 'paid') {
                $updateData['paid_at'] = $parsed['paid_at'] ?? now();
            }

            $payment->update($updateData);

            // Update order payment status
            $order->payment_status = $parsed['status'];

            // If payment succeeded, transition order status from pending to confirmed
            if ($parsed['status'] === 'paid' && $order->status === 'pending') {
                $order = $this->orderService->transitionStatus(
                    $order,
                    'confirmed',
                    "Pembayaran lunas via {$payment->provider} ({$payment->payment_method})"
                );
            } else {
                $order->save();
            }

            return [
                'status' => 'success',
                'payment' => $payment->fresh(),
                'order' => $order->fresh(),
            ];
        });
    }
}
