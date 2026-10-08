<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = fake()->unique()->words(3, true);

        return [
            'category_id' => Category::factory(),
            'name' => ucfirst($name),
            'slug' => Str::slug($name),
            'sku' => 'PROD-'.fake()->unique()->numerify('#####'),
            'description' => fake()->paragraph(),
            'material' => fake()->randomElement(['Voal Premium', 'Ceruty Babydoll', 'Silk Satin', 'Paris Premium']),
            'care_instructions' => 'Cuci menggunakan tangan, hindari pemutih, setrika dengan suhu rendah.',
            'base_price' => fake()->randomElement([49000, 75000, 89000, 119000, 149000]),
            'compare_at_price' => null,
            'is_featured' => false,
            'is_best_seller' => false,
            'is_active' => true,
        ];
    }
}
