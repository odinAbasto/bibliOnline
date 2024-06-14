<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->unique()->randomElement([
                "FICCION",
                "NO FICCION",
                "MISTERIO",
                "SUSPENSO",
                "CIENCIA FICCION",
                "FANTASIA",
                "FICCION HISTORICA",
                "ROMANCE",
                "TERROR",
                "BIOGRAFIA",
                "AUTOAYUDA",
                "JUVENIL",
                "INFANTIL",
                "POESIA",
                "OTROS"
            ])
        ];
    }
}
