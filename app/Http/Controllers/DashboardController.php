<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Models\Pendaftar;

class DashboardController extends Controller
{
    public function index()
    {
        // Menghitung jumlah pengumuman dan pendaftar
        $jumlahPengumuman = Announcement::count();
        $jumlahPendaftar = Pendaftar::count();

        // Mengirim data ke view dashboard
        return view('dashboard', compact('jumlahPengumuman', 'jumlahPendaftar'));
    }
}
