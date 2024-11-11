<?php

namespace App\Http\Controllers;

use App\Models\Pengumuman;

use Illuminate\View\View;

//import return type redirectResponse
use Illuminate\Http\RedirectResponse;

//import Http Request
use Illuminate\Http\Request;

class PengumumanController extends Controller


{
        /**
     * index
     *
     * @return void
     */
    public function index() : View
    {
        //get all products
        $pengumumen = Pengumuman::latest()->paginate(10);

        //render view with products
        return view('pengumumen.index', compact('pengumumen'));
    }
     /**
     * create
     *
     * @return View
     */
    public function create(): View
    {
        return view('pengumumen.create');
    }

    /**
     * store
     *
     * @param  mixed $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        // Validasi form
        $request->validate([
            'foto'         => 'required|image|mimes:jpeg,jpg,png|max:2048',
            'judul'        => 'required|min:5',
            'isi'          => 'required|min:10',
            'tanggal'      => 'required|date',
        ]);
    
        // Unggah gambar
        $foto = $request->file('foto');
        $foto->storeAs('public/pengumumen', $foto->hashName());
    
        // Buat berita dengan menghapus tag HTML dari isi
        Pengumuman::create([
            'foto'         => $foto->hashName(),
            'judul'        => $request->judul,
            'isi'          => strip_tags($request->isi), // Menghapus tag HTML
            'tanggal'      => $request->tanggal,
        ]);
    
        // Alihkan ke index
        return redirect()->route('pengumumen.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }
     /**
     * show
     *
     * @param  mixed $id
     * @return View
     */
    public function show(string $id): View
    {
        //get product by ID
        $berita = Pengumuman::findOrFail($id);

        //render view with product
        return view('pengumumen.show', compact('berita'));
    }
}

