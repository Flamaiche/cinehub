<?php

use App\Http\Controllers\FilmController;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::view('/', 'home')->name('home');
Route::view('/contact', 'contact')->name('contact');
Route::view('/presentation', 'presentation')->name('presentation');

Route::get('films', [FilmController::class, 'index'])->name('films.index');

// Routes admin films : AVANT le wildcard {film}
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('films/create', [FilmController::class, 'create'])->name('films.create');
    Route::post('films', [FilmController::class, 'store'])->name('films.store');
    Route::get('films/{film}/edit', [FilmController::class, 'edit'])->name('films.edit');
    Route::put('films/{film}', [FilmController::class, 'update'])->name('films.update');
    Route::delete('films/{film}', [FilmController::class, 'destroy'])->name('films.destroy');

    // Acteurs
    Route::post('/films/{film}/acteurs', [FilmController::class, 'attachActor'])
        ->name('films.attachActor');
    Route::put('/films/{film}/acteurs/{acteur}', [FilmController::class, 'updateActor'])
        ->name('films.updateActor');
    Route::delete('/films/{film}/acteurs/{acteur}', [FilmController::class, 'detachActor'])
        ->name('films.detachActor');

    // Médias
    Route::post('/medias/upload', [MediaController::class, 'upload'])->name('medias.upload');
    Route::delete('/medias/{id}', [MediaController::class, 'delete'])->name('medias.delete');
});

// Route wildcard {film} : APRÈS les routes spécifiques
Route::middleware(['auth', 'role:user,admin'])->group(function () {
    Route::get('films/{film}', [FilmController::class, 'show'])->name('films.show');
});

Route::get('/test-auth', function () {
    if (Auth::check()) {
        return 'Vous êtes connecté en tant que : '.Auth::user()->email;
    }
    return 'Vous n\'êtes pas connecté';
});

Route::get('/logout-form', function () {
    return '<form method="POST" action="/logout">
                '.csrf_field().'
                <button type="submit">Se déconnecter</button>
            </form>';
});

Route::middleware(['auth'])->group(function () {
    Route::get('/profil', [ProfilController::class, 'show'])->name('profil.show');
    Route::get('/profil/edit', [ProfilController::class, 'edit'])->name('profil.edit');
    Route::put('/profil', [ProfilController::class, 'update'])->name('profil.update');
    Route::patch('/profil/password', [ProfilController::class, 'updatePassword'])->name('profil.password.update');
    Route::delete('/profil', [ProfilController::class, 'destroy'])->name('profil.destroy');
});

Route::middleware(['guest'])->group(function () {
    Route::get('/forgot-password', [PasswordResetLinkController::class, 'create'])
        ->name('password.request');
    Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])
        ->name('password.email');
    Route::get('/reset-password/{token}', [NewPasswordController::class, 'create'])
        ->name('password.reset');
    Route::post('/reset-password', [NewPasswordController::class, 'store'])
        ->name('password.store');
});
