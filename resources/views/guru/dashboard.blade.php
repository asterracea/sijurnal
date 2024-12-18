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
<body class="flex min-h-screen">
    <div class="rounded-xl px-5 overflow-hidden">
      <div class="flex justify-between items-center border-gray-200">
          <h1 class="text-xl font-bold text-gray-800">Selamat Datang</h1>
      </div>
      <div>
          <p class="text-gray-600">
              Selamat datang di dashboard guru! .
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
                'color' => 'green',
              ],
              [
                'icon' => 'fa-timeline',
                'title' => 'Semester',
                'value' => $semester,
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

</body>
</html>
@endsection
