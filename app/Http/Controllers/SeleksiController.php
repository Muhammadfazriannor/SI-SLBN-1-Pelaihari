<?php

namespace App\Http\Controllers;

use App\Models\Seleksi;

class SeleksiController extends Controller
{
    public function index()
    {
        // Ambil data seleksi beserta relasi pendaftarnya
        $seleksis = Seleksi::with('pendaftar')->get();

        // Kirim data ke view
        return view('seleksi.index', compact('seleksis'));
    }

    public function updateStatus($seleksiId, $status)
    {
        $validStatuses = ['diterima', 'tidak diterima', 'lihat'];

        if (!in_array($status, $validStatuses)) {
            return redirect()->route('seleksi.index')->with('error', 'Status tidak valid.');
        }

        $seleksi = Seleksi::findOrFail($seleksiId);
        $seleksi->status = $status;
        $seleksi->save();

        return redirect()->route('seleksi.index')->with('success', 'Status berhasil diperbarui.');
    }
}
