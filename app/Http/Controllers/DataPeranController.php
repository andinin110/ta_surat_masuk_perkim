<?php

namespace App\Http\Controllers;

use App\Models\DataPeran;
use Illuminate\Http\Request;


class DataPeranController extends Controller
{
    public function index()
    {
        $peran = DataPeran::all();
        return view('pages.user.peran', compact('peran'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'nullable|string|max:500',
        ]);

        $peran = new DataPeran();
        $peran->nama = $request->nama;
        $peran->deskripsi = $request->deskripsi;
        $peran->save();

        return redirect()->back()->with('success', 'Peran berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'nullable|string|max:500',
        ]);

        $peran = DataPeran::findOrFail($id);
        $peran->nama = $request->nama;
        $peran->deskripsi = $request->deskripsi;
        $peran->save();

        return redirect()->back()->with('success', 'Peran berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $peran = DataPeran::findOrFail($id);
        $peran->delete();

        return redirect()->back()->with('success', 'Peran berhasil dihapus!');
    }
}
