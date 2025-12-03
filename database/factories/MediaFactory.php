<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Media>
 */
class MediaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'type' => $this->faker->randomElement(['image', 'video']),
            'url' => 'https://picsum.photos/640/480?random=' . $this->faker->unique()->numberBetween(1, 10000),
            'description' => $this->faker->paragraph(),
            'film_id' => $this->faker->randomNumber(1, 10),
        ];
    }
}
