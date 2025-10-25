<?php

namespace Database\Factories;

use App\Models\Author;
use App\Models\Category;
use App\Models\Series;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
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
        return [
            'name' => fake()->name(),
            'title' => fake()->sentence(3),
            'code' => fake()->countryCode(),
            'description' => fake()->paragraph(),
            'price' => fake()->randomFloat(2, 100, 1000),
            'category_id' => 1,
            'series_id' => 1,
            'author_id' => 2,
        ];
    }
}
