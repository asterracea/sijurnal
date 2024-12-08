<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Jadwal;
use App\Models\Kelas;
use App\Models\DataGuru;
use App\Models\Tahun;
use App\Models\Mapel;

class JadwalKelas10Controller extends Controller
{

    public function index()
    {
        // Ambil jadwal hanya untuk kelas yang nama_kelasnya dimulai dengan '10'
        $jadwal = Jadwal::with(['guru', 'tahun', 'kelas', 'mapel'])
                        ->whereHas('kelas', function ($query) {
                            $query->where('nama_kelas', 'like', '10%');
                        })
                        ->get();

        // Ambil data guru, tahun, mapel untuk form
        $gurus = DataGuru::all();
        $tahun = Tahun::all();
        $kelas = Kelas::all();
        $mapel = Mapel::all();
        $user = Auth::user();
        $accountname = $user->profile;

        // Kirim data ke view
        return view('admin.jadwalkelas10', compact('gurus', 'tahun', 'kelas', 'mapel', 'jadwal','accountname'));
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

    return redirect()->route('jadwalkelas10')->with('success', 'Jadwal berhasil ditambahkan!');
}
}
