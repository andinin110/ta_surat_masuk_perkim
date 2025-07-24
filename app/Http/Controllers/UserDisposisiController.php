<?php

namespace App\Http\Controllers;

use App\Models\Bidang;
use App\Models\Disposisi;
use App\Models\Surat;
use Auth;
use Illuminate\Http\Request;

class UserDisposisiController extends Controller
{
    public function index()
    {
        // Ambil id_bidang pengguna yang sedang login
        $idBidangUser = Auth::user()->id_bidang;

        // Ambil disposisi dan surat yang terkait dengan bidang pengguna yang login
        $disposisi = Disposisi::where('id_bidang', $idBidangUser)->get();
        $surats = Surat::where('id_bidang', $idBidangUser)->get();

        // Ambil bidang dan sub-bidang yang terkait dengan pengguna (untuk menampilkan data bidang)
        $bidangs = Bidang::where('id', $idBidangUser)->get();

        // Kirim data ke view
        return view('pages.user.disposisi', compact('disposisi', 'surats', 'bidangs'));
    }

    public function updateStatus(Request $request, $id)
    {
        // Cari data disposisi berdasarkan ID
        $disposisi = Disposisi::findOrFail($id);

        // Update status berdasarkan permintaan
        if ($disposisi->status == 'Belum Diproses') {
            $disposisi->status = 'Proses';
        } elseif ($disposisi->status == 'Proses') {
            $disposisi->status = 'Sudah Selesai';
        }

        // Simpan perubahan ke database
        $disposisi->save();

        // Redirect kembali ke halaman dengan pesan sukses
        return redirect()->route('userdisposisi.index')->with('success', 'Status berhasil diperbarui!');
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'surat' => 'required|integer|exists:surat,id', // Validasi id_surat
            'eviden' => 'required|file|mimes:jpg,png,pdf,doc,docx|max:2048', // Validasi file eviden
            'bidang' => 'required|integer|exists:bidang,id', // Validasi id_bidang
            'sub_bidang' => 'nullable|integer|exists:sub_bidang,id', // Validasi sub_bidang, bisa null
        ]);

        // Proses upload file eviden
        $evidenPath = $request->file('eviden')->store('eviden', 'public');

        // Menyimpan data ke tabel disposisi
        Disposisi::create([
            'status' => 'Belum Diproses', // Default status
            'eviden' => $evidenPath,
            'id_bidang' => $request->bidang,
            'id_sub_bidang' => $request->sub_bidang ?? null, // Menyimpan id_sub_bidang jika ada
            'id_surat' => $request->surat,
        ]);

        // Redirect dengan pesan sukses
        return redirect()->route('disposisi.index')->with('success', 'Data disposisi berhasil ditambahkan!');
    }


    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'status' => 'required|string|in:Belum Diproses,Sedang Diproses,Selesai', // Validasi status
            'eviden' => 'nullable|file|mimes:jpg,png,pdf,doc,docx|max:2048', // Validasi file eviden
            'bidang' => 'required|integer|exists:bidang,id', // Validasi id_bidang
            'sub_bidang' => 'nullable|integer|exists:sub_bidang,id', // Validasi id_sub_bidang jika ada
        ]);

        // Temukan data disposisi berdasarkan ID
        $disposisi = Disposisi::findOrFail($id);

        // Proses unggah file eviden jika ada
        if ($request->hasFile('eviden')) {
            // Hapus file eviden lama jika ada
            if ($disposisi->eviden && \Storage::disk('public')->exists($disposisi->eviden)) {
                \Storage::disk('public')->delete($disposisi->eviden);
            }

            // Simpan file eviden baru
            $evidenPath = $request->file('eviden')->store('eviden', 'public');
            $disposisi->eviden = $evidenPath;
        }

        // Update data disposisi
        $disposisi->status = $request->status;
        $disposisi->id_bidang = $request->bidang;
        $disposisi->id_sub_bidang = $request->sub_bidang; // Menyimpan Sub Bidang
        $disposisi->save();

        // Redirect dengan pesan sukses
        return redirect()->route('disposisi.index')->with('success', 'Data disposisi berhasil diperbarui!');
    }



    public function destroy($id)
    {
        // Cari data surat berdasarkan ID
        $disposisi = Disposisi::findOrFail($id);

        // Hapus surat
        $disposisi->delete();

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('disposisi.index')->with('success', 'Data surat berhasil dihapus!');
    }
}

