<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SuratKeluar;
use Illuminate\Support\Facades\Validator;

class SuratKeluarController extends Controller
{
    // Ambil semua data surat keluar
    public function index()
    {
        $surat = SuratKeluar::latest()->get();

        if ($surat->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'Tidak ada data surat keluar ditemukan',
                'data' => []
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Data surat keluar berhasil diambil',
            'data' => $surat
        ], 200);
    }

    // Simpan data baru
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
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

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $validator->errors()
            ], 422);
        }

        $surat = SuratKeluar::create($validator->validated());

        return response()->json([
            'success' => true,
            'message' => 'Surat keluar berhasil ditambahkan',
            'data' => $surat
        ], 201);
    }

    // Tampilkan satu data surat keluar
    public function show($id)
    {
        $surat = SuratKeluar::find($id);

        if (!$surat) {
            return response()->json([
                'success' => false,
                'message' => 'Surat tidak ditemukan',
                'data' => null
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Detail surat keluar ditemukan',
            'data' => $surat
        ], 200);
    }

    // Update data surat keluar
    public function update(Request $request, $id)
    {
        $surat = SuratKeluar::find($id);

        if (!$surat) {
            return response()->json([
                'success' => false,
                'message' => 'Surat tidak ditemukan'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
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

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $validator->errors()
            ], 422);
        }

        $surat->update($validator->validated());

        return response()->json([
            'success' => true,
            'message' => 'Surat keluar berhasil diperbarui',
            'data' => $surat
        ], 200);
    }

    // Hapus surat keluar
    public function destroy($id)
    {
        $surat = SuratKeluar::find($id);

        if (!$surat) {
            return response()->json([
                'success' => false,
                'message' => 'Surat tidak ditemukan'
            ], 404);
        }

        $surat->delete();

        return response()->json([
            'success' => true,
            'message' => 'Surat keluar berhasil dihapus'
        ], 200);
    }
}
