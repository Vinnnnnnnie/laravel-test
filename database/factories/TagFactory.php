<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Tag;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Tag>
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
            'Meaty', 'Vegatarian', 'Vegan',
        ];

        $tag = $this->faker->randomElement($tagArray);

        return [
            'tag' => $tag,
        ];
    }
}
