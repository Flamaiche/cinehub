<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

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
            'user_id' => $this->faker->numberBetween(1, 10),
            'film_id' => $this->faker->numberBetween(1, 10),
            'content'  => $this->faker->text,
            'note' => $this->faker->randomFloat(1, 0, 5),
            'status'   => $this->faker->randomElement(['valid', 'invalid', 'in progress']),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
