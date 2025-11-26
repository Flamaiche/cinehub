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

        if ($searchCookie !== '') {
            Cookie::queue('search', $search, 10);
        } else {
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
        $success = false;
        try {
            $validatedData = $request->validate([
                'titre' => 'required|string|max:255',
                'date_sortie' => 'nullable|date',
                'synopsis' => 'nullable|string',
                'duree' => 'required|integer|min:1',
                'note' => 'nullable|numeric|min:0|max:5',
                'media' => 'nullable|url',
            ]);

            Film::create($validatedData);
            $titre = $request->input('titre');

            $success = true;
            $message = "Le film " . $titre . " a bien été ajouté !";
        } catch (\Exception $e) {
            $success = false;
            $message = "Erreur : le film n'a pas pu être ajouté.";
        }

        return redirect()->route('films.index')->with([
            'success' => $success,
            'message' => $message
        ]);
    }

    public function edit($id)
    {
        $film = Film::findOrFail($id);
        return view('films.edit', compact('film'));
    }

    public function update(Request $request, $id)
    {
        $success = false;
        try {
            $request->validate([
                'titre' => 'required|string|max:255',
                'date_sortie' => 'required|date',
                'synopsis' => 'nullable|string',
                'duree' => 'required|integer|min:1',
                'note' => 'nullable|numeric|min:0|max:5',
                'media' => 'nullable|url',
            ]);

            $film = Film::findOrFail($id);
            $film->titre = $request->input('titre');
            $film->date_sortie = $request->input('date_sortie');
            $film->synopsis = $request->input('synopsis');
            $film->duree = $request->input('duree');
            $film->note = $request->input('note');
            $film->media = $request->input('media');
            $film->save();

            $success = true;
            $message = "Film " . $film->titre . " mis à jour avec succès !";
        } catch (\Exception $e) {
            $success = false;
            $message = "Erreur : la modification du film " . $film->titre . " n'a pas pu être réalisée.";
        }

        return redirect()->route('films.index')->with([
            'success' => $success,
            'message' => $message
        ]);
    }

    public function destroy($id)
    {
        $success = false;
        try {
            $film = Film::findOrFail($id);
            $film->delete();

            $success = true;
            $message = "Film " . $film->titre . " supprimé avec succès !";
        } catch (\Exception $e) {
            $success = false;
            $message = "Erreur : le film " . $film->titre . " n'a pas pu être supprimé.";
        }

        return redirect()->route('films.index')->with([
            'success' => $success,
            'message' => $message
        ]);
    }

    public function show($id)
    {
        $film = Film::findOrFail($id);
        return view('films.show', compact('film'));
    }
}
