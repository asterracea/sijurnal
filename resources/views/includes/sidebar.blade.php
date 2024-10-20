<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sistem Informasi Jurnal Guru</title>
</head>
<body>
    <div class="flex">
        <div class="w-64 min-h-screen bg-white text-gray-800 p-5">
            <div class="py-3 flex justify-center items-center">
                <img src="{{ asset('build/assets/logo_gamaliel.png') }}" class="w-28 h-28" />
            </div>
            <div class="mt-4 flex flex-col">
                <ul>
                    <li class="p-3 rounded-md hover:bg-blue-500 ">
                        <a href="{{ route('dashboard') }}" class="block text-md font-bold hover:text-white">Dashboard</a>
                    </li>
                    <li class="p-3 rounded-md hover:bg-blue-500 ">
                        <a href="{{ route('dataguru') }}" class="block text-md font-bold hover:text-white ">Data Guru</a>
                    </li>
                    <li class="p-3 rounded-md hover:bg-blue-500">
                        <a href="{{ route('settings') }}" class="block text-md font-bold hover:text-white">Settings</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</body>
</html>
