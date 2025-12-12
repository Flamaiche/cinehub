<?php

namespace App\Http\Controllers;

use App\Models\Commentaire;
use App\Models\Film;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentaireController extends Controller
{
    public function store(Request $request, Film $film)
    {
        $request->validate([
            'content' => 'required|string|max:1000',
            'note'    => 'required|integer|min:0|max:10',
        ]);

        Commentaire::create([
            'user_id' => Auth::id(),
            'film_id' => $film->id,
            'content' => $request->content,
            'note'    => $request->note,
            'statut'  => 'en_attente', // obligatoire pour le workflow admin
        ]);

        return redirect()->back()->with('success', 'Commentaire ajouté !');
    }


    public function updateStatut(Commentaire $commentaire)
    {
        if (!auth()->user()->isAdmin()) {
            abort(403);
        }

        $commentaire->statut = 'valide';
        $commentaire->save();

        return back()->with('success', 'Commentaire validé avec succès.');
    }



}
