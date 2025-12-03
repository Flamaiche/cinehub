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
            'url' => $this->faker->randomElement(['https://portfolio.malik-dev.com', $this->faker->imageUrl()]),
            'description' => $this->faker->paragraph()
        ];
    }
}
