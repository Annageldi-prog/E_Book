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
            'name' => $this->faker->sentence(2),
            'title' => $this->faker->sentence(3),
            'code' => strtoupper($this->faker->unique()->lexify('??')),
            'description' => $this->faker->paragraph(),
            'price' => $this->faker->randomFloat(2, 5, 500),
            'category_id' => Category::inRandomOrder()->first()?->id ?? Category::factory(),
            'author_id' => Author::inRandomOrder()->first()?->id ?? Author::factory(),
            'series_id' => Series::inRandomOrder()->first()?->id ?? Series::factory(),
        ];
    }
}
