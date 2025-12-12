<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Film;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Commentaire>
 */
class CommentaireFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'film_id' => Film::factory(),
            'content' => $this->faker->paragraph(),
            'note' => $this->faker->numberBetween(0, 10),
            'statut' => $this->faker->randomElement(['valide', 'en_attente', 'supprime']),

        ];

    }
}
