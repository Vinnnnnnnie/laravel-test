<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Bike;
class BikeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Bike::create([
            'make' => 'Kawasaki',
            'model' => 'ER-5',
            'year' => '2003',
            'color' => 'Blue',
            'engine_size' => '498cc',
            'MOT' => true,
            'taxed' => true,
            'insured' => true,
        ]);
        Bike::create([
            'make' => 'BMW',
            'model' => 'K1100LT',
            'year' => '1994',
            'color' => 'Maroon',
            'engine_size' => '1100cc',
            'MOT' => false,
            'taxed' => false,
            'insured' => false,
        ]);
        Bike::factory(20)->create();
    }
}
