<?php

namespace Database\Seeders;

use App\Models\Film;
use App\Models\Acteur;
use App\Models\Participe;
use Illuminate\Database\Seeder;

class ParticipeSeeder extends Seeder
{
    public function run(): void
    {
        $roles = ['Acteur principal', 'Second rôle', 'Caméo', 'Réalisateur', 'Scénariste'];

        $acteurs = Acteur::all()->pluck('id')->toArray();

        Film::all()->each(function (Film $film) use ($roles, $acteurs) {
            // On choisit entre 3 et 8 acteurs DISTINCTS pour ce film
            $nb = rand(3, min(8, count($acteurs)));
            $acteursChoisis = collect($acteurs)->shuffle()->take($nb);

            foreach ($acteursChoisis as $acteurId) {
                Participe::create([
                    'film_id' => $film->id,
                    'acteur_id' => $acteurId,
                    'role' => collect($roles)->random(),
                    'note' => rand(5, 10),
                ]);
            }
        });
    }
}
