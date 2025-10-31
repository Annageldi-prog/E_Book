<?php

namespace Database\Seeders;

use App\Models\Author;
use App\Models\Category;
use App\Models\Review;
use Illuminate\Support\Facades\Hash;
use App\Models\Order;
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
        $this->call([
            CategorySeeder::class,
            SeriesSeeder::class,
        ]);

        Author::insert([
            ['name' => 'Mark Zuckerberg'],
            ['name' => 'Elon Musk'],
            ['name' => 'Steve Jobs'],
            ['name' => 'Barack Obama'],
            ['name' => 'Warren Buffett'],
            ['name' => 'Ibn-i Haldun'],
            ['name' => 'Barbaros Hayreddin Paşa'],
            ['name' => 'Uçan Hali Babam'],
            ['name' => 'Ход королевы'],
            ['name' => 'Just Mercy'],
        ]);

        $this->call([
            ProductSeeder::class,
        ]);
        User::factory()->create();

        Order::factory(10)->create();

        Review::factory(30)->create();

        User::firstOrCreate(
            ['username' => 'ejegul123'],
            [
                'name' => 'Ejegul',
                'password' => bcrypt('books2006'),
            ]
        );

        User::firstOrCreate(
            ['username' => 'ilmyrat123'],
            [
                'name' => 'Ilmyrat',
                'password' => bcrypt('books2001'),
            ]
        );

        User::firstOrCreate(
            ['username' => 'ayjemal123'],
            [
                'name' => 'Ayjemal',
                'password' => bcrypt('books2002'),
            ]
        );

        User::firstOrCreate(
            ['username' => 'anna123'],
            [
                'name' => 'Annageldi',
                'password' => bcrypt('books2011'),
            ]
        );
    }
}
