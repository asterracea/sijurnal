{{-- @extends('layouts.admin')

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
            <div>
                <h2 class="mb-3 font-semibold text-xl text-gray-600">Create Form Data Guru</h2>

                <!-- Form untuk Create Data Guru -->
                <div class="bg-white rounded shadow-lg p-4 px-4 md:p-8 mb-6">
                    <form action="{{ route('store_dataguru') }}" method="POST">
                        @csrf <!-- Tambahkan CSRF token untuk keamanan -->
                        <div class="lg:col-span-2">
                            <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 md:grid-cols-5">
                                <div class="md:col-span-5">
                                    <label for="nip">NIP</label>
                                    <input type="text" name="nip" id="nip" class="h-10 border mt-1 rounded px-4 w-full bg-gray-50" value="" required />
                                </div>

                                <div class="md:col-span-5">
                                    <label for="nama_guru">Nama Guru</label>
                                    <input type="text" name="nama_guru" id="nama_guru" class="h-10 border mt-1 rounded px-4 w-full bg-gray-50" value="" required />
                                </div>

                                <div class="md:col-span-5 text-right">
                                    <div class="inline-flex items-end">
                                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</body>
</html>

@endsection --}}
