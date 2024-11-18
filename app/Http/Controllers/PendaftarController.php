<?php

namespace App\Http\Controllers;

use App\Models\Pendaftar;
use App\Models\Seleksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class PendaftarController extends Controller
{
    public function index(): View
    {
        $pendaftars = Pendaftar::latest()->paginate(10);
        return view('pendaftars.index', compact('pendaftars'));
    }

    public function create(): View
    {
        return view('pendaftars.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'foto' => 'nullable|image|mimes:jpeg,jpg,png|max:2048',
            'nama_lengkap' => 'required|min:5',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required',
            'alamat' => 'required|min:5',
            'email' => 'required|email|unique:pendaftars',
            'no_hp' => 'required|min:10',
        ]);

        // Simpan data pendaftar
        $pendaftar = Pendaftar::create([
            'nama_lengkap' => $request->nama_lengkap,
            'tanggal_lahir' => $request->tanggal_lahir,
            'jenis_kelamin' => $request->jenis_kelamin,
            'alamat' => $request->alamat,
            'email' => $request->email,
            'no_hp' => $request->no_hp,
            'foto' => $request->foto ? $request->file('foto')->store('uploads') : null,
        ]);

        // Masukkan data ke tabel seleksi secara otomatis
        Seleksi::create([
            'nama_lengkap' => $pendaftar->nama_lengkap,
            'jenis_kelamin' => $pendaftar->jenis_kelamin,
            'tanggal_lahir' => $pendaftar->tanggal_lahir,
            'alamat' => $pendaftar->alamat,
            'email' => $pendaftar->email,
            'no_hp' => $pendaftar->no_hp,
            'foto' => $pendaftar->foto,
            'status' => 'lihat', // Status default 'lihat'
        ]);

        return redirect()->route('pendaftars.index')->with('success', 'Data pendaftar berhasil disimpan!');
    }

    public function show(Pendaftar $pendaftar): View
    {
        return view('pendaftars.show', compact('pendaftar'));
    }

    public function edit(Pendaftar $pendaftar): View
    {
        return view('pendaftars.edit', compact('pendaftar'));
    }

    public function update(Request $request, Pendaftar $pendaftar): RedirectResponse
    {
        $request->validate([
            'foto' => 'nullable|image|mimes:jpeg,jpg,png|max:2048',
            'nama_lengkap' => 'required|min:5',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required',
            'alamat' => 'required|min:5',
            'email' => 'required|email',
            'no_hp' => 'required|min:10',
        ]);

        // Perbarui data pendaftar
        $pendaftar->fill($request->except('foto'));

        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            Storage::delete($pendaftar->foto);
            $foto = $request->file('foto');
            $pendaftar->foto = $foto->store('public/fotos');
        }

        $pendaftar->save();

        return redirect()->route('pendaftars.index')->with('success', 'Data Berhasil Diubah!');
    }

    public function destroy(Pendaftar $pendaftar): RedirectResponse
    {
        // Hapus foto jika ada
        Storage::delete($pendaftar->foto);
        $pendaftar->delete();

        return redirect()->route('pendaftars.index')->with('success', 'Data Berhasil Dihapus!');
    }
}
