@extends('layouts.guru')

@section('title', 'Dashboard Guru')

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sistem Informasi Jurnal Guru</title>
</head>
<body class="flex flex-col min-h-screen bg-gray-100">

    <!-- Header -->
    <div class="px-5 py-4 bg-white shadow rounded-lg mb-5">
        <div class="flex justify-between items-center">
            <h1 class="text-2xl font-bold text-gray-800">Selamat Datang</h1>
        </div>
        <p class="text-gray-600 mt-2">Selamat datang di dashboard guru!</p>
    </div>

    <!-- Informasi Periode Aktif dan Semester -->
    <div class="sm:p-10 flex items-center justify-center">
        <div class="grid md:grid-cols-2 xl:grid-cols-4 gap-6">
            @php
                $tahunAktif = $tahun ? $tahun->tahun_ajaran : 'Tidak ada periode aktif';
                $cards = [
                    [
                        'icon' => 'fa-calendar-alt',
                        'title' => 'Periode Aktif',
                        'value' => $tahunAktif,
                        'color' => 'green',
                    ],
                    [
                        'icon' => 'fa-book',
                        'title' => 'Semester',
                        'value' => $semester ?? 'Tidak tersedia',
                        'color' => 'blue',
                    ],
                ];
            @endphp

            @foreach ($cards as $card)
                <div class="flex items-center p-6 bg-white shadow-lg rounded-lg">
                    <div class="inline-flex items-center justify-center h-16 w-16 text-{{ $card['color'] }}-600 bg-{{ $card['color'] }}-100 rounded-full mr-4">
                        <i class="fa {{ $card['icon'] }} text-2xl"></i>
                    </div>
                    <div>
                        <span class="text-gray-500 text-sm">{{ $card['title'] }}</span>
                        <p class="text-xl font-bold">{{ $card['value'] }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Informasi Piket -->
    @if ($piket)
        <div class="bg-white p-5 rounded-lg shadow mb-5">
            <p class="text-green-700 font-bold">
                Anda sedang piket hari ini ({{ $today }}), dari jam {{ $piket->jam_mulai }} sampai {{ $piket->jam_selesai }}.
            </p>

            @if ($jumlahPending > 0)
                <h3 class="text-lg font-bold text-gray-700 mt-4">Jurnal Belum Terisi</h3>
                <h3 class="text-lg font-bold text-gray-700 mt-4">Silakan lengkapi jurnal berikut:</h3>
                <div class="overflow-x-auto mt-3">
                    <table class="min-w-full mt-3 bg-white border border-gray-300 rounded-lg">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="px-4 py-2 border">Tanggal</th>
                                <th class="px-4 py-2 border">Jam Mulai</th>
                                <th class="px-4 py-2 border">Jam Selesai</th>
                                <th class="px-4 py-2 border">Kelas</th>
                                <th class="px-4 py-2 border">Mata Pelajaran</th>
                                <th class="px-4 py-2 border">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($jurnals as $jurnal)
                                <tr>
                                    <td class="px-4 py-2 border">{{ $jurnal->tanggal }}</td>
                                    <td class="px-4 py-2 border">{{ $jurnal->jam_mulai }}</td>
                                    <td class="px-4 py-2 border">{{ $jurnal->jam_selesai }}</td>
                                    <td class="px-4 py-2 border">{{ $jurnal->jadwal->kelas->nama_kelas ?? 'Tidak tersedia' }}</td>
                                    <td class="px-4 py-2 border">{{ $jurnal->jadwal->mapel->nama_mapel ?? 'Tidak tersedia' }}</td>
                                    <td class="px-4 py-2 border">
                                        <span class="px-2 py-1 rounded {{ $jurnal->status === 'pending' ? 'bg-yellow-500' : 'bg-green-500' }}">
                                            {{ ucfirst($jurnal->status) }}
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center py-2">Tidak ada jurnal dengan status pending.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    @else
        <div class="bg-white p-5 rounded-lg shadow">
            <p class="text-red-700 font-bold">
                Anda tidak sedang piket hari ini ({{ $today }}).
            </p>
        </div>
    @endif

</body>
</html>
@endsection
