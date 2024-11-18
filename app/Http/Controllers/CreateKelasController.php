<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kelas;

class CreateKelasController extends Controller
{
    public function index()
    {
    $kelas = Kelas::all(); // Mengambil semua data tanpa relasi
    return view('admin.kelas', compact('kelas'));
    }


    public function store(Request $request)
{
    // Validasi input
    $validatedData = $request->validate([
        'nama_kelas' => 'required|string|max:45',
    ]);

    // Cek duplikasi data
    $existingData = Kelas::where('nama_kelas', $validatedData['nama_kelas'])
        ->first();

    if ($existingData) {
        return redirect()->back()->withErrors(['error' => 'Data kelas yang sama sudah ada.']);
    }

    // Simpan data ke tb_tahun jika tidak ada duplikat
    Kelas::create([
        'nama_kelas' => $validatedData['nama_kelas'],
    ]);

    // Redirect dengan pesan sukses
    return redirect()->route('kelas')->with('success', 'Data berhasil disimpan.');
}


}
