<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jadwal;
use App\Models\Kelas;
use App\Models\DataGuru;
use App\Models\Tahun;
use App\Models\Mapel;

class CreateJadwalController extends Controller
{

    public function index()
{
    $gurus = DataGuru::all();
    $tahun = Tahun::all();
    $kelas = Kelas::all();
    $mapel = Mapel::all();
    $jadwal = Jadwal::all();

    return view('admin.datajadwal', compact('gurus', 'tahun', 'kelas', 'mapel', 'jadwal'));
}

    public function store(Request $request)
{
    $request->validate([
        'nip' => 'required|exists:tb_guru,nip',
        'id_tahun' => 'required|exists:tb_tahun,id_tahun',
        'id_kelas' => 'required|exists:tb_kelas,id_kelas',
        'id_mapel' => 'required|exists:tb_mapel,id_mapel',
    ]);

    $jadwal = new Jadwal();
    $jadwal->nip = $request->nip;
    $jadwal->id_tahun = $request->id_tahun;
    $jadwal->id_kelas = $request->id_kelas;
    $jadwal->id_mapel = $request->id_mapel;
    $jadwal->hari = $request->hari;
    $jadwal->jam_mulai = $request->jam_mulai;
    $jadwal->jam_selesai = $request->jam_selesai;
    $jadwal->save();

    return redirect()->route('datajadwal')->with('success', 'Jadwal berhasil ditambahkan!');
}

public function update(Request $request, $id_jadwal)
{
    // Validate incoming data
    $validatedData = $request->validate([
        'nip' => 'required|exists:tb_guru,nip',
        'id_tahun' => 'required|exists:tb_tahun,id_tahun',
        'id_kelas' => 'required|exists:tb_kelas,id_kelas',
        'id_mapel' => 'required|exists:tb_mapel,id_mapel',
    ]);

    // Find the record to update
    $jadwal = Jadwal::findOrFail($id_jadwal);

    // Cek duplikasi data, kecuali pada data yang sedang diupdate
    $existingData = Jadwal::where('tahun_ajaran', $validatedData['tahun_ajaran'])
        ->where('semester', $validatedData['semester'])
        ->where('id_tahun', '!=', $id_jadwal) // Mengecualikan record yang sedang diupdate
        ->first();

    if ($existingData) {
        // Jika data dengan tahun_ajaran dan semester yang sama sudah ada (kecuali yang sedang diupdate)
        return redirect()->back()->withErrors(['error' => 'Data tahun ajaran dan semester yang sama sudah ada.']);
    }

    // Update the record with new values
    $jadwal->tahun_ajaran = $validatedData['tahun_ajaran'];
    $jadwal->semester = $validatedData['semester'];

    // Save the updated record
    $jadwal->save();

    // Redirect or return response
    return redirect()->route('jadwal')->with('success', 'Tahun ajaran updated successfully');
}

    public function destroy($id_jadwal)
    {
        // Find the record to delete
        $jadwal = Jadwal::findOrFail($id_jadwal);

        // Delete the record
        $jadwal->delete();

        // Redirect back with success message
        return redirect()->route('jadwal')->with('success', 'Jadwal pelajaran berhasil dihapus');
    }
}
