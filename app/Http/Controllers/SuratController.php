<?php

namespace App\Http\Controllers;

use App\Models\Bidang;
use App\Models\Surat;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class SuratController extends Controller
{
    public function index()
    {

        // Ambil data surat dari database
        $surat = Surat::with(['disposisi'])->get(); // Sesuaikan dengan model Surat yang sudah Anda buat


        // Kirim data surat dan bidang ke view
        return view('pages.surat', compact('surat'));// Kirim ke view
    }

    public function store(Request $request): RedirectResponse
    {
        // Validasi input
        $request->validate([
            'nomor_surat' => 'required|string|max:255',
            'sifat_surat' => 'required|string|max:255',
            'isi_ringkasan' => 'required|string|max:255',
            'dari' => 'required|string|max:255',
            'kepada' => 'required|string|max:255',
            'tanggal_terima' => 'required|date',
            'tanggal_berakhir' => 'required|date',
            'catatan' => 'required|string|max:255'
        ]);

        // Menyimpan data surat
        Surat::create([
            'nomor_surat' => $request->nomor_surat,
            'sifat_surat' => $request->sifat_surat,
            'isi_ringkasan' => $request->isi_ringkasan,
            'dari' => $request->dari,
            'kepada' => $request->kepada,
            'tanggal_terima' => $request->tanggal_terima,
            'tanggal_berakhir' => $request->tanggal_berakhir,
            'catatan' => $request->catatan
        ]);

        // Redirect atau kembali dengan pesan sukses
        return redirect()->route('surat.index')->with('success', 'Data surat berhasil ditambahkan!');
    }

    public function update(Request $request, $id): RedirectResponse
{
    // Validasi input
    $request->validate([
        'nomor_surat' => 'required|string|max:255',
        'sifat_surat' => 'required|string|max:255',
        'isi_ringkasan' => 'required|string|max:255',
        'dari' => 'required|string|max:255',
        'kepada' => 'required|string|max:255',
        'tanggal_terima' => 'required|date',
        'tanggal_berakhir' => 'required|date',
        'catatan' => 'required|string|max:255'
    ]);

    // Mencari surat berdasarkan ID
    $surat = Surat::findOrFail($id);

    // Memperbarui data surat
    $surat->update([
        'nomor_surat' => $request->nomor_surat,
        'sifat_surat' => $request->sifat_surat,
        'isi_ringkasan' => $request->isi_ringkasan,
        'dari' => $request->dari,
        'kepada' => $request->kepada,
        'tanggal_terima' => $request->tanggal_terima,
        'tanggal_berakhir' => $request->tanggal_berakhir,
        'catatan' => $request->catatan
    ]);

    // Redirect atau kembali dengan pesan sukses
    return redirect()->route('surat.index')->with('success', 'Data surat berhasil diperbarui!');
}


    public function destroy($id)
{
    // Cari data surat berdasarkan ID
    $surat = Surat::findOrFail($id);

    // Hapus surat
    $surat->delete();

    // Redirect ke halaman index dengan pesan sukses
    return redirect()->route('surat.index')->with('success', 'Data surat berhasil dihapus!');
}




}

