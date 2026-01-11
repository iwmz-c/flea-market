<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => 1,
            'name' => $this->faker->word(),
            'price' => $this->faker->numberBetween(100, 5000),
            'condition_id' => $this->faker->numberBetween(1, 4),

        ];
    }
}
