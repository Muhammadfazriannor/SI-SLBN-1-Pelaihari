<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PengumumanController;
use App\Http\Controllers\PendaftarController;
use App\Http\Controllers\SeleksiController;
use App\Models\Pengumuman;
use App\Models\Pendaftar; // Pastikan model Pendaftar sudah diimport

// Rute untuk halaman utama
Route::get('/', function () {
    // Mengarahkannya ke halaman selamat datang (atau halaman lain yang diinginkan)
    return view('welcome'); // Anda bisa mengganti 'welcome' dengan view lain sesuai kebutuhan
})->name('home'); // Memberikan nama 'home' pada rute ini

// Rute untuk dashboard (tanpa login)
Route::get('/dashboard', function () {
    // Hitung jumlah pengumuman
    $jumlahPengumuman = Pengumuman::count();

    // Hitung jumlah pendaftar
    $jumlahPendaftar = Pendaftar::count(); // Menghitung jumlah pendaftar

    // Kirimkan ke view dashboard
    return view('dashboard.dashboard', compact('jumlahPengumuman', 'jumlahPendaftar'));
})->name('dashboard'); // Menghapus middleware 'auth' agar bisa diakses tanpa login

// Rute resource untuk pengumuman dan pendaftar
Route::resource('/pengumumen', PengumumanController::class);
Route::resource('/pendaftars', PendaftarController::class);
Route::get('pendaftars/{pendaftar}', [PendaftarController::class, 'show'])->name('pendaftars.show');
Route::get('/pendaftars', [PendaftarController::class, 'index'])->name('pendaftars.index');

Route::get('/seleksi', [SeleksiController::class, 'index'])->name('seleksi.index');
Route::get('/seleksi/proses', [SeleksiController::class, 'prosesSeleksi'])->name('seleksi.proses');
Route::get('/seleksi/update-status/{seleksi}/{status}', [SeleksiController::class, 'updateStatus'])->name('seleksi.updateStatus');
