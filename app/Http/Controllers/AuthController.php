<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Siswa;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showAdminRegisterForm()
    {
        return view('auth.register-admin');
    }

    public function registerAdmin(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|confirmed',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'admin',
        ]);

        return redirect()->route('login')->with('success', 'Admin registered successfully!');
    }

    public function showSiswaRegisterForm()
    {
        return view('auth.register-siswa');
    }

    public function registerSiswa(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|confirmed',
            'kelas' => 'required|string|max:50',
            'tanggal_lahir' => 'required|date',
            'alamat' => 'nullable|string',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'siswa',
        ]);

        Siswa::create([
            'user_id' => $user->id,
            'kelas' => $request->kelas,
            'tanggal_lahir' => $request->tanggal_lahir,
            'alamat' => $request->alamat,
        ]);

        return redirect()->route('login')->with('success', 'Siswa registered successfully!');
    }
}
