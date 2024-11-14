<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PendaftarController;

Route::get('/', function () {
    // Mengarahkannya ke folder dashboard
    return view('dashboard.dashboard');  // Menunjuk ke resources/views/dashboard/dashboard.blade.php
});
use App\Models\Pengumuman;

Route::get('/', function () {
    // Hitung jumlah pengumuman
    $jumlahPengumuman = Pengumuman::count();

    // Kirimkan ke view dashboard
    return view('dashboard.dashboard', compact('jumlahPengumuman'));
});


// Route resource untuk pengumuman dan pendaftar
Route::resource('/pengumumen', \App\Http\Controllers\PengumumanController::class);
Route::resource('/pendaftars', \App\Http\Controllers\PendaftarController::class);
