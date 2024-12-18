<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Cache-Control" content="no-store, no-cache, must-revalidate, max-age=0">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="0">
    @vite('resources/css/app.css')
    <title>@yield('title')</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" />
    <style>
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            width: 100%;
            max-width: 16rem; /* Sidebar lebar maksimal untuk desktop */
            background-color: white;
            z-index: 50;
            overflow-y: auto;
            transform: translateX(-100%);
            transition: transform 0.3s ease;
        }
        .sidebar.open {
            transform: translateX(0);
        }
        @media (min-width: 768px) {
            .sidebar {
                position: sticky;
                transform: none; /* Tetap terlihat di layar besar */
            }
        }
    </style>
</head>
<body class="bg-gray-100">
    <div class="flex flex-col md:flex-row">
        <!-- Sidebar -->
        <div id="sidebar" class="sidebar shadow-md">
            <button onclick="toggleSidebar()" class="absolute top-2 right-2 p-2 rounded-full bg-gray-200 text-gray-700 md:hidden">
                <i class="fa-solid fa-times"></i>
            </button>
            @include('includes.sidebar')
        </div>

        <!-- Konten Utama -->
        <div class="flex-1 flex flex-col">
            <!-- Header -->
            <header class="bg-gray-100 p-2 sticky top-0 z-10 flex items-center justify-between md:justify-start">
                <div class="flex-1">
                    @include('includes.header')
                </div>
            </header>

            <!-- Konten -->
            <div class="flex-1 p-6 bg-gray-100">
                @yield('content')
            </div>
        </div>
    </div>

    <script>
        const sidebar = document.getElementById('sidebar');
        function toggleSidebar() {
            sidebar.classList.toggle('open');
        }
    </script>
</body>
</html>
