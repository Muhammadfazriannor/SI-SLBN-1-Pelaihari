<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    // Method untuk registrasi pengguna
    public function register(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|max:255|unique:users',
            'password' => 'required|string|min:8'
        ]);

        // Jika validasi gagal
        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        // Membuat pengguna baru
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        // Membuat token untuk pengguna
        $token = $user->createToken('auth_token')->plainTextToken;

        // Mengembalikan response dengan data pengguna dan token
        return response()->json([
            'data' => $user,
            'access_token' => $token,
            'token_type' => 'Bearer'
        ]);
    }

    // Method untuk login pengguna
    public function login(Request $request)
    {
        // Mencoba login dengan email dan password
        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json([
                'message' => 'Unauthorized'
            ], 401);
        }

        // Mengambil pengguna berdasarkan email
        $user = User::where('email', $request->email)->firstOrFail();

        // Membuat token untuk pengguna
        $token = $user->createToken('auth_token')->plainTextToken;

        // Menyimpan token di session
        session(['access_token' => $token]);

        // Redirect ke dashboard setelah login sukses
        return redirect()->route('dashboard');
    }

    // Method untuk logout pengguna
    public function logout()
    {
        // Menghapus semua token pengguna
        Auth::user()->tokens()->delete();

        // Mengembalikan response sukses logout
        return response()->json([
            'message' => 'Logout success'
        ]);
    }
}

