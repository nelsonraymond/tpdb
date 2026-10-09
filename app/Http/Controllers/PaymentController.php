<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Services\PaymentService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class PaymentController extends Controller
{
    public function __construct(
        protected PaymentService $paymentService,
    ) {}

    /**
     * Display customer payment page.
     */
    public function show(Order $order): View|RedirectResponse
    {
        // Enforce customer ownership authorization
        if ($order->user_id !== Auth::id()) {
            abort(403, 'Anda tidak memiliki hak akses ke pembayaran pesanan ini.');
        }

        $payment = $this->paymentService->initializePayment($order);
        $order->load(['items.variant.product', 'shipment']);

        return view('payments.show', compact('order', 'payment'));
    }

    /**
     * Handle webhook callback from payment gateway.
     */
    public function webhook(Request $request): JsonResponse
    {
        $payload = $request->all();
        $signature = $request->header('X-Signature-Key');

        $result = $this->paymentService->handleWebhook($payload, $signature);

        return response()->json([
            'status' => 'success',
            'message' => 'Webhook berhasil diproses.',
            'data' => [
                'order_number' => $result['order']->order_number,
                'order_status' => $result['order']->status,
                'payment_status' => $result['payment']->status,
            ],
        ]);
    }

    /**
     * Payment simulator for local development and MVP testing.
     */
    public function simulate(Order $order, Request $request): RedirectResponse
    {
        if ($order->user_id !== Auth::id()) {
            abort(403, 'Akses ditolak.');
        }

        $validated = $request->validate([
            'status' => ['required', 'string', 'in:paid,failed,expired'],
        ]);

        $serverKey = config('services.midtrans.server_key', '');
        $statusCode = match ($validated['status']) {
            'paid' => '200',
            'failed' => '400',
            'expired' => '407',
        };
        $grossAmount = number_format((float) $order->grand_total, 2, '.', '');
        $signature = hash('sha512', $order->order_number.$statusCode.$grossAmount.$serverKey);

        $payload = [
            'order_id' => $order->order_number,
            'status_code' => $statusCode,
            'gross_amount' => $grossAmount,
            'signature_key' => $signature,
            'transaction_id' => 'SIM-'.uniqid(),
            'transaction_status' => match ($validated['status']) {
                'paid' => 'settlement',
                'failed' => 'deny',
                'expired' => 'expire',
            },
            'payment_type' => 'bank_transfer',
            'settlement_time' => now()->toDateTimeString(),
        ];

        $this->paymentService->handleWebhook($payload);

        return redirect()->route('orders.show', $order)
            ->with('success', 'Status simulasi pembayaran berhasil diperbarui.');
    }
}
