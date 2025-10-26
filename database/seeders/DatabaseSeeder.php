<?php

namespace Database\Seeders;

use App\Models\Author;
use App\Models\Category;
use App\Models\Product;
use App\Models\Series;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()
            ->create([
                'name' => 'Annageldi',
                'username' => 'anna123',
                'password' => 'books2025',
            ]);

        $this->call(CategorySeeder::class);
        $this->call(SeriesSeeder::class);

        User::factory(10)
            ->create();

        Author::factory(5)
            ->create();

        Product::factory(20)
            ->create();

    }
}
