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
            'colour' => 'Blue',
            'engine_size' => '498cc',
            'MOT' => true,
            'taxed' => true,
            'insured' => true,
            'garage_id' => 1,
        ]);
        Bike::create([
            'make' => 'BMW',
            'model' => 'K1100LT',
            'year' => '1994',
            'colour' => 'Maroon',
            'engine_size' => '1100cc',
            'MOT' => false,
            'taxed' => false,
            'insured' => false,
            'garage_id' => 1,

        ]);
        Bike::factory()->count(20)->create();
    }
}
