<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SuratKeluar;

class SuratKeluarController extends Controller
{
    public function index()
    {
        $surat = SuratKeluar::latest()->paginate(10);
        return view('pages.surat_keluar', compact('surat'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nomor_surat' => 'required|string|max:255',
            'sifat_naskah' => 'required|string|max:255',
            'isi_ringkasan' => 'required|string',
            'asal_surat' => 'required|string|max:255',
            'tujuan' => 'required|string|max:255',
            'tanggal_terima' => 'required|date',
            'waktu_terima' => 'required',
            'batas_berakhir' => 'required|date',
            'waktu_berakhir' => 'required',
            'catatan' => 'nullable|string',
            'eviden' => 'nullable|file|mimes:pdf,jpg,png,docx|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('eviden')) {
            $data['eviden'] = $request->file('eviden')->store('eviden', 'public');
        }

        SuratKeluar::create($data);

        return redirect()->back()->with('success', 'Surat keluar berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nomor_surat' => 'required|string|max:255',
            'sifat_naskah' => 'required|string|max:255',
            'isi_ringkasan' => 'required|string',
            'asal_surat' => 'required|string|max:255',
            'tujuan' => 'required|string|max:255',
            'tanggal_terima' => 'required|date',
            'waktu_terima' => 'required',
            'batas_berakhir' => 'required|date',
            'waktu_berakhir' => 'required',
            'catatan' => 'nullable|string',
            'eviden' => 'nullable|file|mimes:pdf,jpg,png,docx|max:2048',
        ]);

        $surat = SuratKeluar::findOrFail($id);
        $data = $request->all();

        if ($request->hasFile('eviden')) {
            $data['eviden'] = $request->file('eviden')->store('eviden', 'public');
        }

        $surat->update($data);

        return redirect()->back()->with('success', 'Surat keluar berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $surat = SuratKeluar::findOrFail($id);
        $surat->delete();

        return redirect()->back()->with('success', 'Surat keluar berhasil dihapus.');
    }
}
