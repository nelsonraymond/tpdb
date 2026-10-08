<?php

namespace Database\Factories;

use App\Models\Payment;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Payment>
 */
class PaymentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'order_id' => \App\Models\Order::factory(),
            'provider' => 'midtrans',
            'payment_method' => 'midtrans_snap',
            'transaction_reference' => 'TRX-' . strtoupper(fake()->bothify('????#####')),
            'amount' => 165000,
            'status' => 'pending',
            'paid_at' => null,
            'metadata' => [],
        ];
    }
}
