<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Acteur extends Model
{
    use HasFactory;

    protected $table = 'acteurs';

    protected $fillable = [
        'nom',
        'date_naissance',
        'biographie',
    ];

    public function films()
    {
        return $this->belongsToMany(Film::class, 'participe')
            ->using(Participe::class)
            ->withPivot(['role', 'note']);
    }
}
