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
    <header class="bg-white p-4 shadow-md text-gray-500 rounded-xl ">
        <div class="container mx-auto flex justify-between items-center">
            <div class="relative text-gray-500 focus-within:text-gray-900 w-auto">
                <input type="text" id="default-search" class="block w-64 h-11 p-5 text-base font-normal text-gray-900 bg-transparent border border-gray-300 rounded-full placeholder-gray-400 focus:outline-none" placeholder="Search">
            </div>
            <div class='h-[50px] w-[50px] rounded-full bg-white'>
                <img src="{{ asset('build/assets/logo_gamaliel.png') }}" class="rounded-full" />
            </div>
        </div>
    </header>
</body>
</html>
