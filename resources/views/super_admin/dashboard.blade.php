@extends('layouts.superadmin')

@section('title', 'Dashboard Superadmin')

@section('content')
<main class="p-6 sm:p-10 space-y-6">
    <h1 class="text-3xl font-bold">Dashboard Superadmin</h1>
    <p>Selamat datang {{ session('user_name')}}, ! Anda memiliki kontrol penuh atas sistem ini.</p>
    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    <!-- Section khusus Superadmin -->
    <section class="grid md:grid-cols-2 xl:grid-cols-4 gap-6">
        <div class="flex items-center p-8 bg-white shadow rounded-lg">
            <div class="h-16 w-16 bg-blue-100 rounded-full mr-6 flex items-center justify-center">
                <i class="fa fa-users text-blue-500"></i>
            </div>
            <div>
                <span class="block text-2xl font-bold">100</span>
                <span class="block text-gray-500">Total Users</span>
            </div>
        </div>
        <div class="flex items-center p-8 bg-white shadow rounded-lg">
            <div class="h-16 w-16 bg-green-100 rounded-full mr-6 flex items-center justify-center">
                <i class="fa fa-database text-green-500"></i>
            </div>
            <div>
                <span class="block text-2xl font-bold">15</span>
                <span class="block text-gray-500">Rekap Data</span>
            </div>
        </div>
    </section>
</main>
@endsection
