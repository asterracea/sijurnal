@extends('layouts.admin')

@section('title', 'SiJurnal Guru')

@section('content')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
    @vite('resources/css/app.css')
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sistem Informasi Jurnal Guru</title>
</head>
<body class="flex flex-col min-h-screen p-4 bg-gray-100">
  <div class="rounded-xl px-5 py-4 bg-white shadow-md mb-6">
    <div class="flex justify-between items-center border-b pb-2 border-gray-200">
      <h1 class="text-base sm:text-xl font-bold text-gray-800">Selamat Datang</h1>
    </div>
    <div class="mt-2">
      <p class="text-sm sm:text-base text-gray-600">
        Selamat datang di dashboard admin!
      </p>
    </div>
  </div>

  <div class="sm:p-4 flex justify-center mb-6">
    <div class="grid grid-cols-2 sm:grid-cols-2 xl:grid-cols-4 gap-4">
        @php
            $tahunAktif = $tahun ? $tahun->tahun_ajaran : 'Tidak ada periode aktif';
            $cards = [
                [
                    'icon' => 'fa-timeline',
                    'title' => 'Periode aktif',
                    'value' => $tahunAktif,
                    'color' => 'green',
                ],
                [
                    'icon' => 'fa-timeline',
                    'title' => 'Semester',
                    'value' => $semester,
                    'color' => 'blue',
                ],
                [
                    'icon' => 'fa-user-graduate',
                    'title' => 'Guru',
                    'value' => $guruCount,
                    'color' => 'red',
                ],
                [
                    'icon' => 'fa-chalkboard-teacher',
                    'title' => 'Guru Piket',
                    'value' => $guruPiketCount,
                    'color' => 'yellow',
                ],
            ];
        @endphp

        @foreach ($cards as $card)
          <div class="flex items-center p-4 bg-white shadow rounded-lg">
          <div class="inline-flex flex-shrink-0 items-center justify-center h-16 w-16 text-{{ $card['color'] }}-600 bg-{{ $card['color'] }}-100 rounded-full mr-6">
            <i class="fa-solid {{ $card['icon'] }} text-xl"></i>
          </div>
          <div>
            <span class="block  text-gray-500">{{ $card['title'] }}</span>
            <span class="block sm:text-2xl font-bold">{{ $card['value'] }}</span>
          </div>
        </div>
        @endforeach
    </div>
  </div>


  <div class="overflow-auto bg-white p-4 rounded-lg shadow-md">
    <table class="table-auto w-full border border-gray-300 rounded-lg">
        <thead>
            <tr class="bg-gray-100 text-sm sm:text-base">
                <th class="px-2 sm:px-4 py-2 border">Nama Guru</th>
                <th class="px-2 sm:px-4 py-2 border">Tanggal</th>
                <th class="px-2 sm:px-4 py-2 border">Jam Mulai</th>
                <th class="px-2 sm:px-4 py-2 border">Jam Selesai</th>
                <th class="px-2 sm:px-4 py-2 border">Rencana</th>
                <th class="px-2 sm:px-4 py-2 border">Realisasi</th>
                <th class="px-2 sm:px-4 py-2 border">Kelas</th>
                <th class="px-2 sm:px-4 py-2 border">Mata Pelajaran</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($jurnal as $jurnals)
                <tr>
                    <td class="px-2 sm:px-4 py-2 border text-gray-700">{{ $jurnals->gurus->nama_guru }}</td>
                    <td class="px-2 sm:px-4 py-2 border text-gray-700">{{ $jurnals->tanggal }}</td>
                    <td class="px-2 sm:px-4 py-2 border text-gray-700">{{ $jurnals->jam_mulai }}</td>
                    <td class="px-2 sm:px-4 py-2 border text-gray-700">{{ $jurnals->jam_selesai }}</td>
                    <td class="px-2 sm:px-4 py-2 border text-gray-700">{{ $jurnals->rencana }}</td>
                    <td class="px-2 sm:px-4 py-2 border text-gray-700">{{ $jurnals->realisasi }}</td>
                    <td class="px-2 sm:px-4 py-2 border text-gray-700">{{ $jurnals->jadwal->kelas->nama_kelas ?? 'Tidak tersedia' }}</td>
                    <td class="px-2 sm:px-4 py-2 border text-gray-700">{{ $jurnals->jadwal->mapel->nama_mapel ?? 'Tidak tersedia' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="text-center px-2 sm:px-4 py-2 border text-gray-500">Data jurnal tidak ditemukan.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
  </div>

</body>

</html>
@endsection

