@extends('layouts.guru')

@section('title', 'Dashboard Guru')

@section('content')
<main class="p-6 sm:p-10 space-y-6">
    <h1 class="text-3xl font-bold">Dashboard Guru</h1>
    <p>Selamat datang, {{ $accountname->nama_guru }}! Anda memiliki akses ke semua data pengajaran Anda.</p>

    <!-- Section khusus Guru -->
    <section class="grid md:grid-cols-2 xl:grid-cols-4 gap-6">
        <div class="flex items-center p-8 bg-white shadow rounded-lg">
            <div class="h-16 w-16 bg-blue-100 rounded-full mr-6 flex items-center justify-center">
                <i class="fa fa-book text-blue-500"></i>
            </div>
            <div>
                <span class="block text-2xl font-bold">20</span>
                <span class="block text-gray-500">Mata Pelajaran Diajar</span>
            </div>
        </div>
        <div class="flex items-center p-8 bg-white shadow rounded-lg">
            <div class="h-16 w-16 bg-green-100 rounded-full mr-6 flex items-center justify-center">
                <i class="fa fa-users text-green-500"></i>
            </div>
            <div>
                <span class="block text-2xl font-bold">50</span>
                <span class="block text-gray-500">Jumlah Siswa</span>
            </div>
        </div>
        <!-- Tambahkan lebih banyak statistik sesuai kebutuhan -->
        
    </section>
    <div class="container">
        <h2 class="text-2xl font-bold mb-4">Jadwal Pengajaran Anda</h2>

        @if ($jadwals->isEmpty())
            <p>Tidak ada jadwal yang tersedia untuk Anda.</p>
        @else
            <table class="min-w-full bg-white border border-gray-300 rounded-lg">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="px-4 py-2 border">Hari</th>
                        <th class="px-4 py-2 border">Jam Mulai</th>
                        <th class="px-4 py-2 border">Jam Selesai</th>
                        <th class="px-4 py-2 border">Kelas</th>
                        <th class="px-4 py-2 border">Mata Pelajaran</th>
                        <th class="px-4 py-2 border">Tahun Ajaran</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($jadwals as $jadwal)
                        <tr>
                            <td class="px-4 py-2 border">{{ $jadwal->hari }}</td>
                            <td class="px-4 py-2 border">{{ $jadwal->jam_mulai }}</td>
                            <td class="px-4 py-2 border">{{ $jadwal->jam_selesai }}</td>
                            <td class="px-4 py-2 border">{{ $jadwal->kelas->nama_kelas }}</td> <!-- Nama kelas -->
                            <td class="px-4 py-2 border">{{ $jadwal->mapel->nama_mapel }}</td> <!-- Nama mata pelajaran -->
                            <td class="px-4 py-2 border">{{ $jadwal->tahun->nama_tahun }}</td> <!-- Nama tahun ajaran -->
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</main>
@endsection
