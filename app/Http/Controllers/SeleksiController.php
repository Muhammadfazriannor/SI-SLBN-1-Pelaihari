<?php
namespace App\Http\Controllers;

use App\Models\Pendaftar;
use App\Models\Seleksi;
use Illuminate\Http\Request;

class SeleksiController extends Controller
{
    public function prosesSeleksi()
    {
        // Ambil semua data dari tabel pendaftars
        $pendaftars = Pendaftar::all();

        foreach ($pendaftars as $pendaftar) {
            // Contoh kriteria seleksi: Lolos jika nama lebih dari 5 karakter
            $isLolos = strlen($pendaftar->nama_lengkap) > 5;

            // Simpan data ke tabel seleksis
            Seleksi::updateOrCreate(
                ['email' => $pendaftar->email], // Berdasarkan email (unik)
                [
                    'nama_lengkap' => $pendaftar->nama_lengkap,
                    'jenis_kelamin' => $pendaftar->jenis_kelamin,
                    'tanggal_lahir' => $pendaftar->tanggal_lahir,
                    'alamat' => $pendaftar->alamat,
                    'email' => $pendaftar->email,
                    'no_hp' => $pendaftar->no_hp,
                    'foto' => $pendaftar->foto,
                    'lolos' => $isLolos,
                    'status' => 'lihat', // Default status adalah 'lihat'
                ]
            );
        }

        return redirect()->route('seleksi.index')->with('success', 'Proses seleksi selesai!');
    }

    public function index()
    {
        // Tampilkan data seleksi
        $seleksis = Seleksi::all();
        return view('seleksi.index', compact('seleksis'));
    }

    // Fungsi untuk memperbarui status seleksi
    public function updateStatus($seleksiId, $status)
    {
        // Validasi status yang diterima
        $validStatuses = ['diterima', 'tidak diterima', 'lihat'];
        if (!in_array($status, $validStatuses)) {
            return redirect()->route('seleksi.index')->with('error', 'Status tidak valid.');
        }

        // Temukan seleksi berdasarkan ID
        $seleksi = Seleksi::findOrFail($seleksiId);

        // Update status seleksi
        $seleksi->status = $status;
        $seleksi->save();

        return redirect()->route('seleksi.index')->with('success', 'Status seleksi berhasil diubah.');
    }
}
