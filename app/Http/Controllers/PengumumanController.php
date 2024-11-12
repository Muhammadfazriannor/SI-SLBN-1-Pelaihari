<?php

namespace App\Http\Controllers;

use App\Models\Pengumuman;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;

class PengumumanController extends Controller
{
    /**
     * Menampilkan daftar pengumuman.
     *
     * @return View
     */
    public function index(): View
    {
        // Ambil pengumuman terbaru dan paginasi
        $pengumuman = Pengumuman::latest()->paginate(10);

        // Render view dengan data pengumuman
        return view('pengumumen.index', compact('pengumuman'));
    }

    /**
     * Menampilkan form untuk membuat pengumuman baru.
     *
     * @return View
     */
    public function create(): View
    {
        return view('pengumumen.create');
    }

    /**
     * Menyimpan pengumuman baru ke dalam database.
     *
     * @param  Request  $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        // Validasi form
        $request->validate([
            'foto'    => 'required|image|mimes:jpeg,jpg,png|max:2048',
            'judul'   => 'required|min:5',
            'isi'     => 'required|min:10',
            'tanggal' => 'required|date',
        ]);

        // Ambil input 'isi' tanpa menggunakan strip_tags
        $isi = $request->input('isi');
        $isi = str_replace('&nbsp;', ' ', $isi);  // Mengganti &nbsp; dengan spasi biasa
        $isi = trim($isi);  // Menghapus spasi ekstra

        // Menangani upload foto
        $foto = $request->file('foto');
        $fotoPath = $foto->storeAs('public/pengumumen', $foto->hashName());

        // Membuat pengumuman baru di database
        Pengumuman::create([
            'foto'    => $foto->hashName(),
            'judul'   => $request->judul,
            'isi'     => $isi,  // Gunakan isi yang sudah dibersihkan, tanpa strip_tags
            'tanggal' => $request->tanggal,
        ]);

        // Redirect dengan pesan sukses
        return redirect()->route('pengumumen.index')->with(['success' => 'Pengumuman Berhasil Disimpan!']);
    }

    /**
     * Menampilkan detail pengumuman berdasarkan ID.
     *
     * @param  string  $id
     * @return View
     */
    public function show(string $id): View
    {
        // Ambil pengumuman berdasarkan ID
        $pengumuman = Pengumuman::findOrFail($id);

        // Render view dengan data pengumuman
        return view('pengumumen.show', compact('pengumuman'));
    }

    /**
     * Menampilkan form untuk mengedit pengumuman berdasarkan ID.
     *
     * @param  string  $id
     * @return View
     */
    public function edit(string $id): View
    {
        // Ambil pengumuman berdasarkan ID
        $pengumuman = Pengumuman::findOrFail($id);

        // Render view dengan data pengumuman untuk diedit
        return view('pengumumen.edit', compact('pengumuman'));
    }

    /**
     * Memperbarui pengumuman yang sudah ada.
     *
     * @param  Request  $request
     * @param  string  $id
     * @return RedirectResponse
     */
    public function update(Request $request, string $id): RedirectResponse
    {
        // Validasi form
        $request->validate([
            'foto'    => 'image|mimes:jpeg,jpg,png|max:2048',
            'judul'   => 'required|min:5',
            'isi'     => 'required|min:10',
            'tanggal' => 'required|date',
        ]);

        // Ambil pengumuman berdasarkan ID
        $pengumuman = Pengumuman::findOrFail($id);

        // Ambil input 'isi' tanpa menggunakan strip_tags
        $isi = $request->input('isi');
        $isi = str_replace('&nbsp;', ' ', $isi);  // Mengganti &nbsp; dengan spasi biasa
        $isi = trim($isi);  // Menghapus spasi ekstra

        // Jika ada file foto baru
        if ($request->hasFile('foto')) {
            // Upload foto baru
            $foto = $request->file('foto');
            $fotoPath = $foto->storeAs('public/pengumumen', $foto->hashName());

            // Hapus foto lama jika ada
            if ($pengumuman->foto) {
                Storage::delete('public/pengumumen/' . $pengumuman->foto);
            }

            // Update pengumuman dengan foto baru
            $pengumuman->update([
                'foto'    => $foto->hashName(),
                'judul'   => $request->judul,
                'isi'     => $isi,
                'tanggal' => $request->tanggal,
            ]);
        } else {
            // Jika tidak ada foto baru, hanya update data lainnya
            $pengumuman->update([
                'judul'   => $request->judul,
                'isi'     => $isi,
                'tanggal' => $request->tanggal,
            ]);
        }

        // Redirect dengan pesan sukses
        return redirect()->route('pengumumen.index')->with(['success' => 'Pengumuman Berhasil Diperbarui!']);
    }
  /**
 * Hapus pengumuman berdasarkan ID.
 *
 * @param  mixed  $id
 * @return RedirectResponse
 */
public function destroy($id): RedirectResponse
{
    // Ambil pengumuman berdasarkan ID
    $pengumuman = Pengumuman::findOrFail($id);

    // Hapus foto jika ada
    if ($pengumuman->foto) {
        Storage::delete('public/pengumumen/' . $pengumuman->foto);
    }

    // Hapus pengumuman dari database
    $pengumuman->delete();

    // Redirect dengan pesan sukses
    return redirect()->route('pengumumen.index')->with(['success' => 'Pengumuman Berhasil Dihapus!']);
}

}
