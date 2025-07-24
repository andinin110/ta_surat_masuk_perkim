<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Disposisi;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class DisposisiController extends Controller
{
    // Tampilkan semua data disposisi
    public function index()
    {
        $disposisi = Disposisi::with(['surat', 'bidang'])->latest()->get();

        return response()->json([
            'success' => true,
            'message' => 'Data disposisi berhasil diambil',
            'data' => $disposisi,
            'errors' => null
        ], 200);
    }

    // Simpan data disposisi baru
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'surat' => 'required|exists:surat,id',
            'bidang' => 'required|exists:bidang,id',
            'eviden' => 'required|file|mimes:jpg,png,pdf,doc,docx|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'data' => null,
                'errors' => $validator->errors()
            ], 422);
        }

        $evidenPath = $request->file('eviden')->store('eviden', 'public');

        $disposisi = Disposisi::create([
            'status' => 'Belum Diproses',
            'eviden' => $evidenPath,
            'id_surat' => $request->surat,
            'id_bidang' => $request->bidang,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Disposisi berhasil ditambahkan',
            'data' => $disposisi,
            'errors' => null
        ], 201);
    }

    // Tampilkan satu data disposisi
    public function show($id)
    {
        $disposisi = Disposisi::with(['surat', 'bidang'])->find($id);

        if (!$disposisi) {
            return response()->json([
                'success' => false,
                'message' => 'Data disposisi tidak ditemukan',
                'data' => null,
                'errors' => null
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Detail disposisi ditemukan',
            'data' => $disposisi,
            'errors' => null
        ], 200);
    }

    // Perbarui data disposisi
    public function update(Request $request, $id)
    {
        $disposisi = Disposisi::find($id);

        if (!$disposisi) {
            return response()->json([
                'success' => false,
                'message' => 'Data disposisi tidak ditemukan',
                'data' => null,
                'errors' => null
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'status' => 'required|in:Belum Diproses,Sedang Diproses,Selesai',
            'bidang' => 'required|exists:bidang,id',
            'eviden' => 'nullable|file|mimes:jpg,png,pdf,doc,docx|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'data' => null,
                'errors' => $validator->errors()
            ], 422);
        }

        if ($request->hasFile('eviden')) {
            if ($disposisi->eviden && Storage::disk('public')->exists($disposisi->eviden)) {
                Storage::disk('public')->delete($disposisi->eviden);
            }
            $disposisi->eviden = $request->file('eviden')->store('eviden', 'public');
        }

        $disposisi->status = $request->status;
        $disposisi->id_bidang = $request->bidang;
        $disposisi->save();

        return response()->json([
            'success' => true,
            'message' => 'Disposisi berhasil diperbarui',
            'data' => $disposisi,
            'errors' => null
        ], 200);
    }

    // Hapus data disposisi
    public function destroy($id)
    {
        $disposisi = Disposisi::find($id);

        if (!$disposisi) {
            return response()->json([
                'success' => false,
                'message' => 'Data disposisi tidak ditemukan',
                'data' => null,
                'errors' => null
            ], 404);
        }

        if ($disposisi->eviden && Storage::disk('public')->exists($disposisi->eviden)) {
            Storage::disk('public')->delete($disposisi->eviden);
        }

        $disposisi->delete();

        return response()->json([
            'success' => true,
            'message' => 'Disposisi berhasil dihapus',
            'data' => null,
            'errors' => null
        ], 200);
    }
}
