<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sistem Informasi Jurnal Guru</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
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
    <div id="sidebar" class="flex">
        <div class="w-64 min-h-screen bg-white text-gray-800 p-5">
            <div class="py-3 flex justify-center items-center">
                <img src="{{ asset('img/logo_gamaliel.png') }}" class="w-28 h-28" />
            </div>
            <div class="mt-4 flex flex-col">
                <ul>
                    @if (auth()->user()->role === 'admin')
                        <li class="p-3 rounded-md hover:bg-blue-500">
                            <a href="{{ route('wellcome') }}" class="block text-md font-bold hover:text-white">
                                <i class="fas fa-home mr-2"></i> Dashboard
                            </a>
                        </li>
                        <li class="p-3 rounded-md hover:bg-blue-500">
                            <a href="{{ route('datauser') }}" class="block text-md font-bold hover:text-white">
                                <i class="fas fa-users mr-2"></i> Data User
                            </a>
                        </li>
                        <li class="p-3 rounded-md hover:bg-blue-500">
                            <a href="{{ route('dataguru') }}" class="block text-md font-bold hover:text-white">
                                <i class="fas fa-user-tie mr-2"></i> Data Guru
                            </a>
                        </li>
                        <li class="p-3 rounded-md hover:bg-blue-500 menu-item">
                            <a href="#" onclick="toggleSubmenu(event)" class="block text-md font-bold hover:text-white">
                                <i class="fas fa-book mr-2"></i> Data Mapel <i class="fas fa-caret-down ml-16"></i>
                            </a>
                            <ul class="submenu pl-4 mt-2">
                                <li class="p-2 rounded-md hover:bg-blue-400">
                                    <a href="{{ route('tahun') }}" class="block text-sm hover:text-white">
                                        <i class="fas fa-calendar-alt mr-2"></i> Tahun Pelajaran
                                    </a>
                                </li>
                                <li class="p-2 rounded-md hover:bg-blue-400">
                                    <a href="{{ route('kelas') }}" class="block text-sm hover:text-white">
                                        <i class="fas fa-school mr-2"></i> Kelas
                                    </a>
                                </li>
                                <li class="p-2 rounded-md hover:bg-blue-400">
                                    <a href="{{ route('mapel') }}" class="block text-sm hover:text-white">
                                        <i class="fas fa-book-open mr-2"></i> Mata Pelajaran
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="p-3 rounded-md hover:bg-blue-500">
                            <a href="{{ route('datajadwal') }}" class="block text-md font-bold hover:text-white">
                                <i class="fas fa-calendar-alt mr-2"></i> Jadwal Pelajaran
                            </a>
                        </li>
                        <li class="p-3 rounded-md hover:bg-blue-500 menu-item">
                            <a href="#" onclick="toggleSubmenu(event)" class="block text-md font-bold hover:text-white">
                                <i class="fas fa-clipboard-list mr-2"></i> Jadwal Kelas <i class="fas fa-caret-down ml-14"></i>
                            </a>
                            <ul class="submenu pl-4 mt-2">
                                <li class="p-2 rounded-md hover:bg-blue-400">
                                    <a href="{{ route('jadwalkelas10') }}" class="block text-sm hover:text-white">
                                        <i class="fas fa-chalkboard mr-2"></i> Kelas 10
                                    </a>
                                </li>
                                <li class="p-2 rounded-md hover:bg-blue-400">
                                    <a href="{{ route('jadwalkelas11') }}" class="block text-sm hover:text-white">
                                        <i class="fas fa-chalkboard-teacher mr-2"></i> Kelas 11
                                    </a>
                                </li>
                                <li class="p-2 rounded-md hover:bg-blue-400">
                                    <a href="{{ route('jadwalkelas12') }}" class="block text-sm hover:text-white">
                                        <i class="fas fa-graduation-cap mr-2"></i> Kelas 12
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="p-3 rounded-md hover:bg-blue-500">
                            <a href="{{ route('gurupiket') }}" class="block text-md font-bold hover:text-white">
                                <i class="fas fa-user-clock mr-2"></i> Guru Piket
                            </a>
                        </li>
                    @endif

                    @if (auth()->user()->role === 'superadmin')
                        <li class="p-3 rounded-md hover:bg-blue-500">
                            <a href="{{ route('dashboard') }}" class="block text-md font-bold hover:text-white">
                                <i class="fas fa-tachometer-alt mr-2"></i> Dashboard
                            </a>
                        </li>
                        <li class="p-3 rounded-md hover:bg-blue-500">
                            <a href="{{ route('settings') }}" class="block text-md font-bold hover:text-white">
                                <i class="fas fa-cogs mr-2"></i> Manage System
                            </a>
                        </li>
                        <li class="p-3 rounded-md hover:bg-blue-500">
                            <a href="{{ route('settings') }}" class="block text-md font-bold hover:text-white">
                                <i class="fas fa-wrench mr-2"></i> Setting
                            </a>
                        </li>
                    @endif

                    @if (auth()->user()->role === 'guru')
                        <li class="p-3 rounded-md hover:bg-blue-500">
                            <a href="{{ route('guru/home') }}" class="block text-md font-bold hover:text-white">
                                <i class="fas fa-home mr-2"></i> Dashboard
                            </a>
                        </li>
                        <li class="p-3 rounded-md hover:bg-blue-500">
                            <a href="{{ route('guru/jadwalguru') }}" class="block text-md font-bold hover:text-white">
                                <i class="fas fa-calendar-alt mr-2"></i> Jadwal Guru
                            </a>
                        </li>
                        <li class="p-3 rounded-md hover:bg-blue-500">
                            <a href="{{ route('guru/jurnal') }}" class="block text-md font-bold hover:text-white">
                                <i class="fas fa-book mr-2"></i> Jurnal Guru Mapel
                            </a>
                        </li>
                        <li class="p-3 rounded-md hover:bg-blue-500">
                            <a href="{{ route('guru/jurnalpiket') }}" class="block text-md font-bold hover:text-white">
                                <i class="fas fa-book mr-2"></i> Jurnal Guru Piket
                            </a>
                        </li>
                    @endif

                    @if (auth()->user()->role === 'guru_piket')
                        <li class="p-3 rounded-md hover:bg-blue-500">
                            <a href="{{ route('gurupiket/home') }}" class="block text-md font-bold hover:text-white">
                                <i class="fas fa-home mr-2"></i> Dashboard
                            </a>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </div>
</body>
</html>
