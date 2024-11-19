<?php

namespace App\Http\Controllers;

use App\Models\Pendaftar;
use App\Models\Seleksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PendaftarController extends Controller
{
    // Menampilkan daftar pendaftar
    public function index()
    {
        // Ambil data pendaftar terbaru dengan pagination
        $pendaftars = Pendaftar::latest()->paginate(10);

        // Kirim data ke view
        return view('pendaftars.index', compact('pendaftars'));  // Pastikan nama view sesuai
    }

    // Menampilkan form untuk membuat pendaftar baru
    public function create()
    {
        return view('pendaftars.create');
    }

    // Menyimpan data pendaftar dan menambahkannya ke tabel seleksi
    public function store(Request $request)
    {
        // Validasi data input
        $validated = $request->validate([
            'nama_lengkap' => 'required|min:5',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required',
            'alamat' => 'required|min:5',
            'email' => 'required|email|unique:pendaftars',
            'no_hp' => 'required|min:10',
            'foto' => 'nullable|image|mimes:jpeg,jpg,png|max:2048',
        ]);

        // Simpan data pendaftar
        $validated['foto'] = $request->file('foto') ? $request->file('foto')->store('uploads') : null;
        $pendaftar = Pendaftar::create($validated);

        // Tambahkan data ke tabel seleksi secara otomatis
        Seleksi::create([
            'pendaftar_id' => $pendaftar->id,  // Menghubungkan seleksi dengan pendaftar
            'status' => 'lihat', // Status default
        ]);

        // Redirect ke halaman daftar pendaftar dengan pesan sukses
        return redirect()->route('pendaftars.index')->with('success', 'Data pendaftar berhasil disimpan!');
    }

    // Menampilkan detail pendaftar
    public function show(Pendaftar $pendaftar)
    {
        return view('pendaftars.show', compact('pendaftar'));
    }

    // Menampilkan form edit data pendaftar
    public function edit(Pendaftar $pendaftar)
    {
        return view('pendaftars.edit', compact('pendaftar'));
    }

    // Memperbarui data pendaftar
    public function update(Request $request, Pendaftar $pendaftar)
    {
        // Validasi data input
        $validated = $request->validate([
            'nama_lengkap' => 'required|min:5',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required',
            'alamat' => 'required|min:5',
            'email' => 'required|email',
            'no_hp' => 'required|min:10',
            'foto' => 'nullable|image|mimes:jpeg,jpg,png|max:2048',
        ]);

        // Perbarui data pendaftar
        $pendaftar->fill($validated);

        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            Storage::delete($pendaftar->foto);
            // Simpan foto baru
            $pendaftar->foto = $request->file('foto')->store('uploads');
        }

        $pendaftar->save();

        // Redirect setelah berhasil
        return redirect()->route('pendaftars.index')->with('success', 'Data Berhasil Diubah!');
    }

    // Menghapus data pendaftar dan relasinya
    public function destroy(Pendaftar $pendaftar)
    {
        // Hapus foto jika ada
        Storage::delete($pendaftar->foto);

        // Hapus data pendaftar dan data terkait di tabel seleksi
        $pendaftar->delete();

        // Redirect setelah berhasil
        return redirect()->route('pendaftars.index')->with('success', 'Data pendaftar berhasil dihapus!');
    }
}
