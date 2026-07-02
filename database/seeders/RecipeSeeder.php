<?php

declare(strict_types=1);

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
        $scanned_directory = array_diff(scandir($directory), ['..', '.']);
        Recipe::factory()->count(40)->create();
    }
}
