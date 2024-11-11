<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

//route resource for products
Route::resource('/pengumumen', \App\Http\Controllers\PengumumanController::class);