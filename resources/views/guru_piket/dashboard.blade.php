@extends('layouts.gurupiket')

@section('title', 'Dashboard Guru Piket')

@section('content')
<main class="p-6 sm:p-10 space-y-6">
    <h1 class="text-3xl font-bold">Dashboard Guru Piket</h1>
    <p>Selamat datang, {{ Auth::user()->name }}! Anda bertanggung jawab atas kegiatan piket hari ini.</p>

    <!-- Section khusus Guru Piket -->
    <section class="grid md:grid-cols-2 xl:grid-cols-4 gap-6">
        <div class="flex items-center p-8 bg-white shadow rounded-lg">
            <div class="h-16 w-16 bg-yellow-100 rounded-full mr-6 flex items-center justify-center">
                <i class="fa fa-calendar-check text-yellow-500"></i>
            </div>
            <div>
                <span class="block text-2xl font-bold">5</span>
                <span class="block text-gray-500">Kegiatan Hari Ini</span>
            </div>
        </div>
        <div class="flex items-center p-8 bg-white shadow rounded-lg">
            <div class="h-16 w-16 bg-red-100 rounded-full mr-6 flex items-center justify-center">
                <i class="fa fa-exclamation-circle text-red-500"></i>
            </div>
            <div>
                <span class="block text-2xl font-bold">2</span>
                <span class="block text-gray-500">Laporan Masalah</span>
            </div>
        </div>
        <!-- Tambahkan lebih banyak statistik sesuai kebutuhan -->
    </section>
</main>
@endsection
