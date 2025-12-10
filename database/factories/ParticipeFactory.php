<?php

namespace Database\Factories;

use App\Models\Film;
use App\Models\Acteur;
use App\Models\Participe;
use Illuminate\Database\Eloquent\Factories\Factory;

class ParticipeFactory extends Factory
{
    protected $model = Participe::class;

    public function definition(): array
    {
        return [
            'film_id' => Film::inRandomOrder()->value('id'),
            'acteur_id' => Acteur::inRandomOrder()->value('id'),
            'role' => $this->faker->randomElement([
                'Acteur principal',
                'Second rôle',
                'Caméo',
                'Réalisateur',
                'Scénariste',
            ]),
            'note' => $this->faker->numberBetween(5, 10),
        ];
    }
}
