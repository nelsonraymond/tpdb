<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'order_number' => 'ORD-'.date('Ymd').'-'.strtoupper(fake()->bothify('????##')),
            'user_id' => User::factory(),
            'status' => 'pending',
            'payment_status' => 'pending',
            'subtotal' => 150000,
            'discount_amount' => 0,
            'shipping_cost' => 15000,
            'grand_total' => 165000,
            'voucher_code' => null,
            'voucher_discount' => 0,
            'shipping_recipient_name' => fake()->name(),
            'shipping_phone' => fake()->numerify('08##########'),
            'shipping_address' => fake()->streetAddress(),
            'shipping_city' => fake()->city(),
            'shipping_province' => 'Jawa Barat',
            'shipping_postal_code' => fake()->numerify('#####'),
            'customer_note' => null,
            'placed_at' => now(),
        ];
    }
}
