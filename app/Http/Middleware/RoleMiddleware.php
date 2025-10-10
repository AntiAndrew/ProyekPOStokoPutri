<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle($request, Closure $next, $role)
    {
        // Cek apakah user login dan punya role yang sesuai
        if (!Auth::check() || Auth::user()->role != $role) {
            abort(403, 'Akses ditolak.');
        }

        return $next($request);
    }
}
