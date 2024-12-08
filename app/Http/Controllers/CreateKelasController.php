<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
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

public function update(Request $request, $id_kelas)
{
    // Validate incoming data
    $validatedData = $request->validate([
        'nama_kelas' => 'required|string|max:45',
    ]);

    $kelas = Kelas::findOrFail($id_kelas);

    $existingData = Kelas::where('nama_kelas', $validatedData['nama_kelas'])
        ->where('id_kelas', '!=', $id_kelas)
        ->first();

    if ($existingData) {
        // Jika data dengan tahun_ajaran dan semester yang sama sudah ada (kecuali yang sedang diupdate)
        return redirect()->back()->withErrors(['error' => 'Data tahun ajaran dan semester yang sama sudah ada.']);
    }

    // Update the record with new values
    $kelas->nama_kelas = $validatedData['nama_kelas'];

    // Save the updated record
    $kelas->save();

    // Redirect or return response
    return redirect()->route('kelas')->with('success', 'Kelas updated successfully');
}

    public function destroy($id_kelas)
    {
        try {
            // Coba hapus data
            Kelas::findOrFail($id_kelas)->delete();

            // Jika berhasil, redirect dengan pesan sukses
            return redirect()->route('kelas')->with('delete', 'Kelas berhasil dihapus.');
        } catch (QueryException $e) {
            // Tangkap error foreign key constraint violation
            if ($e->getCode() === "23000") {
                // Redirect dengan pesan error
                return redirect()->route('kelas')->withErrors(['error' => 'Data tidak dapat dihapus karena berkorelasi dengan data lain.']);
            }

            // Jika error lain, lempar ulang
            throw $e;
        }
    }

}
