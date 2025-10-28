<?php

namespace Database\Seeders;

use App\Models\Author;
use App\Models\Category;
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

        Order::factory(10)->create();

        User::factory()->create([
            'name' => 'Ejegul',
            'username' => 'ejegul123',
            'password' => 'books2006',
        ]);

        User::factory()->create([
            'name' => 'Ilmyrat',
            'username' => 'ilmyrat123',
            'password' => 'books2001',
        ]);

        User::factory()->create([
            'name' => 'Ayjemal',
            'username' => 'ayjemal123',
            'password' => 'books2002',
        ]);

        User::factory()->create([
            'name' => 'Annageldi',
            'username' => 'anna123',
            'password' => 'books2011',
        ]);

        User::factory(10)->create();
    }
}
