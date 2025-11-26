<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfilController extends Controller
{
    public function show()
    {
        return view('profil.show', [
            'user' => Auth::user(),
        ]);
    }

    public function edit()
    {
        return view('profil.edit', [
            'user' => Auth::user(),
        ]);
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $data = $request->validate([
            'nom'    => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email'  => 'required|email|max:255|unique:users,email,' . $user->id,
        ]);

        // name = nom + prenom comme demandé dans le sujet
        $user->name   = $data['nom'] . ' ' . $data['prenom'];
        $user->nom    = $data['nom'];
        $user->prenom = $data['prenom'];
        $user->email  = $data['email'];
        $user->save();

        return redirect()->route('profil.show');
    }

    public function updatePassword(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'current_password' => 'required|current_password',
            'password'         => 'required|string|min:8|confirmed',
        ]);

        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->route('profil.show');
    }

    public function destroy(Request $request)
    {
        $user = Auth::user();

        Auth::logout();
        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
