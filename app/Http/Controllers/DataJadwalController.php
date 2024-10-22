<?php

namespace App\Http\Controllers;

use App\Models\Jadwal; // Pastikan Model Jadwal di-import
use Illuminate\Http\Request;

class DataJadwalController extends Controller
{
    public function index()
    {
        // Ambil data jadwal dengan relasi ke kelas, tahun, dan mapel
        $dataJadwal = Jadwal::with(['kelas', 'tahun', 'mapel'])->get();

        // Kembalikan view dengan data jadwal
        return view('admin.datajadwal', compact('dataJadwal'));
    }
}
