<?php

namespace App\Http\Controllers;

use App\Models\Bidang;
use App\Models\Disposisi;
use App\Models\Surat;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;


class DisposisiController extends Controller
{
    public function index()
    {
        $disposisi = Disposisi::all(); // Gunakan huruf kecil
        $surats = Surat::all(); // Gunakan huruf kecil
        $bidangs = Bidang::all();
        return view('pages.disposisi', compact('disposisi', 'surats','bidangs')); // Kirim ke view
    }



    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'surat' => 'required|integer|exists:surat,id', // Validasi id_surat
            'eviden' => 'required|file|mimes:jpg,png,pdf,doc,docx|max:2048', // Validasi file eviden
            'bidang' => 'required|integer|exists:bidang,id', // Validasi id_bidang
        ]);

        // Proses upload file eviden
        $evidenPath = $request->file('eviden')->store('eviden', 'public');

        // Menyimpan data ke tabel disposisi
        Disposisi::create([
            'status' => 'Belum Diproses', // Default status
            'eviden' => $evidenPath,
            'id_bidang' => $request->bidang,
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
public function qrcode($id)
{
    try {
        // Ambil data disposisi beserta relasinya
        $disposisi = Disposisi::with(['bidang', 'surat'])->findOrFail($id);

        // Data yang akan dimasukkan ke dalam QR Code (misalnya link detail disposisi)
        $qrData = route('disposisi.view', $id); // link menuju view detail

        // Kirim ke view dengan data disposisi dan QR code
        return view('pages.qrcode', compact('disposisi', 'qrData'));
    } catch (\Exception $e) {
        return redirect()->route('disposisi.index')->with('error', 'Data disposisi tidak ditemukan.');
    }
}


}

