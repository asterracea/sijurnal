<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dataguru;

class CreateDataGuruController extends Controller
{

    public function index()
{
    $dataguru = Dataguru::all(); // Mengambil semua data guru
    return view('admin.dataguru', compact('dataguru')); // Mengirim data ke view
}
    // Menampilkan form
    public function create()
    {
        return view('admin.create_dataguru');
    }

    // Menyimpan data ke database
    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'nip' => 'required|numeric|unique:tb_guru',
            'nama_guru' => 'required|string|max:255',
        ]);

        // Simpan data menggunakan model Dataguru
        Dataguru::create([
            'nip' => $validated['nip'],
            'nama_guru' => $validated['nama_guru'],
        ]);

        // Redirect dengan pesan sukses
        return redirect()->route('create_dataguru')->with('success', 'Data guru berhasil disimpan.');
    }
}
