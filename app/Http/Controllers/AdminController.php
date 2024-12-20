<?php

namespace App\Http\Controllers;
use App\Models\GuruPiket;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\Tahun;
use App\Models\DataGuru;
use App\Models\User;
use App\Models\Jurnal;
use App\Models\Kelas;
use App\Models\Mapel;
use App\Models\Jadwal;

class AdminController extends Controller
{
    public function index()
{
    $gurus = DataGuru::all();
    $piket = GuruPiket::all();
    $tahun = Tahun::all();
    $kelas = Kelas::all();
    $mapel = Mapel::all();
    $jadwal = Jadwal::with(['guru', 'tahun', 'kelas', 'mapel'])
            ->whereHas('kelas', function ($query) {
                $query->where('nama_kelas', 'like', '10%')
                    ->orWhere('nama_kelas', 'like', '11%')
                    ->orWhere('nama_kelas', 'like', '12%');
            })
            ->get();
    $jurnal = Jurnal::with(['piket.guru', 'jadwal.kelas', 'jadwal.mapel'])->get();
    $user = Auth::user();
    $accountname = $user->profile;
    $tahun = Tahun::where('status', 'Aktif')->first();
    $semester = $tahun ? $tahun->semester : 'Tidak ada';
    $guruCount = User::where('role', 'guru')->count();
    $guruPiketCount = GuruPiket::where('id_tahun', $tahun->id_tahun ?? null)->count();

    return view('admin.dashboard', compact('user', 'accountname', 'tahun', 'semester', 'guruCount', 'jadwal', 'guruPiketCount', 'jurnal'));
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
        $accountname = $user->profile;
        return view('admin.dataguru',compact('user', 'accountname'));
    }
    public function viewjurnal(){
        $user = Auth::user();
        $accountname = $user->profile;
        return view('admin.datajurnal', compact('accountname'));
    }

    public function viewUser(){
        //$user = Auth::user();
        $availableNips = DataGuru::whereNotIn('nip', User::pluck('nip'))->pluck('nip', 'nip');
        $users = User::all();
        $roles = User::distinct()->pluck('role'); // Mengambil semua role unik
        $statuses = User::distinct()->pluck('status');
        return view('admin.datauser', compact('availableNips','users','roles', 'statuses'));
    }
    public function edit($id_user)
    {
        // Ambil data user berdasarkan ID
        $user = User::find($id_user);

        // Ambil semua status yang ada, misalnya 'Aktif' dan 'NonAktif'
        $statuses = ['Aktif', 'NonAktif'];
        dd($statuses);

        // Kirim data user dan opsi status ke view
        return view('admin.datauser', compact('user', 'statuses'));
    }

    public function update(Request $request, $id_user)
    {
        // Cari data user berdasarkan id_user
        $user = User::findOrFail($id_user);

        // Validasi input
        $request->validate([
            'nip' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'password' => 'nullable|string|min:6', // Password opsional
            'role' => 'required|in:superadmin,admin,guru,guru_piket',
            'status' => 'required|in:Aktif,NonAktif',
        ]);

        // Update data user
        $user->nip = $request->nip;
        $user->email = $request->email;

        // Update password hanya jika diisi
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        // Update role dan status
        $user->role = $request->role;
        $user->status = $request->status;

        // Simpan perubahan ke database
        $user->save();

        // Redirect ke halaman daftar user dengan pesan sukses
        return redirect()->route('datauser')->with('success', 'Data user berhasil diperbarui.');
    }
    public function store(Request $request)
    {

        $validated = $request->validate([
            'nip' => 'required|numeric|exists:tb_guru,nip|unique:tb_user,nip',
            'email' => 'required|email|unique:tb_user,email',
            'role' => 'required|in:admin,guru',
            'status' => 'required|in:Aktif,NonAktif',
            'password' => 'required|min:8|confirmed',
        ]);
        $guru = DataGuru::where('nip', $request->nip)->first();
        if (!$guru) {
            return redirect()->back()->withErrors(['nip' => 'NIP tidak ditemukan di tabel guru.']);
        }
        $user = new User();
        $user->nip = $request->nip;
        $user->email = $request->email;
        $user->role = $request->role;
        $user->status = $request->status;
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->back()->with('success', 'User created successfully');
    }

}
