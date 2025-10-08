<?php

use Illuminate\Support\Facades\Route;

//Route::get('/', function () {
//    return view('layouts.app');
//});

Route::view('/', 'home');

Route::view('/contact', 'contact');

Route::view('/presentation', 'presentation');
