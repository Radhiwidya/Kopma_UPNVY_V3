<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        if (!auth::check()) {
            return redirect('/');
        }

        $user = auth::user();
        
        // Ketua dapat mengakses semua halaman
        if ($user->hasRole('ketua')|| $user->hasRole('PT')) {
            return $next($request);
        }

        // Cek apakah user memiliki role yang diperlukan
        foreach ($roles as $role) {
            if ($user->hasRole($role)) {
                return $next($request);
            }
        }

        return redirect()->back()->with('error', 'Anda tidak memiliki akses ke halaman ini.');
    }
}