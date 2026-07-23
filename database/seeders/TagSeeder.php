<?php

declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Tag;
use App\Models\Recipe;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // $tagArray = [
        //     'Asian', 'Chinese', 'Indian', 'Korean', 'Thai', 'Japanese', 'Mexican',
        //     'Spanish', 'Mediteranean', 'Italian', 'Greek', 'French', 'British', 'Middle Eastern', 'One-pot',
        //     'Main', 'Side', 'Dessert', 'Sauce', 'Drink', 'Roasted', 'Fried', 'Baked', 'Fusion', 'Curry',
        //     'Soup', 'Stew', 'Sandwich', 'Dairy-free', 'Light', 'Fresh', 'Salad', 'Hearty', 'Warming', 'Welsh',
        //     'Breakfast', 'Lunch', 'Dinner', 'Snack', 'Scottish', 'Irish', 'Spicy', 'BBQ', 'Cajun',
        //     'Meaty', 'Vegatarian', 'Vegan'
        // ];
        $tagArray = ['Breakfast', 'Lunch', 'Dinner', 'Snack', 'Dessert',
            'Drink', 'Vegetarian', 'Vegan', 'Gluten-Free', 'Dairy-Free', 'One-Pot',
            'Pescetarian', 'Mediterranean', 'East Asian', 'South Asian', 'European',
            'British', 'African', 'South American', 'North American', 'Fried', 'Baked',
            'BBQ', 'Spicy', 'Middle Eastern'];
        foreach ($tagArray as $tag) {
            Tag::create([
                'name' => $tag,
            ]);
        }
         $tags = Tag::all();
         $recipeIds = collect(Recipe::all('id'));
         foreach ($tags as $tag)
         {
             $tag->recipes()->attach($recipeIds->random(5));
         }
    }
}
