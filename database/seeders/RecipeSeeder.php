<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Measurement;
use App\Models\Ingredient;
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
        $ingredients = Ingredient::factory()->count(7)->create();
        Recipe::factory()
            ->count(20)
            ->create()
            ->each(function (Recipe $recipe) use ($ingredients) {
                $pivotData = [];
                foreach ($ingredients as $index => $ingredient) {
                    $pivotData[$ingredient->id] = [
                        'order' => $index,
                        'quantity' => random_int(1, 500),
                        'measurement' => fake()->randomElement(Measurement::class),
                    ];
                }
                $recipe->ingredients()->attach($pivotData);
            });

    }
}
