<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/', function () {
    return view('dashboard');
});

//route resource for products
Route::resource('/pengumumen', \App\Http\Controllers\PengumumanController::class);