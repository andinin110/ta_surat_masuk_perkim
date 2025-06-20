<?php

namespace App\Http\Controllers;

use App\Models\Bidang;
use App\Models\Disposisi;
use App\Models\Surat;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Hitung jumlah surat berdasarkan status
        $suratDiproses = Disposisi::where('status', 'Proses')->count();
        $suratBelumDiproses = Disposisi::where('status', 'Belum Diproses')->count();
        $suratSudahDiproses = Disposisi::where('status', 'Sudah Selesai')->count();
        $bidangCount = Bidang::withCount([
            'disposisi',
            'disposisi as disposisi_diproses_count' => function ($query) {
                $query->where('status', 'Proses');
            },
            'disposisi as disposisi_selesai_count' => function ($query) {
                $query->where('status', 'Sudah Selesai');
            }
        ])->get();

        // Kirim data ke view
        return view('pages.dashboard', compact('suratDiproses', 'suratBelumDiproses', 'suratSudahDiproses', 'bidangCount'));

    }

}
