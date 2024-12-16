<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
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

        // Mendapatkan hari ini
        Carbon::setLocale('id');
        $today = Carbon::now()->isoFormat('dddd'); // Format hari (e.g., 'Senin')

        $jadwalstoday = $jadwals->filter(function ($jadwal) use ($today) {
            return $jadwal->hari === $today;
        });



        // Kirim data ke view
        return view('guru.jurnal', compact('tahunAjaran','kelas','accountname','jurnals','jadwals','today','jadwalstoday'));
    }

    public function store(Request $request)
    {
        // Validasi data input
        $validatedData = $request->validate([
            'id_jadwal' => 'required|exists:tb_jadwal,id_jadwal',
            'hari' => 'required|string',
            'tanggal' => 'required|date',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required',
            'rencana' => 'required|string',
            'realisasi' => 'required|string',
            'foto' => 'nullable|image|max:1024', // File gambar dengan ukuran maksimal 1 MB
        ]);
        $nip = auth()->user()->nip;

        // Mendapatkan jadwal berdasarkan id_jadwal
        $jadwal = Jadwal::where('id_jadwal', $validatedData['id_jadwal'])->first();

        if (!$jadwal) {
            return redirect()->back()->with('error', 'Jadwal tidak ditemukan.');
        }

        // Validasi hari harus sesuai dengan jadwal
        Carbon::setLocale('id');
        $today = Carbon::now()->isoFormat('dddd'); // Nama hari dalam format lokal
        if (strtolower($jadwal->hari) !== strtolower($today)) {
            return redirect()->back()->with('error', 'Jurnal hanya dapat diisi pada hari yang sesuai jadwal.');
        }

        // Validasi waktu input dalam rentang jam jadwal
        $currentTime = Carbon::now(); // Waktu saat ini
        $scheduleStart = Carbon::createFromTimeString($jadwal->jam_mulai); // Jam mulai dari jadwal
        $scheduleEnd = Carbon::createFromTimeString($jadwal->jam_selesai); // Jam selesai dari jadwal

        if (!$currentTime->between($scheduleStart, $scheduleEnd)) {
            return redirect()->back()->with('error', 'Jurnal hanya dapat diisi pada rentang waktu jadwal.');
        }

        $fotoPath = null;
        if ($request->hasFile('foto')) {
            $file = $request->file('foto'); // Ambil file dari request
            $extension = $file->getClientOriginalExtension(); // Ambil ekstensi file asli
            $directory = storage_path('app/public/foto'); // Direktori tempat file disimpan

            // Menghitung jumlah file yang sudah ada dengan nama 'foto' di folder tersebut
            $existingFiles = glob($directory . '/foto*.'.$extension);
            $nextNumber = count($existingFiles) + 1; // Menambahkan angka sesuai jumlah file yang ada

            // Membuat nama file baru dengan format 'foto{angka}.ext'
            $filename = 'foto' . $nextNumber . '.' . $extension;

            // Menyimpan file dengan nama baru
            $fotoPath = $file->storeAs('foto', $filename, 'public');
        }

        // Simpan data ke database
        Jurnal::create([
            'nip' => $nip,
            'id_jadwal' => $validatedData['id_jadwal'], // ID jadwal diambil dari input mapel
            'hari' => $validatedData['hari'],
            'tanggal' => $validatedData['tanggal'],
            'jam_mulai' => $validatedData['jam_mulai'],
            'jam_selesai' => $validatedData['jam_selesai'],
            'rencana' => $validatedData['rencana'],
            'realisasi' => $validatedData['realisasi'],
            'foto' => $fotoPath,
        ]);
        return redirect()->back()->with('success', 'Jurnal berhasil disimpan!');

    }
    public function edit($id_jurnal)
    {

        $jurnal = Jurnal::with('jadwal') // Ambil data jurnal beserta relasi jadwal
                        ->where('id_jurnal', $id_jurnal) // Cari berdasarkan id_jurnal
                        ->firstOrFail(); // Jika tidak ditemukan, tampilkan 404
                        dd($jurnal);
        // Ambil semua jadwal untuk digunakan dalam dropdown di form edit
         $jadwals = Jadwal::all();

        return view('guru.jurnal', compact('jurnal', 'jadwals'));
    }
    public function update(Request $request,$id_jurnal)
    {
        $jurnal = Jurnal::findOrFail($id_jurnal);
        $validatedData= $request->validate([
            //'nip' => $nip,
            // 'id_jurnal' => 'required|exists:jurnals,id_jurnal',
            'hari' => 'required|string',
            'tanggal' => 'required|date',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required',
            'rencana' => 'required|string',
            'realisasi' => 'required|string',
            'foto' => 'nullable|image|max:1024',
            // Tambahkan validasi lain jika diperlukan
        ]);

        // Cek apakah ada file foto yang di-upload
        if ($request->hasFile('foto')) {
            // Proses upload dan simpan path foto
            $filePath = $request->file('foto')->store('uploads', 'public');
            //$jurnal->foto = $filePath;
            $validatedData['foto'] = $fotoPath;
        }

        // Simpan perubahan
        $jurnal->update($validatedData);

        //return redirect()->route('formjurnal')->with('success', 'Jurnal berhasil diperbarui.');
        return redirect()->back()->with('success', 'Jurnal berhasil diperbarui');

    }
}
