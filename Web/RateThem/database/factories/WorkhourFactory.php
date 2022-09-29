<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class WorkhourFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'start_time' => $this->faker->time,
            'end_time' => $this->faker->time,
            'day_id' => rand(1, 8),
            'structure_id' => rand(1, 20),
        ];
    }
}
