<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
    $user = Auth::user();
    $accountname = $user->profile; 

    return view('admin.datajadwal', compact('gurus', 'tahun', 'kelas', 'mapel', 'jadwal','accountname'));
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

public function update(Request $request, $id)
{
    $jadwal = Jadwal::findOrFail($id);

    $validated = $request->validate([
        'nip' => 'required',
        'id_tahun' => 'required',
        'id_kelas' => 'required',
        'id_mapel' => 'required',
        'hari' => 'required',
        'jam_mulai' => 'required',
        'jam_selesai' => 'required'
    ]);

    $jadwal->update($validated);

    return redirect()->back()->with('success', 'Jadwal berhasil diupdate');
    }

    public function destroy($id_jadwal)
    {
        $jadwal = Jadwal::findOrFail($id_jadwal);

        $jadwal->delete();

        return redirect()->route('jadwal')->with('delete', 'Jadwal pelajaran berhasil dihapus');
    }
}
