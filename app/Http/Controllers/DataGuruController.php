<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dataguru;

class DataGuruController extends Controller
{
    public function index()
    {
        $dataguru = Dataguru::all();
        return view('admin.dataguru', compact('dataguru'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nip' => 'required|numeric|unique:tb_guru',
            'nama_guru' => 'required|string|max:255',
        ]);

        Dataguru::create($validated);

        return redirect()->route('dataguru.index')->with('success', 'Data guru berhasil disimpan.');
    }

    public function edit($nip)
    {
        $guru = Dataguru::where('nip', $nip)->first();

        if (!$guru) {
            return response()->json(['error' => 'Data guru tidak ditemukan.'], 404);
        }

        return response()->json($guru);
    }

    public function update(Request $request, $nip)
    {
        $request->validate([
            'nip' => 'required|numeric|unique:tb_guru,nip,' . $nip . ',nip',
            'nama_guru' => 'required|string|max:255',
        ]);

        $guru = Dataguru::where('nip', $nip)->first();

        if ($guru) {
            $guru->nip = $request->nip;
            $guru->nama_guru = $request->nama_guru;
            $guru->save();

            return redirect()->back()->with('success', 'Data berhasil diperbarui.');
        } else {
            return redirect()->back()->withErrors(['error' => 'Data tidak ditemukan.']);
        }
    }

    public function destroy($nip)
    {
        $guru = Dataguru::where('nip', $nip)->first();

        if (!$guru) {
            return redirect()->route('dataguru.index')->withErrors(['error' => 'Data guru tidak ditemukan.']);
        }

        $guru->delete();

        return redirect()->route('dataguru.index')->with('success', 'Data guru berhasil dihapus.');
    }
}
