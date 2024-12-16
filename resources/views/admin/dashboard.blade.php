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
<body class="flex min-h-screen">
  <div class="rounded-xl px-5 overflow-hidden">
    <div class="flex justify-between items-center border-gray-200">
        <h1 class="text-xl font-bold text-gray-800">Selamat Datang</h1>
    </div>
    <div>
        <p class="text-gray-600">
            Selamat datang di dashboard admin! .
        </p>
    </div>
  </div>
  <div class="sm:p-10 flex items-center justify-center">
    <div class="grid md:grid-cols-2 xl:grid-cols-4 gap-6">
      @php
        $tahunAktif = $tahun ? $tahun->tahun_ajaran : 'Tidak ada periode aktif';
        $cards = [
          [
            'icon' => 'fa-timeline',
            'title' => 'Periode aktif',
            'value' => $tahunAktif,
            'color' => 'purple',
          ],
          [
            'icon' => 'fa-timeline',
            'title' => 'Periode aktif',
            'value' => $semester,
            'color' => 'purple',
          ],
          [
            'icon' => 'fa-user-graduate',
            'title' => 'Guru',
            'value' => $guruCount,
            'color' => 'green',
          ],
          [
            'icon' => 'fa-chalkboard-teacher',
            'title' => 'Guru Piket',
            'value' => $guruPiketCount,
            'color' => 'blue',
          ],
        ];
      @endphp

      @foreach ($cards as $card)
        <div class="flex items-center p-8 bg-white shadow rounded-lg">
          <div class="inline-flex flex-shrink-0 items-center justify-center h-16 w-16 text-{{ $card['color'] }}-600 bg-{{ $card['color'] }}-100 rounded-full mr-6">
            <i class="fa-solid {{ $card['icon'] }} text-xl"></i>
          </div>
          <div>
            <span class="block text-gray-500">{{ $card['title'] }}</span>
            <span class="block text-2xl font-bold">{{ $card['value'] }}</span>
          </div>
        </div>
      @endforeach
    </div>
  </div>

    {{-- content --}}
    <div class="bg-white shadow-md rounded-xl overflow-hidden">
        <div class="flex justify-between items-center m-4">
            <div class="relative text-black font-bold text-xl w-auto">
                <h1>Jurnal Guru</h1>
            </div>

        </div>
    </div>
</body>
</html>
@endsection

