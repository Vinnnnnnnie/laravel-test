<?php

declare(strict_types=1);

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ingredient>
 */
class IngredientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $amount = random_int(1, 4);
        $measurement = ['tsp', 'tbsp', 'whole'];
        $name = $amount . ' ' . $this->faker->randomElement($measurement) . ' ' . fake()->text(random_int(5, 10));
        return [
            'name' => $name,
        ];
    }
}
