<?php

use App\Http\Controllers\FilmController;
use Illuminate\Support\Facades\Route;

//Route::get('/', function () {
//    return view('layouts.app');
//});

Route::view('/', 'home')->name('home');

Route::view('/contact', 'contact')->name('contact');

Route::view('/presentation', 'presentation')->name('presentation');

Route::resource('films', FilmController::class);

Route::get('/test-auth', function () {
    if (Auth::check()) {
        return 'Vous êtes connecté en tant que : ' . Auth::user()->email;
    }
    return 'Vous n\'êtes pas connecté';
});

Route::get('/logout-form', function () {
    return '<form method="POST" action="/logout">
                ' . csrf_field() . '
                <button type="submit">Se déconnecter</button>
            </form>';
});

