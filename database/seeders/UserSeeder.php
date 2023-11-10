<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => '$2y$10$Gz1q3copVqY1Apo26sjQhuaHXiP0u/KOGgMR3qCU2PWHlvUT9aJ5C', //11111111
            'role' => 'admin'
        ]);
    }
}
