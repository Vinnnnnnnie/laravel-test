<?php

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
        $recipes = Recipe::all();
        $counter = 0;
        foreach ($recipes as $recipe)
        {
            for ($counter = 0; $counter < rand(1,8) ;$counter++)
            {
                Ingredient::factory()->count(1)->create(
                    [
                        'recipe_id' => $recipe->id,
                        'number' => $counter
                    ]
                );
            }
            
        }
    }
}
