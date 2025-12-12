<?php

namespace Database\Seeders;

use App\Models\Commentaire;
use App\Models\Film;
use App\Models\User;
use Illuminate\Database\Seeder;

class CommentaireSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userIds = User::pluck('id')->toArray();
        $filmIds = Film::pluck('id')->toArray();

        if (empty($userIds) || empty($filmIds)) {
            return;
        }

        foreach (range(1, 100) as $i) {
            Commentaire::factory()->create([
                'user_id' => fake()->randomElement($userIds),
                'film_id' => fake()->randomElement($filmIds),
                'statut'  => fake()->randomElement(['valide', 'en_attente', 'supprime']),
            ]);

        }
    }
}
