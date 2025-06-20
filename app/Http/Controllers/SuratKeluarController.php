<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SuratKeluar;

class SuratKeluarController extends Controller
{
    public function index()
    {
        $surat = SuratKeluar::latest()->get();
        return view('pages.surat_keluar', compact('surat'));
    }

    /**
     * Simpan data surat keluar baru.
     */
    public function store(Request $request)
    {
        $request->validate([
            'dikirim_melalui' => 'required|string|max:255',
            'jenis_naskah' => 'required|string|max:255',
            'sifat_naskah' => 'required|string|max:255',
            'klasifikasi' => 'required|string|max:255',
            'hal' => 'required|string|max:255',
            'isi_ringkasan' => 'required|string',
            'tujuan' => 'required|string|max:255',
            'verifikator' => 'required|string|max:255',
            'tanggal_keluar' => 'required|date',
        ]);

        SuratKeluar::create($request->all());

        return redirect()->back()->with('success', 'Surat keluar berhasil ditambahkan.');
    }

    /**
     * Perbarui data surat keluar.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'dikirim_melalui' => 'required|string|max:255',
            'jenis_naskah' => 'required|string|max:255',
            'sifat_naskah' => 'required|string|max:255',
            'klasifikasi' => 'required|string|max:255',
            'hal' => 'required|string|max:255',
            'isi_ringkasan' => 'required|string',
            'tujuan' => 'required|string|max:255',
            'verifikator' => 'required|string|max:255',
            'tanggal_keluar' => 'required|date',
        ]);

        $surat = SuratKeluar::findOrFail($id);
        $surat->update($request->all());

        return redirect()->back()->with('success', 'Surat keluar berhasil diperbarui.');
    }

    /**
     * Hapus data surat keluar.
     */
    public function destroy($id)
    {
        $surat = SuratKeluar::findOrFail($id);
        $surat->delete();

        return redirect()->back()->with('success', 'Surat keluar berhasil dihapus.');
    }
}
