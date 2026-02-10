<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tags>
 */
class TagFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $tagArray = [
            'Asian', 'Chinese', 'Indian', 'Curry', 'Hearty', 'Warming', 'Welsh', 
            'Scottish', 'Irish', 'French', 'Spanish', 'Spicy', 'BBQ', 'Cajun', 
            'Meaty', 'Vegatarian', 'Vegan'
        ];
        
        $tag = $this->faker->randomElement($tagArray);

        return [
            'tag' => $tag
        ];
    }
}
