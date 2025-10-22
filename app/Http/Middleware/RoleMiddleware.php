<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @param  string|null  $role
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, $role = null)
    {
        // === PENCEGAHAN REDIRECT LOOP UTAMA ===
        // Blok ini HARUS ADA di awal untuk membiarkan route login/register lewat
        $routeName = $request->route() ? $request->route()->getName() : null;

        if (in_array($routeName, ['login', 'register', 'logout', 'login.post', 'register.post'])) {
    return $next($request);
}

        // 1. Cek apakah user sudah login
        if (!Auth::check()) {
            // Jika belum login, alihkan ke halaman login
            return redirect()->route('login');
        }

        // 2. Cek Role (Hanya jika $role diminta di route:middleware)
        if ($role !== null && Auth::user()->role !== $role) {
            // Jika user login, tapi role-nya tidak sesuai, tolak akses.
            return abort(403, 'Akses ditolak. Role tidak sesuai.');
        }

        // 3. Jika semua pemeriksaan sukses, lanjutkan request
        return $next($request);
    }
}
