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
    <header class="bg-white p-4 shadow-md text-gray-500 rounded-xl z-0 ">
        <div class="container mx-auto flex justify-between items-center">
            <div class="relative text-gray-500 focus-within:text-gray-900 w-auto">
                <input type="text" id="default-search" class="block w-64 h-11 p-5 text-base font-normal text-gray-900 bg-transparent border border-gray-300 rounded-full placeholder-gray-400 focus:outline-none" placeholder="Search">
            </div>
            <div class="flex flex-shrink-0 items-center ml-auto">
                <button class="inline-flex items-center p-2 hover:bg-gray-100 focus:bg-gray-100 rounded-lg">
                    <span class="sr-only">User Menu</span>
                    <div class="hidden md:flex md:flex-col md:items-end md:leading-tight">
                        {{-- <span class="font-semibold">
                            {{ $profile->nama_guru }}
                        </span>
                        <span class="text-sm text-gray-600">
                            {{ $user->role }}
                        </span> --}}
                    </div>
                    <span class="h-12 w-12 ml-2 sm:ml-3 mr-2 bg-gray-100 rounded-full overflow-hidden">
                      <img src="{{ asset('img/logo_gamaliel.png') }}" alt="user profile photo" class="h-full w-full object-cover">
                    </span>
                </button>
                <div class="border-l pl-3 ml-3 space-x-1">
                    <form action="{{ route('logout') }}" method="POST" id="logout-form" class="inline">
                        @csrf <!-- Token CSRF untuk keamanan -->
                        <button type="submit" class="relative p-2 text-gray-400 hover:bg-gray-100 hover:text-gray-600 focus:bg-gray-100 focus:text-gray-600 rounded-full">
                            <span class="sr-only">Log out</span>
                            <svg aria-hidden="true" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-6 w-6">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                            </svg>
                        </button>
                    </form>
                </div>
            </div>


        </div>
    </header>
</body>
</html>
