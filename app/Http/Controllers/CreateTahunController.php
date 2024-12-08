<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Tahun;

class CreateTahunController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $accountname = $user->profile; 
        $tahun = Tahun::all(); // Mengambil semua data tanpa relasi
        return view('admin.tahun', compact('tahun','accountname'));
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

public function update(Request $request, $id_tahun)
{
    // Validate incoming data
    $validatedData = $request->validate([
        'tahun_ajaran' => 'required|string|max:255',
        'semester' => 'required|string|in:Ganjil,Genap',
    ]);

    // Find the record to update
    $tahun = Tahun::findOrFail($id_tahun);

    // Cek duplikasi data, kecuali pada data yang sedang diupdate
    $existingData = Tahun::where('tahun_ajaran', $validatedData['tahun_ajaran'])
        ->where('semester', $validatedData['semester'])
        ->where('id_tahun', '!=', $id_tahun) // Mengecualikan record yang sedang diupdate
        ->first();

    if ($existingData) {
        // Jika data dengan tahun_ajaran dan semester yang sama sudah ada (kecuali yang sedang diupdate)
        return redirect()->back()->withErrors(['error' => 'Data tahun ajaran dan semester yang sama sudah ada.']);
    }

    // Update the record with new values
    $tahun->tahun_ajaran = $validatedData['tahun_ajaran'];
    $tahun->semester = $validatedData['semester'];

    // Save the updated record
    $tahun->save();

    // Redirect or return response
    return redirect()->route('tahun')->with('success', 'Tahun ajaran updated successfully');
}

public function destroy($id_tahun)
{
    // Find the record to delete
    $tahun = Tahun::findOrFail($id_tahun);

    // Delete the record
    $tahun->delete();

    // Redirect back with success message
    return redirect()->route('tahun')->with('success', 'Tahun ajaran berhasil dihapus');
}

}
