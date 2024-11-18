<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tahun;

class CreateTahunController extends Controller
{
    public function index()
    {
    $tahun = Tahun::all(); // Mengambil semua data tanpa relasi
    return view('admin.tahun', compact('tahun'));
    }


    public function store(Request $request)
{
    // Validasi input
    $validatedData = $request->validate([
        'tahun_ajaran' => 'required|string|max:10',
        'semester' => 'required|in:Ganjil,Genap',
    ]);

    // Cek duplikasi data
    $existingData = Tahun::where('tahun_ajaran', $validatedData['tahun_ajaran'])
        ->where('semester', $validatedData['semester'])
        ->first();

    if ($existingData) {
        // Jika data dengan tahun_ajaran dan semester yang sama sudah ada, kembalikan pesan error
        return redirect()->back()->withErrors(['error' => 'Data tahun ajaran dan semester yang sama sudah ada.']);
    }

    // Simpan data ke tb_tahun jika tidak ada duplikat
    Tahun::create([
        'tahun_ajaran' => $validatedData['tahun_ajaran'],
        'semester' => $validatedData['semester'],
    ]);

    // Redirect dengan pesan sukses
    return redirect()->route('tahun')->with('success', 'Data berhasil disimpan.');
}

public function update(Request $request, $id)
{
    $request->validate([
        'tahun_ajaran' => 'required|string',
        'semester' => 'required|in:Ganjil,Genap',
    ]);

    $tahun = Tahun::findOrFail($id);
    $tahun->update([
        'tahun_ajaran' => $request->tahun_ajaran,
        'semester' => $request->semester,
    ]);

    return redirect()->route('tahun.index')->with('success', 'Tahun ajaran berhasil diperbarui!');
}



}
