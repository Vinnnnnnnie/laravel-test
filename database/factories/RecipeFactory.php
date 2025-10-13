<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Recipe>
 */
class RecipeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $randomImages = ['01.jpg', '02.jpg', '03.jpg', '04.jpg', '05.jpg', '06.jpg', '07.jpg', '08.jpg', '09.jpg', '10.jpg', '11.jpg', '12.jpg', '13.jpg', '14.jpg', '15.jpg', '16.jpg', '17.jpg', '18.jpg'];
        $title = $this->faker->randomElement(['Asian', 'Chinese', 'Thai', 'Spanish', 'Welsh', 'Scottish', 'English', 'African', '']) . ' ' 
            . $this->faker->randomElement(['BBQ', 'Spicy', 'Hearty', '']) . ' '
            . $this->faker->randomElement(['Pork', 'Chicken Wings', 'Soup', 'Fried Chicken', 'Stew', 'Casserole']) . ' '
            . $this->faker->randomElement(['with Rice', 'with Pasta', 'with Bread', '']);
        $directory = public_path('images/recipes');
        $scanned_directory = array_diff(scandir($directory), array('..', '.'));
        return [
            'title' => $title,
            'ingredients' => $this->faker->paragraph,
            'instructions' => $this->faker->text(500),
            'preparation_time' => $this->faker->numberBetween(10, 60),
            'cooking_time' => $this->faker->numberBetween(20, 120),
            'servings' => $this->faker->numberBetween(1, 5),
            'difficulty' => $this->faker->randomElement(['Easy', 'Medium', 'Hard']),
            'user_id' => User::inRandomOrder()->first()->id,
            'image_path' => $scanned_directory[array_rand($scanned_directory)] ?? 'default.jpg',
        ];
    }
}
