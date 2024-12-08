<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Broadcast;

class AnnouncementController extends Controller
{
    public function index()
    {
        return view('admin.dashboard'); // Tampilkan dashboard admin
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
        ]);

        $announcement = Announcement::create($request->only(['title', 'content']));

        // Broadcast pengumuman baru ke user
        Broadcast::channel('announcements')->broadcast('new-announcement', $announcement);

        return back()->with('success', 'Pengumuman berhasil ditambahkan.');
    }

    public function userDashboard()
    {
        $announcements = Announcement::latest()->get();
        return view('user.dashboard', compact('announcements'));
    }
}
