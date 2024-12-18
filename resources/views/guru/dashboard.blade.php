@extends('layouts.guru')

@section('title', 'Dashboard Guru')

@section('content')

<div class="container mx-auto p-5">
    <!-- Selamat Datang -->
    <div class="bg-white p-5 rounded-lg shadow mb-5">
        <h1 class="text-xl font-bold text-gray-800">Selamat Datang, {{ $user->name }}</h1>
        <p class="text-gray-600">Selamat datang di dashboard Guru!</p>
    </div>

    <!-- Informasi Periode Aktif -->
    <div class="grid md:grid-cols-2 xl:grid-cols-4 gap-6 mb-5">
        @php
            $tahunAktif = $tahun ? $tahun->tahun_ajaran : 'Tidak ada periode aktif';
            $cards = [
                [
                    'icon' => 'fa-calendar',
                    'title' => 'Tahun Ajaran Aktif',
                    'value' => $tahunAktif,
                    'color' => 'purple',
                ],
                [
                    'icon' => 'fa-book',
                    'title' => 'Semester Aktif',
                    'value' => $semester,
                    'color' => 'blue',
                ],
            ];
        @endphp

        @foreach ($cards as $card)
            <div class="flex items-center p-5 bg-white shadow rounded-lg">
                <div class="h-16 w-16 flex items-center justify-center text-{{ $card['color'] }}-600 bg-{{ $card['color'] }}-100 rounded-full mr-4">
                    <i class="fa {{ $card['icon'] }} text-2xl"></i>
                </div>
                <div>
                    <p class="text-gray-500">{{ $card['title'] }}</p>
                    <p class="text-xl font-bold">{{ $card['value'] }}</p>
                </div>
            </div>
        @endforeach
    </div>

    @if ($piket)
    <div class="bg-white p-5 rounded-lg shadow mb-5">
        <p class="text-green-700 font-bold">
            Anda sedang piket hari ini ({{ $today }}), dari jam {{ $piket->jam_mulai }} sampai {{ $piket->jam_selesai }}.
        </p>
        @if ($jurnals->isEmpty())
            <p class="text-gray-500">Semua jurnal sudah terisi. Tidak ada jurnal kosong untuk diisi saat ini.</p>
        @else
            <h2 class="text-lg font-bold text-gray-700 mt-3">Silakan lengkapi jurnal berikut:</h2>
            <!-- Tabel Jurnal Kosong -->
            <table class="min-w-full mt-3 bg-white border border-gray-300 rounded-lg">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="px-4 py-2 border">Tanggal</th>
                        <th class="px-4 py-2 border">Jam Mulai</th>
                        <th class="px-4 py-2 border">Jam Selesai</th>
                        <th class="px-4 py-2 border">Kelas</th>
                        <th class="px-4 py-2 border">Mata Pelajaran</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($jurnals as $jurnal)
                        <tr>
                            <td class="px-4 py-2 border">{{ $jurnal->tanggal }}</td>
                            <td class="px-4 py-2 border">{{ $jurnal->jam_mulai }}</td>
                            <td class="px-4 py-2 border">{{ $jurnal->jam_selesai }}</td>
                            <td class="px-4 py-2 border">{{ $jurnal->jadwal->kelas->nama_kelas ?? 'Tidak tersedia' }}</td>
                            <td class="px-4 py-2 border">{{ $jurnal->jadwal->mapel->nama_mapel ?? 'Tidak tersedia' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@else
    <div class="bg-white p-5 rounded-lg shadow">
        <p class="text-red-700 font-bold">
            Anda tidak sedang piket hari ini ({{ $today }}).
        </p>
    </div>
@endif

</div>

@endsection
