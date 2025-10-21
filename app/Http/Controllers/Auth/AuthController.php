<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    // 🧭 Menampilkan form login
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // 🧾 Proses login
    public function login(Request $request)
    {
        $credentials = $request->only('id', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // Arahkan berdasarkan role
            if (Auth::user()->role === 'admin') {
                return redirect()->route('dashboard.admin');
            } else {
                return redirect()->route('dashboard.pegawai');
            }
        }

        return back()->withErrors([
            'email' => 'Email atau password salah!',
        ]);
    }

    // 🧭 Menampilkan form register
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    // ✍️ Proses register
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'noTelepon' => 'required|noTelepon|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'noTelepon' => $request->noTelepon,
            'password' => Hash::make($request->password),
            'role' => 'pegawai', // default pegawai, admin bisa ubah dari dashboard
        ]);

        return redirect()->route('login')->with('success', 'Akun berhasil dibuat!');
    }

    // 🚪 Logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
