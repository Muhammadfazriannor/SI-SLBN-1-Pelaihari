<?php

namespace App\Http\Controllers;

use App\Models\Pendaftar;
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
            'email' => 'required|email',
            'no_hp' => 'required|min:10',
        ]);

        $pendaftar = new Pendaftar($request->except('foto'));
        
        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');
            $pendaftar->foto = $foto->store('public/fotos');
        }

        $pendaftar->save();

        return redirect()->route('pendaftars.index')->with('success', 'Data Berhasil Disimpan!');
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

        $pendaftar->fill($request->except('foto'));

        if ($request->hasFile('foto')) {
            Storage::delete($pendaftar->foto); // Hapus foto lama jika ada
            $foto = $request->file('foto');
            $pendaftar->foto = $foto->store('public/fotos');
        }

        $pendaftar->save();

        return redirect()->route('pendaftars.index')->with('success', 'Data Berhasil Diubah!');
    }

    public function destroy(Pendaftar $pendaftar): RedirectResponse
    {
        Storage::delete($pendaftar->foto); // Hapus foto
        $pendaftar->delete();

        return redirect()->route('pendaftars.index')->with('success', 'Data Berhasil Dihapus!');
    }
}
