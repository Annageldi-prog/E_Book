<?php

namespace Database\Seeders;

use App\Models\Author;
use Illuminate\Database\Seeder;

class AuthorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $authors = [
            'Jane Austen',
            'Stephen King',
            'J.K.Rowling',
            'Isaac Asimov',
            'Agatha Christie',
        ];

        foreach ($authors as $name) {
            Author::create(['name' =>$name]);
        }
    }
}
