<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PengumumanController;
use App\Http\Controllers\PendaftarController;
use App\Models\Pengumuman;

// Rute untuk dashboard (utama)
Route::get('/', function () {
    // Hitung jumlah pengumuman
    $jumlahPengumuman = Pengumuman::count();

    // Kirimkan ke view dashboard
    return view('dashboard.dashboard', compact('jumlahPengumuman'));
})->name('dashboard'); // Memberikan nama 'dashboard' pada rute ini

// Rute resource untuk pengumuman dan pendaftar
Route::resource('/pengumumen', PengumumanController::class);
Route::resource('/pendaftars', PendaftarController::class);
