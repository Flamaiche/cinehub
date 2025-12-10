<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // Pas connecté -> redirection login
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Vous devez être connecté pour accéder à cette page.');
        }

        $user = Auth::user();

        // Admin = accès à tout
        if ($user->role === 'admin') {
            return $next($request);
        }

        // Vérifie si le rôle utilisateur est autorisé
        if (!in_array($user->role, $roles)) {
            if ($request -> is("films/create")) {
                return redirect()->route('films.index')->with('error', 'Vous n\'avez pas la permission d\'accéder à cette page.');
            }
            return redirect()->back()->with('error', 'Vous n\'avez pas la permission d\'accéder à cette page.');
        }

        return $next($request);
    }
}
