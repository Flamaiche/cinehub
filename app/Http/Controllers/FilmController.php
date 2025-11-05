<?php

namespace App\Http\Controllers;

use App\Models\Film;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class FilmController extends Controller
{

    public function index(Request $request)
    {
        $search = $request->input('search');
        $searchCookie = request()->cookie('search');

        if ($searchCookie!=='') {
            Cookie::queue('search', $search, 10);
        }else {
            Cookie::queue(Cookie::forget('search'));
        }

        $films = Film::query()
            ->when($search, function ($query, $search) {
                $query->where('titre', 'like', '%' . $search . '%');
            })
            ->orderBy('date_sortie', 'desc')
            ->get();

        return view('films.index', compact('films', 'search'));
    }

    public function create()
    {
        return view('films.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'titre' => 'required|string|max:255',
            'date_sortie' => 'nullable|date',
            'synopsis' => 'nullable|string',
            'duree' => 'required|integer|min:1',
            'note' => 'nullable|numeric|min:0|max:5',
        ]);

        Film::create($validatedData);

        return redirect()->route('films.index')->with('success', 'Le film a bien été ajouté.');
    }

}
