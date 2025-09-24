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
        Recipe::create([
            'title' => 'Spaghetti Bolognese',
            'ingredients' => 'Spaghetti, minced beef, tomato sauce, onions, garlic, olive oil, salt, pepper',
            'instructions' => '1. Cook spaghetti according to package instructions. 2. In a pan, heat olive oil and sauté onions and garlic until translucent. 3. Add minced beef and cook until browned. 4. Pour in tomato sauce and simmer for 20 minutes. 5. Season with salt and pepper. 6. Serve sauce over spaghetti.',
            'preparation_time' => 15,
            'cooking_time' => 30,
            'servings' => 4,
            'difficulty' => 'Easy',
        ]);
        Recipe::create([
            'title' => 'Chicken Curry',
            'ingredients' => 'Chicken breast, curry powder, coconut milk, onions, garlic, ginger, rice, salt, pepper',
            'instructions' => '1. Cook rice according to package instructions. 2. In a pan, heat oil and sauté onions, garlic, and ginger until fragrant. 3. Add chicken pieces and cook until no longer pink. 4. Stir in curry powder and cook for 2 minutes. 5. Pour in coconut milk and simmer for 25 minutes. 6. Season with salt and pepper. 7. Serve chicken curry over rice.',
            'preparation_time' => 20,
            'cooking_time' => 35,
            'servings' => 4,
            'difficulty' => 'Medium',
        ]);
        Recipe::factory()->count(20)->create();
    }
}
