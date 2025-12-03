<?php

namespace Database\Seeders;

use App\Models\Media;
use Database\Factories\MediaFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MediaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Media::factory()->count(10)->create();
    }
}
