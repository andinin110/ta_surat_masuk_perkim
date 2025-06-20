<?php

namespace App\Http\Controllers;

use App\Models\Instansi;
use Illuminate\Http\Request;

class DataInstansiController extends Controller
{
    public function index()
    {
        $instansi = Instansi::all(); // Gunakan huruf kecil
        return view('pages.instansi', compact('instansi')); // Konsisten dengan nama variabel
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $instansi = new Instansi();
        $instansi->name = $request->name;
        $instansi->save();

        return redirect()->back()->with('success', 'Instansi berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $instansi = Instansi::findOrFail($id);
        $instansi->name = $request->name;
        $instansi->save();

        return redirect()->back()->with('success', 'Instansi berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $instansi = Instansi::findOrFail($id);
        $instansi->delete();

        return redirect()->back()->with('success', 'Instansi berhasil dihapus!');
    }
}
