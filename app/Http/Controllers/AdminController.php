<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\DataGuru;


class AdminController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $accountname = $user->profile;
        return view('admin.dashboard',  compact('user', 'accountname'));
        return view('includes.header',  compact('user', 'accountname'));
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
        //$user = User::findOrFail($id_user);
        $user = User::find($id_user);

        // Mengambil semua role dan status yang unik
        //$roles = User::distinct()->pluck('role'); // Mengambil semua role unik
        $roles = ['superadmin', 'admin', 'guru', 'guru_piket'];
        //$statuses = User::distinct()->pluck('status'); // Mengambil semua status unik
        $statuses = ['Aktif', 'NonAktif'];
        // Mengirim data ke view
        return view('admin.datauser', compact('user', 'roles', 'statuses'));
    }

    public function update(Request $request, $id_user)
    {
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

        // Cek apakah password diubah, lakukan hashing
        if ($request->password) {
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
