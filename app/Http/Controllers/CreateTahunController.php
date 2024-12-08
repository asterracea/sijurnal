<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
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
        'status' => 'required|in:Aktif,Tidak Aktif',
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
        'status' => $validatedData['status'],
    ]);

    // Redirect dengan pesan sukses
    return redirect()->route('tahun')->with('success', 'Data berhasil disimpan.');
}

public function update(Request $request, $id_tahun)
{
    // Validate incoming data
    $validatedData = $request->validate([
        'tahun_ajaran' => 'required|string|max:255',
        'semester' => 'required|string|in:Ganjil,Genap',
        'status' => 'required|string|in:Aktif,Tidak Aktif',
    ]);

    // Find the record to update
    $tahun = Tahun::findOrFail($id_tahun);

    // Cek duplikasi data, kecuali pada data yang sedang diupdate
    $existingData = Tahun::where('tahun_ajaran', $validatedData['tahun_ajaran'])
        ->where('semester', $validatedData['semester'])
        ->where('status', $validatedData['status'])
        ->where('id_tahun', '!=', $id_tahun) // Mengecualikan record yang sedang diupdate
        ->first();

    if ($existingData) {
        // Jika data dengan tahun_ajaran dan semester yang sama sudah ada (kecuali yang sedang diupdate)
        return redirect()->back()->withErrors(['error' => 'Data tahun ajaran dan semester yang sama sudah ada.']);
    }

    // Update the record with new values
    $tahun->tahun_ajaran = $validatedData['tahun_ajaran'];
    $tahun->semester = $validatedData['semester'];
    $tahun->status = $validatedData['status'];

    // Save the updated record
    $tahun->save();

    // Redirect or return response
    return redirect()->route('tahun')->with('success', 'Tahun ajaran updated successfully');
}

    public function destroy($id_tahun)
    {
        try {
            // Coba hapus data
            Tahun::findOrFail($id_tahun)->delete();

            // Jika berhasil, redirect dengan pesan sukses
            return redirect()->route('tahun')->with('delete', 'Tahun ajaran berhasil dihapus.');
        } catch (QueryException $e) {
            // Tangkap error foreign key constraint violation
            if ($e->getCode() === "23000") {
                // Redirect dengan pesan error
                return redirect()->route('tahun')->withErrors(['error' => 'Data tidak dapat dihapus karena berkorelasi dengan data lain.']);
            }

            // Jika error lain, lempar ulang
            throw $e;
        }
    }


}
