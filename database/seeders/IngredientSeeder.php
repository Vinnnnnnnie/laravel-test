<?php

declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Recipe;
use App\Models\Ingredient;

class IngredientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
//        $recipes = Recipe::all();

        // Ingredient is seeded in Recipe Seeder can maybe one day bring it back
        Ingredient::factory()->count(10)->create();
//        Ingredient::factory()->count(count($recipes)*4)->create();
    }
}
