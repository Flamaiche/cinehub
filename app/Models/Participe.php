<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Participe extends Pivot
{
    use HasFactory;

    protected $table = 'participe';

    protected $fillable = [
        'film_id',
        'acteur_id',
        'role',
        'note',
    ];

    protected static function newFactory()
    {
        return \Database\Factories\ParticipeFactory::new();
    }

    public function film()
    {
        return $this->belongsTo(Film::class);
    }

    public function acteur()
    {
        return $this->belongsTo(Acteur::class);
    }
}
