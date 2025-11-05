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

    public function edit($id){
        $film = Film::findOrFail($id);
        return view('films.edit', compact('film'));
    }


    public function update(Request $request, $id){
        // Validation des données
        $request->validate([
            'titre' => 'required|string|max:255',
            'date_sortie' => 'required|date',
            'synopsis' => 'nullable|string',
            'duree' => 'required|integer|min:1',
            'note' => 'nullable|numeric|min:0|max:5',
        ]);
        $film = Film::findOrFail($id);
        $film->title = $request->input('title');
        $film->date_sortie = $request->input('date_sortie');
        $film->synopsis = $request->input('synopsis');
        $film->duree = $request->input('duree');
        $film->note = $request->input('note');
        $film->save();
        // Redirection avec un message de succès
        return redirect()->route('films.index')->with('success', 'Film mis à jour avec succès.');
    }

}
