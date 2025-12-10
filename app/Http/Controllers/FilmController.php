<?php

namespace App\Http\Controllers;

use App\Models\Film;
use App\Models\Genre;
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
        $genres = Genre::all();

        return view('films.create', compact('genres'));
    }

    public function store(Request $request)
    {
        $success = false;

        try {
            $validatedData = $request->validate([
                'titre'       => 'required|string|max:255',
                'date_sortie' => 'nullable|date',
                'synopsis'    => 'nullable|string',
                'duree'       => 'required|integer|min:1',
                'note'        => 'nullable|numeric|min:0|max:5',
                'genres'      => ['array'],
                'genres.*'    => ['exists:genres,id'],
            ]);

            $film = Film::create($validatedData);

            $film->genres()->sync($request->input('genres', []));

            $success = true;
            $message = 'Le film ' . $film->titre . ' a bien été ajouté !';
        } catch (\Exception $e) {
            $success = false;
            $message = "Erreur : le film n'a pas pu être ajouté.";
        }

        return redirect()->route('films.index')->with(compact('success', 'message'));
    }

    public function edit($id)
    {
        $film   = Film::findOrFail($id);
        $genres = Genre::all();

        return view('films.edit', compact('film', 'genres'));
    }

    public function update(Request $request, $id)
    {
        $success = false;

        try {
            $validatedData = $request->validate([
                'titre'       => 'required|string|max:255',
                'date_sortie' => 'required|date',
                'synopsis'    => 'nullable|string',
                'duree'       => 'required|integer|min:1',
                'note'        => 'nullable|numeric|min:0|max:5',
                'genres'      => ['array'],
                'genres.*'    => ['exists:genres,id'],
            ]);

            $film = Film::findOrFail($id);
            $film->update($validatedData);

            $film->genres()->sync($request->input('genres', []));

            $success = true;
            $message = 'Film ' . $film->titre . ' mis à jour avec succès !';
        } catch (\Exception $e) {
            $success = false;
            $message = "Erreur : la modification du film n'a pas pu être réalisée.";
        }

        return redirect()->route('films.index')->with(compact('success', 'message'));
    }

    public function destroy($id)
    {
        $success = false;

        try {
            $film = Film::findOrFail($id);
            $titre = $film->titre;
            $film->delete();

            $success = true;
            $message = 'Film ' . $titre . ' supprimé avec succès !';
        } catch (\Exception $e) {
            $success = false;
            $message = "Erreur : le film n'a pas pu être supprimé.";
        }

        return redirect()->route('films.index')->with(compact('success', 'message'));
    }

    public function show($id)
    {
        $film = Film::with(['genres', 'medias', 'acteurs'])->findOrFail($id);

        return view('films.show', compact('film'));
    }
}
