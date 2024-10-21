<body class="bg-gray-100">
    <div class="flex">
        <div class="w-64 h-screen">
            @include('includes.sidebar')
        </div>

        <div class="flex-1 flex flex-col">
            <header class="bg-gray-100 p-2 sticky top-0 z-10">
                @include('includes.header')
            </header>

            <div class="flex-1 p-6 bg-gray-100">
                @yield('content')
            </div>
        </div>
    </div>

    <script src="{{ mix('js/app.js') }}"></script>
</body>