<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)->create();

        User::factory()->create([
            'nom' => 'Admin',
            'prenom' => 'Super',
            'email' => 'admin2@cinehub.com',
            'password' => bcrypt('motdepasse'),
            'role' => 'admin',
        ]);



        User::factory()->create([
            'nom' => 'User',
            'prenom' => 'User',
            'email' => 'user@example.com',
            'role' => 'user',
        ]);

        User::factory()->create([
            'nom' => 'Admin',
            'prenom' => 'Account',
            'email' => 'admin@gmail.com',
            'role' => 'admin',
            'password' => Hash::make('admin'),
        ]);

        $this->call([
            FilmSeeder::class,
            ActeurSeeder::class,
            GenreSeeder::class,
            MediaSeeder::class,
            ParticipeSeeder::class,
            CommentaireSeeder::class,
        ]);
    }
}
