<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckAdminBidang
{
    public function handle(Request $request, Closure $next)
    {
        // Periksa apakah pengguna terautentikasi dan memiliki id_bidang 4
        if (auth()->check() && auth()->user()->role == 'admin' && auth()->user()->id_bidang == 5) {
            return $next($request);
        }

        // Jika tidak memenuhi syarat, redirect ke halaman lain atau menampilkan pesan error
        return redirect()->route('dashboard.index')->with('error', 'Anda tidak memiliki akses ke halaman ini.');
    }
}

