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
        // Validation
        $request->validate([
            'content' => 'required|string|max:1000', // <-- correspond au champ de la table
            'note' => 'required|integer|min:0|max:10',
        ]);

        // Création du commentaire
        Commentaire::create([
            'user_id' => Auth::id(),
            'film_id' => $film->id,
            'content' => $request->content,
            'note' => $request->note,
            'status' => 'en attente',
        ]);

        return redirect()->back()->with('success', 'Commentaire ajouté !');
    }

    // Méthodes pour updateStatut, destroy, etc.
}
