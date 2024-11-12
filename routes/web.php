<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('dashboard');
});
//route resource for pengumuman
Route::resource('/pengumumen', \App\Http\Controllers\PengumumanController::class);