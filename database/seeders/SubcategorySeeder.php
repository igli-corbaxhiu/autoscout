<?php

namespace Database\Seeders;

use App\Models\Subcategory;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SubcategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $subcategories = [
            ['id' => 1, 'name' => 'Red', 'category_id' => 1],
            ['id' => 2, 'name' => 'Black', 'category_id' => 1],
            ['id' => 3, 'name' => 'Gray', 'category_id' => 1], 
            ['id' => 4, 'name' => '2-Door', 'category_id' => 4],
            ['id' => 5, 'name' => '4-Door', 'category_id' => 4],
            ['id' => 6, 'name' => 'Diesel', 'category_id' => 2],
            ['id' => 7, 'name' => 'Gas', 'category_id' => 2],
            ['id' => 8, 'name' => 'Automatic', 'category_id' => 3],
            ['id' => 9, 'name' => 'Manual', 'category_id' => 3],
        ];

        Subcategory::insert($subcategories);
    }
}
