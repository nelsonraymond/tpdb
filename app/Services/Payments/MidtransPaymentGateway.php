<?php

namespace App\Services\Payments;

use App\Contracts\PaymentGatewayInterface;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Support\Str;

class MidtransPaymentGateway implements PaymentGatewayInterface
{
    protected string $serverKey;

    protected string $clientKey;

    protected bool $isProduction;

    public function __construct()
    {
        $this->serverKey = (string) config('services.midtrans.server_key', '');
        $this->clientKey = (string) config('services.midtrans.client_key', '');
        $this->isProduction = (bool) config('services.midtrans.is_production', false);
    }

    public function getName(): string
    {
        return 'midtrans';
    }

    public function createPayment(Order $order, array $options = []): array
    {
        // Generate simulated or real token structure
        $transactionReference = 'TRX-' . $order->order_number . '-' . strtoupper(Str::random(6));
        $snapToken = 'SNAP-' . Str::uuid()->toString();

        $baseUrl = $this->isProduction
            ? 'https://app.midtrans.com/snap/v2/vtweb/'
            : 'https://app.sandbox.midtrans.com/snap/v2/vtweb/';

        $paymentUrl = $baseUrl . $snapToken;

        return [
            'transaction_reference' => $transactionReference,
            'payment_url' => $paymentUrl,
            'payment_method' => $options['payment_method'] ?? 'midtrans_snap',
            'metadata' => [
                'snap_token' => $snapToken,
                'client_key' => $this->clientKey,
                'is_production' => $this->isProduction,
                'customer_name' => $order->shipping_recipient_name,
                'customer_email' => $order->user?->email,
                'customer_phone' => $order->shipping_phone,
            ],
        ];
    }

    public function verifyWebhook(array $payload, ?string $signature = null): bool
    {
        $orderId = (string) ($payload['order_id'] ?? '');
        $statusCode = (string) ($payload['status_code'] ?? '');
        $grossAmount = (string) ($payload['gross_amount'] ?? '');
        $receivedSignature = $signature ?? (string) ($payload['signature_key'] ?? '');

        if ($orderId === '' || $statusCode === '' || $grossAmount === '' || $receivedSignature === '') {
            return false;
        }

        $expectedSignature = hash('sha512', $orderId . $statusCode . $grossAmount . $this->serverKey);

        return hash_equals($expectedSignature, $receivedSignature);
    }

    public function parseWebhook(array $payload): array
    {
        $transactionStatus = $payload['transaction_status'] ?? 'pending';
        $fraudStatus = $payload['fraud_status'] ?? null;

        $normalizedStatus = match ($transactionStatus) {
            'settlement' => 'paid',
            'capture' => ($fraudStatus === 'accept' || $fraudStatus === null) ? 'paid' : 'failed',
            'pending' => 'pending',
            'deny', 'cancel' => 'failed',
            'expire' => 'expired',
            'refund', 'partial_refund' => 'refunded',
            default => 'pending',
        };

        $paidAt = null;
        if ($normalizedStatus === 'paid') {
            $paidAt = isset($payload['settlement_time'])
                ? Carbon::parse($payload['settlement_time'])
                : now();
        }

        return [
            'order_number' => (string) ($payload['order_id'] ?? ''),
            'transaction_reference' => (string) ($payload['transaction_id'] ?? ($payload['order_id'] ?? '')),
            'status' => $normalizedStatus,
            'payment_method' => (string) ($payload['payment_type'] ?? 'midtrans'),
            'amount' => (float) ($payload['gross_amount'] ?? 0),
            'paid_at' => $paidAt,
            'raw' => $payload,
        ];
    }
}
