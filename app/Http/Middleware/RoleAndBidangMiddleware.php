<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleAndBidangMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $role
     * @param  int|null  $id_bidang
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $role, $id_bidang = null)
    {
        // Periksa apakah user sudah login
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }

        $user = auth()->user();

        // Periksa apakah role sesuai
        if ($user->role !== $role) {
            return redirect()->route('dashboard.index')->with('error', 'Anda tidak memiliki akses ke halaman ini.');
        }

        // Periksa apakah id_bidang sesuai (jika diperlukan)
        if ($id_bidang !== null && $user->id_bidang != $id_bidang) {
            return redirect()->route('dashboard.index')->with('error', 'Anda tidak memiliki akses ke bidang ini.');
        }

        return $next($request);
    }
}
