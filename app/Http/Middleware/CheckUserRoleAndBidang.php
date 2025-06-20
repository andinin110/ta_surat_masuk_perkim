<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckUserRoleAndBidang
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        // Cek apakah role user adalah 'user' dan id_bidang bukan 4
        if (Auth::check() && Auth::user()->role === 'user' && Auth::user()->id_bidang != 5) {
            return $next($request); // Akses diperbolehkan jika kondisi terpenuhi
        }

        // Redirect ke halaman lain jika tidak memenuhi kondisi
        return redirect()->route('dashboard.index'); // Ganti dengan route lain jika perlu
    }
}
