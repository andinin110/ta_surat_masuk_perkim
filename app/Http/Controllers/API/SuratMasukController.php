<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Surat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SuratMasukController extends Controller
{
    // Ambil semua surat masuk
    public function index()
    {
        $surat = Surat::with(['bidang', 'disposisi'])->orderBy('created_at', 'desc')->get();

        if ($surat->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'Tidak ada data surat masuk ditemukan',
                'data' => []
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Data semua surat masuk berhasil diambil',
            'data' => $surat
        ], 200);
    }

    // Simpan surat baru
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nomor_surat' => 'required',
            'sifat_surat' => 'required',
            'isi_ringkasan' => 'required',
            'dari' => 'required',
            'kepada' => 'required',
            'tanggal_terima' => 'required|date',
            'tanggal_berakhir' => 'required|date',
            'catatan' => 'nullable',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $validator->errors()
            ], 422);
        }

        $surat = Surat::create($validator->validated());

        return response()->json([
            'success' => true,
            'message' => 'Surat masuk berhasil ditambahkan',
            'data' => $surat
        ], 201);
    }

    // Tampilkan satu surat masuk
    public function show($id)
    {
        $surat = Surat::with('bidang', 'disposisi')->find($id);

        if (!$surat) {
            return response()->json([
                'success' => false,
                'message' => 'Surat tidak ditemukan',
                'data' => null
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Detail surat masuk berhasil ditemukan',
            'data' => $surat
        ], 200);
    }

    // Perbarui surat masuk
    public function update(Request $request, $id)
    {
        $surat = Surat::find($id);

        if (!$surat) {
            return response()->json([
                'success' => false,
                'message' => 'Surat tidak ditemukan'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'nomor_surat' => 'required',
            'sifat_surat' => 'required',
            'isi_ringkasan' => 'required',
            'dari' => 'required',
            'kepada' => 'required',
            'tanggal_terima' => 'required|date',
            'tanggal_berakhir' => 'required|date',
            'catatan' => 'nullable',
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
            'message' => 'Surat masuk berhasil diperbarui',
            'data' => $surat
        ], 200);
    }

    // Hapus surat masuk
    public function destroy($id)
    {
        $surat = Surat::find($id);

        if (!$surat) {
            return response()->json([
                'success' => false,
                'message' => 'Surat tidak ditemukan'
            ], 404);
        }

        $surat->delete();

        return response()->json([
            'success' => true,
            'message' => 'Surat masuk berhasil dihapus'
        ], 200);
    }
}
