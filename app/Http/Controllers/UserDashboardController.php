<?php

namespace App\Http\Controllers;

use App\Models\Bidang;
use App\Models\Disposisi;
use App\Models\Surat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserDashboardController extends Controller
{
    public function index()
    {
        // Ambil id_bidang pengguna yang sedang login
        $idBidangUser = Auth::user()->id_bidang;

        // Hitung jumlah surat berdasarkan status, hanya untuk bidang yang sesuai dengan pengguna
        $suratDiproses = Disposisi::where('status', 'Proses')
                                ->where('id_bidang', $idBidangUser)
                                ->count();
        $suratBelumDiproses = Disposisi::where('status', 'Belum Diproses')
                                       ->where('id_bidang', $idBidangUser)
                                       ->count();
        $suratSudahDiproses = Disposisi::where('status', 'Sudah Selesai')
                                       ->where('id_bidang', $idBidangUser)
                                       ->count();


        // Kirim data ke view
        return view('pages.user.dashboard', compact('suratDiproses', 'suratBelumDiproses', 'suratSudahDiproses'));
    }

}
