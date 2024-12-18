<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sistem Informasi Jurnal Guru</title>
    <style>
        .submenu {
            display: none;
        }
        .menu-item.active .submenu {
            display: block;
        }
    </style>
    <script>
        function toggleSubmenu(event) {
            event.preventDefault();
            const menuItem = event.currentTarget.parentElement;
            menuItem.classList.toggle('active');
        }
    </script>
</head>
<body>
    <div class="flex">
        <div class="w-64 min-h-screen bg-white text-gray-800 p-5">
            <div class="py-3 flex justify-center items-center">
                <img src="{{ asset('img/logo_gamaliel.png') }}" class="w-28 h-28" />
            </div>
            <div class="mt-4 flex flex-col">
                <ul>
                    @if (auth()->user()->role === 'admin')
                        <li class="p-3 rounded-md hover:bg-blue-500">
                            <a href="{{ route('wellcome') }}" class="block text-md font-bold hover:text-white">Dashboard</a>
                        </li>
                        <li class="p-3 rounded-md hover:bg-blue-500">
                            <a href="{{ route('datauser') }}" class="block text-md font-bold hover:text-white">Data User</a>
                        </li>
                        <li class="p-3 rounded-md hover:bg-blue-500">
                            <a href="{{ route('dataguru') }}" class="block text-md font-bold hover:text-white">Data Guru</a>
                        </li>
                        <li class="p-3 rounded-md hover:bg-blue-500 menu-item">
                            <a href="#" onclick="toggleSubmenu(event)" class="block text-md font-bold hover:text-white">Data Mapel</a>
                            <ul class="submenu pl-4 mt-2">
                                <li class="p-2 rounded-md hover:bg-blue-400">
                                    <a href="{{ route('tahun') }}" class="block text-sm hover:text-white">Tahun Pelajaran</a>
                                </li>
                                <li class="p-2 rounded-md hover:bg-blue-400">
                                    <a href="{{ route('kelas') }}" class="block text-sm hover:text-white">Kelas</a>
                                </li>
                                <li class="p-2 rounded-md hover:bg-blue-400">
                                    <a href="{{ route('mapel') }}" class="block text-sm hover:text-white">Mata Pelajaran</a>
                                </li>
                            </ul>
                        </li>
                        <li class="p-3 rounded-md hover:bg-blue-500">
                            <a href="{{ route('datajadwal') }}" class="block text-md font-bold hover:text-white">Jadwal Pelajaran</a>
                        </li>
                        <li class="p-3 rounded-md hover:bg-blue-500 menu-item">
                            <a href="#" onclick="toggleSubmenu(event)" class="block text-md font-bold hover:text-white">Jadwal Kelas</a>
                            <ul class="submenu pl-4 mt-2">
                                <li class="p-2 rounded-md hover:bg-blue-400">
                                    <a href="{{ route('jadwalkelas10') }}" class="block text-sm hover:text-white">Kelas 10</a>
                                </li>
                                <li class="p-2 rounded-md hover:bg-blue-400">
                                    <a href="{{ route('jadwalkelas11') }}" class="block text-sm hover:text-white">Kelas 11</a>
                                </li>
                                <li class="p-2 rounded-md hover:bg-blue-400">
                                    <a href="{{ route('jadwalkelas12') }}" class="block text-sm hover:text-white">Kelas 12</a>
                                </li>
                            </ul>
                        </li>
                        <li class="p-3 rounded-md hover:bg-blue-500">
                            <a href="{{ route('gurupiket') }}" class="block text-md font-bold hover:text-white">Guru Piket</a>
                        </li>
                    @endif

                    @if (auth()->user()->role === 'superadmin')
                        <li class="p-3 rounded-md hover:bg-blue-500">
                            <a href="{{ route('dashboard') }}" class="block text-md font-bold hover:text-white">Dashboard</a>
                        </li>
                        <li class="p-3 rounded-md hover:bg-blue-500">
                            <a href="{{ route('settings') }}" class="block text-md font-bold hover:text-white">Manage System</a>
                        </li>
                        <li class="p-3 rounded-md hover:bg-blue-500">
                            <a href="{{ route('settings') }}" class="block text-md font-bold hover:text-white">Setting</a>
                        </li>
                    @endif
                    @if (auth()->user()->role === 'guru')
                        <li class="p-3 rounded-md hover:bg-blue-500">
                            <a href="{{ route('guru/home') }}" class="block text-md font-bold hover:text-white">Dashboard</a>
                        </li>
                        <li class="p-3 rounded-md hover:bg-blue-500">
                            <a href="{{ route('guru/jadwalguru') }}" class="block text-md font-bold hover:text-white">Jadwal Guru</a>
                        </li>
                        <li class="p-3 rounded-md hover:bg-blue-500">
                            <a href="{{ route('guru/jurnal') }}" class="block text-md font-bold hover:text-white">Jurnal Guru Mapel</a>
                        </li>
                        {{-- <li class="p-3 rounded-md hover:bg-blue-500">
                            <a href="{{ route('guru/jurnal') }}" class="block text-md font-bold hover:text-white">Jurnal Guru Piket</a>
                        </li> --}}
                    @endif
                    @if (auth()->user()->role === 'guru_piket')
                        <li class="p-3 rounded-md hover:bg-blue-500">
                            <a href="{{ route('gurupiket/home') }}" class="block text-md font-bold hover:text-white">Dashboard</a>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </div>
</body>
</html>
