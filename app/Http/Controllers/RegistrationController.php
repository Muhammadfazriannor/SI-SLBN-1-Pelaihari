<?php

namespace App\Http\Controllers;

use App\Models\Registration;
use Illuminate\Http\Request;

class RegistrationController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'status' => 'required|string',
        ]);

        $registration = Registration::create([
            'user_id' => auth()->id(),
            'status' => $request->status,
        ]);

        return back()->with('success', 'Pendaftaran berhasil dikirim.');
    }
}
