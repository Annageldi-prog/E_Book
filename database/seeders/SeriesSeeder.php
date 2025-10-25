<?php

namespace Database\Seeders;

use App\Models\Series;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SeriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $series = [
            'The Chronicles of Magic',
            'Adventures in Space',
            'Historical Legends',
            'Detective Mystery',
            'Science for Kids',
        ];

        foreach ($series as $name) {
            Series::create(['name' => $name]);
        }
    }
}
