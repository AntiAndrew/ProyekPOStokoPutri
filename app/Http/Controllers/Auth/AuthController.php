<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User; // Pastikan Model User diimport

class AuthController extends Controller
{
    /**
     * Menampilkan form login.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLoginForm()
    {
        // Jika pengguna sudah login, alihkan langsung ke dashboard
       // if (Auth::check()) {
         //   return redirect()->route('dashboard.index');
       // }
        
        return view('auth.login');
    }
    
    /**`
     * Proses login pengguna.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            // Redirect ke dashboard.index setelah login berhasil
            return redirect()->route('dashboard.index');
        }

        return back()->withErrors([
            'email' => 'Email atau password salah!',
        ])->onlyInput('email');
    }

    /**
     * Menampilkan form register.
     *
     * @return \Illuminate\Http\Response
     */
    public function showRegisterForm()
    {
        // Jika pengguna sudah login, alihkan langsung ke dashboard
       // if (Auth::check()) {
          //  return redirect()->route('dashboard.index');
       // }
        
        return view('auth.register');
    }

    /**
     * Proses registrasi pengguna baru.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email:dns|max:255|unique:users',
            'noTelepon' => 'required|string|min:8|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'noTelepon' => $request->noTelepon,
            'password' => Hash::make($request->password),
            'role' => 'pegawai',
        ]);

        // Langsung login pengguna setelah registrasi berhasil
        Auth::login($user);

        // Arahkan ke route dashboard.index
        return redirect()->route('dashboard.index');
    }

    /**
     * Proses logout.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
