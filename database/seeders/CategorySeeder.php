<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['id' => 1, 'name' => 'Color'],
            ['id' => 2, 'name' => 'Fuel'],
            ['id' => 3, 'name' => 'Transmission'], 
            ['id' => 4, 'name' => 'Doors']
        ];

        Category::insert($categories);
    }
}
