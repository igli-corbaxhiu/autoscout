<?php

namespace Database\Seeders;

use App\Models\Car;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cars = [
            ['id' => 1, 'brand' => 'Benz', 'model' => "S-Class", 'registrationDate' => '2023-11-11', 'engineSize' => '6.3', 'price' => '50000', 'status' => 1, 'tags' => '[{"category":1,"subcategory":"Black"},{"category":2,"subcategory":"Gas"},{"category":3,"subcategory":"Automatic"},{"category":4,"subcategory":"4-Door"}]'],
            ['id' => 2, 'brand' => 'Audi', 'model' => "A3", 'registrationDate' => '2023-11-11', 'engineSize' => '2.0', 'price' => '3000', 'status' => 1, 'tags' => '[{"category":1,"subcategory":"Black"},{"category":2,"subcategory":"Diesel"},{"category":3,"subcategory":"Manual"},{"category":4,"subcategory":"2-Door"}]'],
            ['id' => 3, 'brand' => 'BMW', 'model' => "500", 'registrationDate' => '2023-11-11', 'engineSize' => '3000', 'price' => '8000', 'status' => 1, 'tags' => '[{"category":1,"subcategory":"Black"},{"category":2,"subcategory":"Diesel"},{"category":3,"subcategory":"Automatic"},{"category":4,"subcategory":"4-Door"}]'],
            ['id' => 4, 'brand' => 'Opel', 'model' => "Corsa", 'registrationDate' => '2023-11-11', 'engineSize' => '1.9', 'price' => '4500', 'status' => 1, 'tags' => '[{"category":1,"subcategory":"Black"},{"category":2,"subcategory":"Diesel"},{"category":3,"subcategory":"Automatic"},{"category":4,"subcategory":"4-Door"}]'],
            ['id' => 5, 'brand' => 'Volvo', 'model' => "XC-360", 'registrationDate' => '2023-11-11', 'engineSize' => '2.2', 'price' => '15000', 'status' => 1, 'tags' => '[{"category":1,"subcategory":"Black"},{"category":2,"subcategory":"Diesel"},{"category":3,"subcategory":"Automatic"},{"category":4,"subcategory":"4-Door"}]'],
            ['id' => 6, 'brand' => 'Fiat', 'model' => "Punto", 'registrationDate' => '2023-11-11', 'engineSize' => '20', 'price' => '4000', 'status' => 1, 'tags' => '[{"category":1,"subcategory":"Black"},{"category":2,"subcategory":"Gas"},{"category":3,"subcategory":"Manual"},{"category":4,"subcategory":"2-Door"}]'],
           
        ];

        Car::insert($cars);
    }
}
