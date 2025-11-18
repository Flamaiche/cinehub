<?php

namespace Database\Seeders;

use App\Models\Film;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FilmSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Film::create([
            'titre' => 'Inception',
            'date_sortie' => '2010-07-16',
            'synopsis' => 'A thief who steals corporate secrets through the use of dream-sharing technology is given the inverse task of planting an idea into the mind of a C.E.O.',
            'duree' => 148,
            'note' => 4.8,
            'media' => 'https://m.media-amazon.com/images/I/912AErFSBHL._AC_UF894,1000_QL80_.jpg',
        ]);

        Film::create([
            'titre' => 'Interstellar',
            'date_sortie' => '2014-11-07',
            'synopsis' => 'A team of explorers travel through a wormhole in space in an attempt to ensure humanity’s survival.',
            'duree' => 169,
            'note' => 4.6,
            'media'=>'https://m.media-amazon.com/images/I/91vIHsL-zjL._AC_UF894,1000_QL80_.jpg',
        ]);

        Film::create([
            'titre' => 'The Dark Knight',
            'date_sortie' => '2008-07-18',
            'synopsis' => 'When the menace known as the Joker wreaks havoc and chaos on Gotham, Batman must accept one of the greatest psychological and physical tests of his ability to fight injustice.',
            'duree' => 152,
            'note' => 4.9,
            'media' =>'https://upload.wikimedia.org/wikipedia/en/1/1c/The_Dark_Knight_%282008_film%29.jpg',

        ]);

        Film::create([
            'titre' => 'Avatar',
            'date_sortie' => '2009-12-18',
            'synopsis' => 'A paraplegic Marine dispatched to the moon Pandora becomes torn between following his orders and protecting the world he feels is his home.',
            'duree' => 162,
            'note' => 4.2,
            'media' =>'https://storage.googleapis.com/pod_public/750/262965.jpg',
        ]);

        Film::create([
            'titre' => 'The Matrix',
            'date_sortie' => '1999-03-31',
            'synopsis' => 'A computer hacker learns from mysterious rebels about the true nature of his reality and his role in the war against its controllers.',
            'duree' => 136,
            'note' => 4.7,
            'media'=>'https://m.media-amazon.com/images/I/91H4vRPPgIL._AC_UF1000,1000_QL80_.jpg',
        ]);

        Film::create([
            'titre' => 'The Shawshank Redemption',
            'date_sortie' => '1994-09-23',
            'synopsis' => 'Two imprisoned men bond over a number of years, finding solace and eventual redemption through acts of common decency.',
            'duree' => 142,
            'note' => 5.0,
            'media' =>'https://m.media-amazon.com/images/I/51r1lzFTpFL._AC_UF894,1000_QL80_.jpg',
        ]);
        Film::create([
            'titre' => 'Top gun -Maverick',
            'date_sortie' => '2022-05-25',
            'synopsis' => 'Un pilote de chasse vétéran doit effectuer une mission difficile tout en affrontant son passé.',
            'duree' => 131,
            'note' => 4.3,
            'media' =>'https://m.media-amazon.com/images/I/81a1R94HqrL._AC_UF1000,1000_QL80_.jpg',
        ]);

        Film::create([
            'titre' => 'Django',
            'date_sortie' => '2012-12-25',
            'synopsis' => 'Un esclave libéré part sauver sa femme des griffes d’un propriétaire terrien cruel.',
            'duree' => 165,
            'note' => 4.7,
            'media' =>'https://fr.web.img4.acsta.net/c_310_420/medias/nmedia/18/90/08/59/20366454.jpg',
        ]);

        Film::create([
            'titre' => 'The Mauritanian',
            'date_sortie' => '2021-02-12',
            'synopsis' => 'L’histoire vraie d’un homme emprisonné à Guantanamo qui lutte pour prouver son innocence.',
            'duree' => 129,
            'note' => 4.2,
            'media' =>'https://m.media-amazon.com/images/M/MV5BNzkwZDQ1ZTMtMWFhOC00YjliLWE2ZDEtNDlmYjU2YjNkMDVlXkEyXkFqcGc@._V1_QL75_UX190_CR0,0,190,281_.jpg',
        ]);

        Film::create([
            'titre' => 'Le Roi',
            'date_sortie' => '2023-03-15',
            'synopsis' => 'Un jeune roi doit apprendre à gouverner et à prendre des décisions pour sauver son royaume.',
            'duree' => 142,
            'note' => 4.0,
            'media' =>'https://fr.web.img5.acsta.net/pictures/19/08/22/09/22/0020378.jpg',
        ]);

        Film::create([
            'titre' => 'Les Tuches',
            'date_sortie' => '2011-07-01',
            'synopsis' => 'A Bouzolles, tout le monde connaît la famille Tuche. Jeff, Cathy et leurs trois enfants vivent du système D. Respectueuse de la philosophie Tuche, l\'homme n\'est pas fait pour travailler, toute la famille s\'emploie à être heureuse malgré le cruel manque de revenus. Leurs vies étaient toutes tracées. Ils seraient toujours pauvres, mais heureux.',
            'duree' => 95,
            'note' => 4.8,
            'media' => 'https://fr.web.img2.acsta.net/medias/nmedia/18/79/51/22/19732939.jpg',
        ]);

        Film::create([
            'titre' => 'Taxi 5',
            'date_sortie' => '2018-04-8',
            'synopsis' => 'Sylvain Marot, super flic parisien et pilote d\'exception, est muté contre son gré à la Police Municipale de Marseille.',
            'duree' => 103,
            'note' => 4.2,
            'media' =>'https://fr.web.img3.acsta.net/pictures/18/03/09/12/16/2548759.jpg',
        ]);
    }
}
