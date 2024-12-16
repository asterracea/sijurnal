<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\DataGuru;

class UserPageController extends Controller
{
    // Menampilkan daftar semua user (opsional)
    public function index()
    {
        // Menampilkan semua user di admin/userpage
        $userpage = User::all(); // jika ingin menampilkan semua user
        $user=Auth::user();
        $guru = $user->profile;
        return view('admin.userpage', compact('userpage','guru'));
    }

    // Menampilkan detail user berdasarkan NIP
    public function show($nip)
    {

        // Cari data guru berdasarkan NIP
        $guru = DataGuru::where('nip', $nip)->first();
        //$user=Auth::user();
        //$guru = $user->profile;

        // Cari data user berdasarkan NIP
        $user = User::where('nip', $nip)->first();

        // Cek apakah data guru atau user ada
        if (!$guru || !$user) {
            return redirect()->back()->with('error', 'Data guru atau user tidak ditemukan.');
        }

        // Kirim data guru dan user ke view
        return view('admin.userpage', compact('guru', 'user','profile'));
    }

}

