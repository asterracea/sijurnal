<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mapel;

class CreateMapelController extends Controller
{
    public function index()
    {
    $mapel = Mapel::all(); // Mengambil semua data tanpa relasi
    return view('admin.mapel', compact('mapel'));
    }


    public function store(Request $request)
{
    // Validasi input
    $validatedData = $request->validate([
        'nama_mapel' => 'required|string|max:45',
    ]);

    // Cek duplikasi data
    $existingData = Mapel::where('nama_mapel', $validatedData['nama_mapel'])
        ->first();

    if ($existingData) {
        return redirect()->back()->withErrors(['error' => 'Data mata pelajaran yang sama sudah ada.']);
    }

    // Simpan data ke tb_tahun jika tidak ada duplikat
    Mapel::create([
        'nama_mapel' => $validatedData['nama_mapel'],
    ]);

    // Redirect dengan pesan sukses
    return redirect()->route('mapel')->with('success', 'Data berhasil disimpan.');
}


}
