<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Recipe;
use App\Models\Step;
use Illuminate\Database\Eloquent\Factories\Factory\Faker;

class StepSeeder extends Seeder
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
                Step::factory()->count(1)->create(
                    [
                        'recipe_id' => $recipe->id,
                        'number' => $counter
                    ]
                );
            }
            
        }
    }
}
