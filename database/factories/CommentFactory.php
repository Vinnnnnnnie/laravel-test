<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Comment;
use App\Models\Recipe;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Comment>
 */
class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
            'comment' => $this->faker->realText(),
            'recipe_id' => Recipe::inRandomOrder()->first()->id ?? null,
            'user_id' => User::inRandomOrder()->first()->id ?? null,
        ];
    }
}
