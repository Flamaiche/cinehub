<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('participe', function (Blueprint $table) {
            $table->foreignIdFor(\App\Models\Film::class)->constrained()->onDelete('cascade');
            $table->foreignIdFor(\App\Models\Acteur::class)->constrained()->onDelete('cascade');

            $table->string('role');          // rôle de l’acteur dans le film
            $table->unsignedTinyInteger('note')->nullable(); // 0–10 par ex.

            $table->primary(['film_id', 'acteur_id']);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('participe');
    }
};
