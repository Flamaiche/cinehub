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
