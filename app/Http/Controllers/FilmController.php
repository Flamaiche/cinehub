<?php

namespace App\Http\Controllers;

use App\Models\Film;
use Illuminate\Http\Request;

class FilmController extends Controller
{
    //

    public function index()
    {
        $films = Film::orderBy('date_sortie', 'desc')->get();
        return view('films.index', compact('films'));
    }
}
