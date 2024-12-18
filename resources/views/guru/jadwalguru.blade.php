@extends('layouts.guru')

@section('title', 'Dashboard Guru')

@section('content')
<main class="p-6 sm:p-10 space-y-6">
    <div class="flex justify-between items-center m-4">
        <div class="relative text-black font-bold text-xl w-auto">
            <h1>Jadwal Pelajaran Anda</h1>
        </div>
        <div class="flex items-center space-x-4">
            <!-- Dropdown Filter untuk Kelas -->
            <select id="filterKelas" onchange="filterData()" class="border border-gray-300 rounded px-8 py-2">
                <option value="all">Semua Kelas</option>
                <!-- Loop untuk menampilkan kelas secara dinamis -->
                @foreach($jadwals->pluck('kelas.nama_kelas')->unique() as $kelas)
                    <option value="{{ $kelas }}">{{ $kelas }}</option>
                @endforeach
            </select>

            <!-- Dropdown Filter untuk Status -->
            <select id="filterStatus" onchange="filterData()" class="border border-gray-300 rounded px-8 py-2">
                <option value="all">Semua Status</option>
                <option value="Aktif">Aktif</option>
                <option value="Non-Aktif">Tidak Aktif</option>
            </select>
        </div>
    </div>

    <div class="container mt-6">

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
                            <td class="px-4 py-2 border">{{ $jadwal->kelas->nama_kelas }}</td>
                            <td class="px-4 py-2 border">{{ $jadwal->mapel->nama_mapel }}</td>
                            <td class="px-4 py-2 border">{{ $jadwal->tahun->tahun_ajaran }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</main>
@endsection
