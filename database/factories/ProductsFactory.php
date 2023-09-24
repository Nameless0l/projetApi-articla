<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Products>
 */
class ProductsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->word,
            'brandName' => fake()->company,
            'description' => fake()->sentence,
            'price' => fake()->randomFloat(2, 10, 1000),
            'inPromotion' => fake()->randomElement(['yes', 'no']),
            'imagePath' => fake()->imageUrl(200, 200, 'product', true),
        ];
    }
}
