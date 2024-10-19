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
        <div class="w-64 min-h-screen bg-blue-500 text-white p-5">
            <div class="py-3 flex justify-center items-center">
                <img src='build/assets/logo_gamaliel.png' class="w-20 h-20" />
            </div>
            <div class="mt-4 flex flex-col gap-4">
                <ul>
                    <li class="p-2 rounded-md hover:bg-gray-600 transition duration-200">
                        <a href="{{ route('dashboard') }}" class="block text-md font-medium hover:text-gray-400">Dashboard</a>
                    </li>
                    <li class="p-2 rounded-md hover:bg-gray-600 transition duration-200">
                        <a href="{{ route('profile') }}" class="block text-md font-medium hover:text-gray-400">Profile</a>
                    </li>
                    <li class="p-2 rounded-md hover:bg-gray-600 transition duration-200">
                        <a href="{{ route('settings') }}" class="block text-md font-medium hover:text-gray-400">Settings</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</body>
</html>
