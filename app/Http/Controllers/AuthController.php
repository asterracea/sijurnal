<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Menampilkan form login
    public function showLoginForm()
    {
        return view('login');  
    }

    // Proses login
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',  // Validasi input email
            'password' => 'required',     // Validasi input password
        ],[
            'email.required' => 'Email wajib diisi',
            'password.required' => 'Password wajib diisi',
        ]);

        // Mengambil data email dari request
        $email = $request->input('email');
        $password = $request->input('password');

        // Cek apakah user ada berdasarkan email
        $user = User::where('email', $email)->first();

        // Jika user ditemukan dan password cocok
        if ($user && Hash::check($password, $user->password)) {
            Auth::login($user);  // Login user ke sistem

            // Pengalihan berdasarkan role pengguna
            switch ($user->role) {
                case 'superadmin':
                    return redirect()->intended('/home'); // Superadmin dashboard
                case 'admin':
                    return redirect()->intended('/admin/dashboard'); // Admin dashboard
                case 'guru':
                    return redirect()->intended('/guru/home'); // Guru dashboard
                case 'guru_piket':
                    return redirect()->intended('/gurupiket/home'); // Guru Piket dashboard
                default:
                    // Jika role tidak terdaftar, redirect ke halaman default
                    return redirect('/login')->with('error', 'Role tidak dikenali.');
            }
        }

        // Jika gagal, kembalikan ke halaman login dengan error message
        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->withInput();
    }

    // Fungsi logout
    public function logout()
    {
        Auth::logout();
        return redirect('');
    }
}
