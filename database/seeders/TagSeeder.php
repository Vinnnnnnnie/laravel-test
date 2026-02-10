<?php

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
        $tagArray = [
            'Asian', 'Chinese', 'Indian', 'Curry', 'Hearty', 'Warming', 'Welsh', 
            'Scottish', 'Irish', 'French', 'Spanish', 'Spicy', 'BBQ', 'Cajun', 
            'Meaty', 'Vegatarian', 'Vegan'
        ];
        foreach ($tagArray as $tag)
        {
            Tag::create([
                'name' => $tag
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
