<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class RatingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'note' => rand(1, 5),
            'commentaire' => $this->faker->text(40),
            'product_id' => rand(1, 30),
            'user_id' => rand(1, 20),
        ];
    }
}
