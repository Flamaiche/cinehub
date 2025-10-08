<?php

use App\Http\Controllers\FilmController;
use Illuminate\Support\Facades\Route;

//Route::get('/', function () {
//    return view('layouts.app');
//});

Route::view('/', 'home');

Route::view('/contact', 'contact');

Route::view('/presentation', 'presentation');

Route::get('/films', [FilmController::class, 'index'])->name('films.index');
