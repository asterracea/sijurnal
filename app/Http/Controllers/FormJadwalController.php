<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tahun;
use App\Models\Kelas;
use App\Models\Mapel;

class FormJadwalController extends Controller
{
    public function index()
{
    return view('admin.formjadwal');
}

    public function store(Request $request)
    {
        // Validasi input
        $validatedData = $request->validate([
            'tahun_ajaran' => 'required|string|max:10',
            'semester' => 'required|in:Ganjil,Genap',
            'nama_kelas' => 'required|string|max:45',
            'nama_mapel' => 'required|string|max:45',
        ]);

        // Simpan data ke tb_tahun
        $tahun = Tahun::create([
            'tahun_ajaran' => $validatedData['tahun_ajaran'],
            'semester' => $validatedData['semester'],
        ]);

        // Simpan data ke tb_kelas
        $kelas = Kelas::create([
            'nama_kelas' => $validatedData['nama_kelas'],
        ]);

        // Simpan data ke tb_mapel
        $mapel = Mapel::create([
            'nama_mapel' => $validatedData['nama_mapel'],
        ]);

        // Redirect dengan pesan sukses
        return redirect()->route('datajadwal')->with('success', 'Data berhasil disimpan.');
    }
}
