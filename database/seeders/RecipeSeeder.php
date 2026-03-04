<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Recipe;

class RecipeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $directory = public_path('storage/recipes');
        $scanned_directory = array_diff(scandir($directory), array('..', '.'));
        Recipe::factory()->count(40)->create();
    }
}
