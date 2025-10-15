<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UserFriend>
 */
class UserFriendFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $user_id = User::inRandomOrder()->first()->id;
        $friend_id = User::inRandomOrder()->first()->id;

        if ($user_id === $friend_id)
        {
            return [];
        }

        return [
            'user_id' => User::inRandomOrder()->first()->id,
            'friend_user_id' => User::inRandomOrder()->first()->id
        ];
    }
}
