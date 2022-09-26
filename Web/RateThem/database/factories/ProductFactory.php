<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $nom = $this->faker->colorName();
        $type = ['produit', 'service', 'autre'];
        return [
            'nom' => $nom,
            'slug' => Str::slug($nom),
            'description' => $this->faker->text(200),
            'type' => $type[rand(0, 2)],
            'structure_id' => rand(1, 25)
        ];
    }
}
