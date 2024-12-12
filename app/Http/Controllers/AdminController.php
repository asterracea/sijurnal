<?php

namespace App\Http\Controllers;
use App\Models\GuruPiket;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Tahun;
use App\Models\DataGuru;
use App\Models\User;

class AdminController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $accountname = $user->profile;
        $tahun = Tahun::where('status', 'Aktif')->first();
        $semester = $tahun->semester;
        $guruCount = User::where('role', 'guru')->count(); // Jumlah guru
        $guruPiketCount = GuruPiket::where('id_tahun', $tahun->id_tahun)->count();
        return view('admin.dashboard',  compact('user', 'accountname', 'tahun', 'semester', 'guruCount', 'guruPiketCount'));
        return view('includes.header',  compact('user', 'accountname'));
    }

    public function datapiket(){
        $gurus = DataGuru::all();
        $tahun = Tahun::all();
        $piket = GuruPiket::all();
        $user = Auth::user();
        $accountname = $user->profile;
        return view('admin.gurupiket',  compact('user', 'accountname', 'tahun', 'gurus', 'piket'));
    }

    public function createpiket(Request $request)
{
    $request->validate([
        'nip' => 'required|exists:tb_guru,nip',
        'id_tahun' => 'required|exists:tb_tahun,id_tahun',
    ]);

    $piket = new GuruPiket();
    $piket->nip = $request->nip;
    $piket->id_tahun = $request->id_tahun;
    $piket->hari = $request->hari;
    $piket->jam_mulai = $request->jam_mulai;
    $piket->jam_selesai = $request->jam_selesai;
    $piket->save();

    return redirect()->route('gurupiket')->with('success', 'Guru Piket berhasil ditambahkan!');
}

public function updatepiket(Request $request, $id)
{
    $piket = GuruPiket::findOrFail($id);

    $validated = $request->validate([
        'nip' => 'required',
        'id_tahun' => 'required',
        'hari' => 'required',
        'jam_mulai' => 'required',
        'jam_selesai' => 'required'
    ]);

    $piket->update($validated);

    return redirect()->back()->with('success', 'Guru Piket berhasil diupdate');
    }

    public function dataguru()
    {
        $user = Auth::user();
        $accountname = $user->profile;
        return view('admin.dataguru',compact('user', 'accountname'));
    }
    public function viewjurnal(){
        $user = Auth::user();
        $accountname = $user->profile;
        return view('admin.datajurnal', compact('accountname'));
    }

}
