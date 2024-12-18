@extends('layouts.guru')

@section('title', 'Dashboard Guru')

@section('content')
<main class="p-6 sm:p-10 space-y-6">
    <h1 class="text-3xl font-bold">Jadwal Pengajaran Anda</h1>

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
