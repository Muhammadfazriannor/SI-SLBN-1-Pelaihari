<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\PengumumanController;
use App\Http\Controllers\PendaftarController;
use App\Http\Controllers\SeleksiController;
use App\Models\Pengumuman;
use App\Models\Pendaftar;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;


// Rute untuk halaman utama
Route::get('/', function () {
    return view('welcome'); // Anda bisa mengganti 'welcome' dengan view lain sesuai kebutuhan
})->name('home');

// Rute untuk dashboard (tanpa login)
Route::get('/dashboard', function () {
    // Hitung jumlah pengumuman dan pendaftar
    $jumlahPengumuman = Pengumuman::count();
    $jumlahPendaftar = Pendaftar::count(); 

    // Kirimkan ke view dashboard
    return view('dashboard.dashboard', compact('jumlahPengumuman', 'jumlahPendaftar'));
})->name('dashboard')->middleware('auth'); // Middleware auth agar hanya bisa diakses setelah login

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
});

Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/user/dashboard', [UserController::class, 'index'])->name('user.dashboard');
});

// Rute resource untuk pengumuman dan pendaftar
Route::resource('/pengumumen', PengumumanController::class);
Route::resource('/pendaftars', PendaftarController::class);
Route::get('pendaftars/{pendaftar}', [PendaftarController::class, 'show'])->name('pendaftars.show');
Route::get('/pendaftars', [PendaftarController::class, 'index'])->name('pendaftars.index');

// Rute untuk seleksi
Route::get('/seleksi', [SeleksiController::class, 'index'])->name('seleksi.index');
Route::get('/seleksi/proses', [SeleksiController::class, 'prosesSeleksi'])->name('seleksi.proses');
Route::get('/seleksi/update-status/{seleksi}/{status}', [SeleksiController::class, 'updateStatus'])->name('seleksi.updateStatus');

// Rute untuk halaman login
Route::get('/login', function () {
    return view('login'); // Halaman login
})->name('login');

// Rute untuk proses login
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');

// Rute untuk logout
Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout'])->name('logout');

// Rute untuk halaman register
Route::get('/register', function () {
    return view('register'); // Pastikan 'register' sesuai dengan nama view yang akan dibuat
})->name('register');
// Rute untuk proses registrasi
Route::post('/register', [AuthController::class, 'register'])->name('register.submit');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::resource('admin/announcements', AnnouncementController::class);
Route::resource('pendaftars', PendaftarController::class);

