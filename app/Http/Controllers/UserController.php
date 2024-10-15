<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function create()
    {
        return view('user.create');  // Menampilkan form untuk menambahkan user
    }

    public function store(Request $request)
    {
        // Validasi input dari form
        $request->validate([
            'nip' => 'required',
            'email' => 'required|email|unique:tb_user,email',  // Pastikan email unik
            'password' => 'required|min:8',
        ]);

        // Simpan data user ke database
        User::create([
            'nip' => $request->nip,
            'email' => $request->email,
            'password' => Hash::make($request->password),  // Hash password sebelum disimpan
            'role' => 'user',  // Atur role sesuai kebutuhan
            'status' => 'active',  // Atur status sesuai kebutuhan
        ]);

        return redirect()->route('users.index')->with('success', 'User berhasil ditambahkan!');
    }
}
