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
        return view('auth.login');  // Buat view ini nanti
    }

    // Proses login
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',  // Validasi input email
            'password' => 'required',     // Validasi input password
        ]);

        // Mengambil data email dari request
        $email = $request->input('email');
        $password = $request->input('password');

        // Cek apakah user ada berdasarkan email
        $user = User::where('email', $email)->first();

        // Jika user ditemukan dan password cocok
        if ($user && Hash::check($password, $user->password)) {
            Auth::login($user);  // Login user ke sistem
            return redirect()->intended('dashboard'); // Redirect ke halaman dashboard setelah login
        }

        // Jika gagal, kembalikan ke halaman login dengan error message
        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ]);
    }

    // Fungsi logout
    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}
