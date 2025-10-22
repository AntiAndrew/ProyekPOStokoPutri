<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle($request, Closure $next, $role)
    {
        // Pastikan user sudah login
        if (!Auth::check()) {
            return redirect('/login');
        }

        //Cek apakah role user sesuai
       if (Auth::user()->role !== $role) {
            abort(403, 'Akses ditolak.');
        }

        return $next($request);
    }
}
