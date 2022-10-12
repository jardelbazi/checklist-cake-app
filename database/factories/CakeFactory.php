<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Cake>
 */
class CakeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->text(),
			'weight' => $this->faker->randomFloat(2, 0, 8),
			'price' => $this->faker->randomFloat(2, 0, 8),
			'quantity' => $this->faker->numberBetween(1, 5),
			'is_available' => $this->faker->boolean(),
        ];
    }
}
