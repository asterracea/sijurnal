<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title>@yield('title')</title>
    <style>
        .sidebar {
            position: sticky; /* Menjaga posisi sidebar tetap */
            top: 0; /* Posisi dari atas */
            height: 100vh; /* Menjaga tinggi sidebar */
            overflow-y: auto; /* Tambahkan scroll jika konten lebih dari tinggi sidebar */
        }
    </style>
</head>
<body class="bg-gray-100">
    <div class="flex">
        <div class="sidebar w-64 h-screen bg-white shadow-md">
            @include('includes.sidebarguru')
        </div>

        <div class="flex-1 flex flex-col">
            <header class="bg-gray-100 p-2 sticky top-0 z-10">
                @include('includes.headerguru')
            </header>

            <div class="flex-1 p-6 bg-gray-100">
                @yield('content')
            </div>
        </div>
    </div>

    <script src="{{ mix('js/app.js') }}"></script>
</body>
</html>
