<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<ProductVariant>
 */
class ProductVariantFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $color = fake()->safeColorName();

        return [
            'product_id' => Product::factory(),
            'name' => ucfirst($color),
            'sku' => 'VAR-'.fake()->unique()->numerify('#####'),
            'color_name' => ucfirst($color),
            'color_hex' => fake()->hexColor(),
            'size' => 'All Size',
            'additional_price' => 0,
            'stock_qty' => fake()->numberBetween(10, 50),
            'low_stock_threshold' => 5,
            'weight_gram' => 150,
            'is_active' => true,
        ];
    }
}
