<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PendaftarController;

Route::get('/', function () {
    return view('dashboard');
});
<<<<<<< HEAD

//route resource for products
Route::resource('/pengumumen', \App\Http\Controllers\PengumumanController::class);
Route::resource('/pendaftars', \App\Http\Controllers\PendaftarController::class);
=======
//route resource for pengumuman
Route::resource('/pengumumen', \App\Http\Controllers\PengumumanController::class);
>>>>>>> 271856bb32842634795840052b5e36291ca2c1ab
