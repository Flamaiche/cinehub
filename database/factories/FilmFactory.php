<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Film>
 */
class FilmFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'titre' => $this->faker->catchPhrase(), // ex : “The Last Horizon”
            'date_sortie' => $this->faker->dateTimeBetween('-40 years', 'now')->format('Y-m-d'),
            'synopsis' => $this->faker->paragraph(3),
            'duree' => $this->faker->numberBetween(80, 180),
            'note' => $this->faker->randomFloat(1, 0, 5),
        ];
    }
}
