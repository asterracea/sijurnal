@extends('layouts.guru')

@section('title', 'Dashboard Guru')

@section('content')
<main class="p-6 sm:p-10 space-y-6">
    <h1 class="text-3xl font-bold">Dashboard Guru</h1>
    <p>Selamat datang, {{ Auth::user()->name }}! Anda memiliki akses ke semua data pengajaran Anda.</p>

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
</main>
@endsection
