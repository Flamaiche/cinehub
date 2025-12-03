<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
         User::factory(10)->create();

        User::factory()->create([
            'nom' => 'Test User Nom',
            'prenom' => 'Test User Prenom',
            'email' => 'test@example.com',
        ]);

        $this->call(FilmSeeder::class);
        $this->call(CommentaireSeeder::class);
        $this->call(MediaSeeder::class);
    }
}
