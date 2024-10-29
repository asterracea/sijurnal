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
<body class="flex bg-white min-h-screen">
    <div class="flex-grow p-5">
        <div class="bg-white shadow-md rounded-xl overflow-hidden">
            <div class="flex justify-between items-center m-4">
                <div class="relative text-black font-bold text-xl w-auto">
                    <h1>Daftar Data Guru</h1>
                </div>
                <button onclick="window.location.href='{{ route('create_dataguru') }}'"
                    class="bg-blue-500 text-white px-4 py-2 rounded-full hover:bg-blue-700 transition duration-300 ease-in-out">
                    Create
                </button>
            </div>
            <table class="w-full">
                <thead>
                    <tr class="bg-gray-50">
                        <th class="p-5 text-left text-sm leading-6 font-semibold text-gray-900 capitalize">NIP</th>
                        <th class="p-5 text-left text-sm leading-6 font-semibold text-gray-900 capitalize">Nama Guru</th>
                        <th class="p-5 text-left text-sm leading-6 font-semibold text-gray-900 capitalize">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-300">
                    @foreach($dataguru as $guru)
                        <tr class="bg-white transition-all duration-500 hover:bg-gray-50">
                            <td class="p-5 text-sm font-medium text-gray-900">{{ $guru->nip }}</td>
                            <td class="p-5 text-sm font-medium text-gray-900">{{ $guru->nama_guru }}</td>
                            <td class="p-5 text-sm font-medium text-gray-900">
                                <a href="#" class="text-blue-500 hover:text-blue-700">
                                    <i class="fa fa-pencil" aria-hidden="true"></i> Edit
                                </a>
                            </td>
                            <td>
                                <button onclick="window.location.href='{{ route('account_user') }}'"
                                    class="bg-yellow-500 text-white rounded-full hover:bg-yellow-700 px-3 py-2 ml-3">
                                    Akun
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>

@endsection
