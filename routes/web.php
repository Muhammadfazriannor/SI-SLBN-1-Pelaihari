<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\PengumumanController;
use App\Http\Controllers\PendaftarController;
use App\Http\Controllers\SeleksiController;
use App\Models\Pengumuman;
use App\Models\Pendaftar;

// Rute untuk halaman utama
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Rute untuk dashboard (tanpa login)
Route::get('/dashboard', function () {
    // Hitung jumlah pengumuman dan pendaftar
    $jumlahPengumuman = Pengumuman::count();
    $jumlahPendaftar = Pendaftar::count(); 

    return view('dashboard.dashboard', compact('jumlahPengumuman', 'jumlahPendaftar'));
})->name('dashboard')->middleware('auth');

// Rute resource untuk pengumuman dan pendaftar
Route::resource('/pengumumen', PengumumanController::class);
Route::resource('/pendaftars', PendaftarController::class);
Route::get('pendaftars/{pendaftar}', [PendaftarController::class, 'show'])->name('pendaftars.show');
Route::get('/pendaftars', [PendaftarController::class, 'index'])->name('pendaftars.index');

// Rute untuk seleksi
Route::get('/seleksi', [SeleksiController::class, 'index'])->name('seleksi.index');
Route::get('/seleksi/proses', [SeleksiController::class, 'prosesSeleksi'])->name('seleksi.proses');
Route::get('/seleksi/update-status/{seleksi}/{status}', [SeleksiController::class, 'updateStatus'])->name('seleksi.updateStatus');

// Rute untuk halaman login admin
Route::get('/login/admin', function () {
    return view('login'); // Ganti dengan tampilan login admin
})->name('login.admin');

// Rute untuk proses login admin
Route::post('/login/admin', [AuthController::class, 'login'])->name('login.admin.submit');

// Rute untuk logout
Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout'])->name('logout');

// Rute untuk halaman register admin
Route::get('/register/admin', function () {
    return view('register');
})->name('register.admin');

// Rute untuk proses registrasi admin
Route::post('/register/admin', [AuthController::class, 'register'])->name('register.admin.submit');
