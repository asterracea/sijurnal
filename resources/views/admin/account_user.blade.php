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
    <div class="p-2 bg-gray-100 flex items-center justify-center">
        <div class="container max-w-screen-md">
            <div class="flex justify-between items-center m-4">
                <!-- Form title -->
                <div class="relative text-black font-bold text-xl w-auto">
                    <h1>Account Detail</h1>
                </div>
                <button onclick="window.location.href='{{ route('create_dataguru') }}'"
                    class="bg-blue-500 text-white px-4 py-2 rounded-full hover:bg-blue-700 transition duration-300 ease-in-out">
                    Create
                </button>
            </div>
            <div class="bg-white rounded shadow-lg p-4 px-4 md:p-8 mb-6">
                <div class="mb-4 flex justify-center">
                    <div class="w-1/3 px-10">
                        <label class="block text-lg font-medium text-gray-600">Email</label>
                    </div>
                    <div class="w-2/3">
                        <p class="text-xl text-gray-800">an@gmail.com</p>
                    </div>
                </div>

                <div class="mb-4 flex justify-center">
                    <div class="w-1/3 px-10">
                        <label class="block text-lg font-medium text-gray-600">Password</label>
                    </div>
                    <div class="w-2/3">
                        <p class="text-xl text-gray-800">123</p>
                    </div>
                </div>

                <div class="mb-4 flex justify-center">
                    <div class="w-1/3 px-10">
                        <label class="block text-lg font-medium text-gray-600">Role</label>
                    </div>
                    <div class="w-2/3">
                        <p class="text-xl text-gray-800">Admin</p>
                    </div>
                </div>

                <div class="mb-4 flex justify-center">
                    <div class="w-1/3 px-10">
                        <label class="block text-lg font-medium text-gray-600">Status</label>
                    </div>
                    <div class="w-2/3">
                        <p class="text-xl text-gray-800">Aktif</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

@endsection
