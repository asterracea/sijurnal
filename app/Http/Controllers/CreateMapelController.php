<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use App\Models\Mapel;

class CreateMapelController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $accountname = $user->profile; 
        $mapel = Mapel::all(); // Mengambil semua data tanpa relasi
        return view('admin.mapel', compact('mapel','accountname'));
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

    Mapel::create([
        'nama_mapel' => $validatedData['nama_mapel'],
    ]);

    // Redirect dengan pesan sukses
    return redirect()->route('mapel')->with('success', 'Data berhasil disimpan.');
}

public function update(Request $request, $id_mapel)
{
    // Validate incoming data
    $validatedData = $request->validate([
        'nama_mapel' => 'required|string|max:45',
    ]);

    // Find the record to update
    $mapel = Mapel::findOrFail($id_mapel);

    // Cek duplikasi data, kecuali pada data yang sedang diupdate
    $existingData = Mapel::where('nama_mapel', $validatedData['nama_mapel'])
        ->where('id_mapel', '!=', $id_mapel) // Mengecualikan record yang sedang diupdate
        ->first();

    if ($existingData) {
        return redirect()->back()->withErrors(['error' => 'Data mata pelajaran yang sama sudah ada.']);
    }

    // Update the record with new values
    $mapel->nama_mapel = $validatedData['nama_mapel'];

    // Save the updated record
    $mapel->save();

    // Redirect or return response
    return redirect()->route('mapel')->with('success', 'Mata pelajaran berhasil diupdate');
}

    public function destroy($id_mapel)
    {
        try {
            // Coba hapus data
            Mapel::findOrFail($id_mapel)->delete();

            // Jika berhasil, redirect dengan pesan sukses
            return redirect()->route('mapel')->with('delete', 'Mata pelajaran berhasil dihapus.');
        } catch (QueryException $e) {
            // Tangkap error foreign key constraint violation
            if ($e->getCode() === "23000") {
                // Redirect dengan pesan error
                return redirect()->route('mapel')->withErrors(['error' => 'Data tidak dapat dihapus karena berkorelasi dengan data lain.']);
            }

            // Jika error lain, lempar ulang
            throw $e;
        }
    }

}
