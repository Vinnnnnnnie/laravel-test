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
        static $combos;


        $combos = $combos ?: [];
        $user_id = User::inRandomOrder()->first()->id;
        $friend_id = User::inRandomOrder()->first()->id;
        $counter = 0;
        while (in_array([$user_id, $friend_id], $combos) || $user_id === $friend_id)
        {
            $friend_id = User::inRandomOrder()->first()->id;
            ++$counter;
        }
        $combos[] = [$user_id, $friend_id];

        return [
            'user_id' => $user_id,
            'friend_user_id' => $friend_id
        ];
    }
}
