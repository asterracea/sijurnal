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
    // Validasi data input
    $validatedData = $request->validate([
        'nip' => 'required|exists:tb_guru,nip',
        'id_tahun' => 'required|exists:tb_tahun,id_tahun',
        'id_kelas' => 'required|exists:tb_kelas,id_kelas',
        'id_mapel' => 'required|exists:tb_mapel,id_mapel',
        'hari' => 'required|string',
        'jam_mulai' => 'required|date_format:H:i',
        'jam_selesai' => 'required|date_format:H:i|after:jam_mulai',
    ]);

    // Cari record yang akan diupdate
    $jadwal = Jadwal::findOrFail($id_jadwal);

    // Cek apakah ada duplikasi data jadwal
    $existingData = Jadwal::where('id_tahun', $validatedData['id_tahun'])
        ->where('id_kelas', $validatedData['id_kelas'])
        ->where('id_mapel', $validatedData['id_mapel'])
        ->where('hari', $validatedData['hari'])
        ->where('jam_mulai', $validatedData['jam_mulai'])
        ->where('jam_selesai', $validatedData['jam_selesai'])
        ->where('id_jadwal', '!=', $id_jadwal) // Kecualikan jadwal yang sedang diupdate
        ->first();

    if ($existingData) {
        // Jika data jadwal yang sama sudah ada
        return redirect()->back()->withErrors(['error' => 'Jadwal dengan data yang sama sudah ada.']);
    }

    // Update data jadwal
    $jadwal->nip = $validatedData['nip'];
    $jadwal->id_tahun = $validatedData['id_tahun'];
    $jadwal->id_kelas = $validatedData['id_kelas'];
    $jadwal->id_mapel = $validatedData['id_mapel'];
    $jadwal->hari = $validatedData['hari'];
    $jadwal->jam_mulai = $validatedData['jam_mulai'];
    $jadwal->jam_selesai = $validatedData['jam_selesai'];
    $jadwal->save();

    // Redirect dengan pesan sukses
    return redirect()->route('datajadwal')->with('success', 'Jadwal berhasil diupdate!');
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
