<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Film extends Model
{
    /** @use HasFactory<\Database\Factories\FilmFactory> */
    use HasFactory;

    protected $casts = [
        'note' => 'float',
    ];

    protected $fillable = [
        'titre',
        'date_sortie',
        'synopsis',
        'duree',
        'note',
    ];

    public function commentaires()
    {
        return $this->hasMany(Commentaire::class);
    }

    public function medias()
    {
        return $this->hasMany(Media::class);
    }

}
