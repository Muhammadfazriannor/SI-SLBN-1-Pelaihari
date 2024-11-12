<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PendaftarController;

Route::get('/', function () {
    return view('welcome');
});

//route resource for products
Route::resource('/pengumumen', \App\Http\Controllers\PengumumanController::class);
Route::resource('/pendaftars', \App\Http\Controllers\PendaftarController::class);