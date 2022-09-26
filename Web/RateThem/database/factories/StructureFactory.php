<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class StructureFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $nom = $this->faker->company();

        return [
            'nom' => $nom,
            'slug' => Str::slug($nom),
            'description' => $this->faker->text(200),
            'address' => $this->faker->address,
            'tel1' => $this->faker->e164PhoneNumber(),
            'user_id' => rand(1, 20),
        ];
    }
}
