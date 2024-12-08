<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Tahun;
use App\Models\Kelas;
use App\Models\User;
use App\Models\Jurnal;
use App\Models\Jadwal;

class GuruController extends Controller
{
    function index()
    {
        $user = Auth::user();
        $accountname = $user->profile;
        // Mendapatkan NIP dari guru yang sedang login
        $guruId = auth()->user()->nip; // Mendapatkan NIP guru yang sedang login

        // Mengambil jadwal yang dimiliki oleh guru berdasarkan NIP
        $jadwals = Jadwal::where('nip', $guruId) // Filter berdasarkan NIP guru
                         ->with('kelas', 'mapel', 'tahun')  // Menyertakan relasi jadwal dengan kelas, mapel, dan tahun
                         ->get();

        
        
        return view('guru.dashboard',  compact('user', 'accountname','jadwals'));
        return view('includes.header',  compact('user','accountname'));
        
    }
    function viewjurnal()
    {
        $user = Auth::user();
        $accountname = $user->profile;
        $tahunAjaran = Tahun::all();
        $kelas = Kelas::all();
        $guruId = auth()->user()->nip; // Mendapatkan NIP guru yang sedang login
        // Mengambil jadwal guru yang sedang login
        $jadwals = Jadwal::where('nip', $guruId)  // Filter berdasarkan NIP guru
                         ->with('kelas', 'mapel', 'tahun')  // Menyertakan relasi jadwal dengan kelas, mapel, dan tahun
                         ->get();

        // Mengambil jurnal yang sesuai dengan jadwal yang dimiliki oleh guru
        $jurnals = Jurnal::whereIn('id_jadwal', $jadwals->pluck('id_jadwal'))  // Mengambil jurnal dengan id_jadwal dari jadwal guru
                         ->with('jadwal', 'jadwal.kelas', 'jadwal.mapel')  // Mengambil relasi jurnal dengan jadwal, kelas, dan mapel
                         ->get();

        // Kirim data ke view
        return view('guru.jurnal', compact('tahunAjaran','kelas','accountname','jurnals','jadwals'));
    }
}
