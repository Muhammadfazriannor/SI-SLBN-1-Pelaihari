<?php
namespace App\Http\Controllers;

use App\Models\Pengumuman;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class PengumumanController extends Controller
{
    /**
     * Display a listing of the Pengumuman.
     *
     * @return View
     */
    public function index() : View
    {
        // Get all pengumuman, paginated
        $pengumuman = Pengumuman::latest()->paginate(10);

        // Render view with pengumuman data
        return view('pengumumen.index', compact('pengumuman'));
    }

    /**
     * Show the form for creating a new Pengumuman.
     *
     * @return View
     */
    public function create(): View
    {
        return view('pengumumen.create');
    }

    /**
     * Store a newly created Pengumuman in storage.
     *
     * @param  Request  $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        // Validate the form data
        $request->validate([
            'foto'    => 'required|image|mimes:jpeg,jpg,png|max:2048',
            'judul'   => 'required|min:5',
            'isi'     => 'required|min:10',
            'tanggal' => 'required|date',
        ]);

        // Sanitize and clean the 'isi' field before saving
        $isi = $request->input('isi');
        
        // Remove unwanted HTML tags and only allow <p>, <b>, <i>, <u>, <br>, <ul>, <ol>, <li>
        $isi = strip_tags($isi, '<p><b><i><u><br><ul><ol><li>');

        // Replace non-breaking spaces (&nbsp;) with regular spaces
        $isi = str_replace('&nbsp;', ' ', $isi);

        // Trim any unnecessary spaces
        $isi = trim($isi);

        // Upload the image if provided
        $foto = $request->file('foto');
        $fotoPath = $foto->storeAs('public/pengumumen', $foto->hashName());

        // Create a new Pengumuman record
        Pengumuman::create([
            'foto'    => $foto->hashName(),
            'judul'   => $request->judul,
            'isi'     => $isi,  // Use the sanitized 'isi'
            'tanggal' => $request->tanggal,
        ]);

        // Redirect to index with success message
        return redirect()->route('pengumumen.index')->with(['success' => 'Pengumuman Berhasil Disimpan!']);
    }
}
