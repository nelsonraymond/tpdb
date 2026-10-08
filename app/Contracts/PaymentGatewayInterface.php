<?php

namespace App\Contracts;

use App\Models\Order;

interface PaymentGatewayInterface
{
    /**
     * Get the identifier name of the payment gateway.
     */
    public function getName(): string;

    /**
     * Initialize/create a transaction session with the payment gateway.
     *
     * @param  array<string, mixed>  $options
     * @return array{
     *     transaction_reference: string,
     *     payment_url?: ?string,
     *     payment_method?: ?string,
     *     metadata?: array<string, mixed>
     * }
     */
    public function createPayment(Order $order, array $options = []): array;

    /**
     * Verify whether a webhook/callback payload is authentic and untampered.
     *
     * @param  array<string, mixed>  $payload
     */
    public function verifyWebhook(array $payload, ?string $signature = null): bool;

    /**
     * Parse and normalize a webhook payload into standard gateway-agnostic format.
     *
     * @param  array<string, mixed>  $payload
     * @return array{
     *     order_number: string,
     *     transaction_reference: string,
     *     status: 'pending'|'paid'|'failed'|'expired'|'refunded',
     *     payment_method: ?string,
     *     amount: float,
     *     paid_at: ?\Carbon\CarbonInterface,
     *     raw: array<string, mixed>
     * }
     */
    public function parseWebhook(array $payload): array;
}
