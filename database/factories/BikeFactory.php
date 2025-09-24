<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Bike>
 */
class BikeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $bikeMakes = ['Yamaha', 'Honda', 'Suzuki', 'Kawasaki', 'Ducati', 'BMW', 'Harley-Davidson'];
        return [
            'make' => $bikeMakes[array_rand($bikeMakes)],
            'model' => $this->faker->word(),
            'year' => $this->faker->year(),
            'color' => $this->faker->safeColorName(),
            'engine_size' => $this->faker->numberBetween(50, 1500) . 'cc',
            'MOT' => $this->faker->boolean(),
            'taxed' => $this->faker->boolean(),
            'insured' => $this->faker->boolean(),
        ];
    }
}
