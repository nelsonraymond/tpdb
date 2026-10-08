<?php

namespace Database\Factories;

use App\Models\Address;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Address>
 */
class AddressFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'label' => fake()->randomElement(['Rumah', 'Kantor', 'Apartemen']),
            'recipient_name' => fake()->name(),
            'phone' => fake()->numerify('08##########'),
            'address_line' => fake()->streetAddress(),
            'village' => fake()->citySuffix(),
            'district' => 'Kecamatan '.fake()->city(),
            'city' => fake()->city(),
            'province' => 'Jawa Barat',
            'postal_code' => fake()->numerify('#####'),
            'notes' => fake()->optional()->sentence(),
            'is_default' => false,
        ];
    }
}
