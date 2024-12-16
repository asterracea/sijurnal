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
            </div>
            <div class="flex flex-shrink-0 items-center ml-auto">
                <button class="inline-flex items-center p-2 hover:bg-gray-100 focus:bg-gray-100 rounded-lg">
                    <span class="sr-only">User Menu</span>
                    <div class="hidden md:flex md:flex-col md:items-end md:leading-tight">
                        <span class="font-semibold">
                            {{-- {{ $accountname->nama_guru }} --}}
                        </span>
                        <span class="text-sm text-gray-600">
                            {{ Auth::user()->role }}
                        </span>
                    </div>
                    <span class="h-12 w-12 ml-2 sm:ml-3 mr-2 bg-gray-100  overflow-hidden">
                      <img src="{{ asset('img/logo_gamaliel.png') }}" alt="user profile photo" class="h-full w-full ">
                    </span>
                </button>
                <div class="border-l pl-3 ml-3 space-x-1">
                    <button onclick="logoutModal()" class="relative p-2 text-gray-400 hover:bg-gray-100 hover:text-gray-600 focus:bg-gray-100 focus:text-gray-600 rounded-full">
                        <span class="sr-only">Log out</span>
                        <svg aria-hidden="true" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-6 w-6">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </header>

    <!-- Modal for Logout Confirmation -->
    <div id="logoutModal" class="fixed z-50 inset-0 overflow-y-auto hidden">
        <div class="flex items-center justify-center min-h-screen">
            <div class="bg-white rounded-lg shadow-lg p-5 max-w-sm w-full">
                <h2 class="text-lg font-semibold mb-4">Konfirmasi Logout</h2>
                <p>Apakah Anda yakin ingin logout?</p>
                <div class="mt-4 flex justify-end">
                    <button onclick="closeModal()" class="mr-2 px-4 py-2 bg-gray-300 hover:bg-gray-400 rounded">Batal</button>
                    <form action="{{ route('logout') }}" method="POST" id="logout-form">
                        @csrf <!-- Token CSRF untuk keamanan -->
                        <button type="submit" class="px-4 py-2 bg-red-500 text-white hover:bg-red-600 rounded">Logout</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            function logoutModal() {
                document.getElementById('logoutModal').classList.remove('hidden');
            }

            function closeModal() {
                document.getElementById('logoutModal').classList.add('hidden');
            }

            window.logoutModal = logoutModal; // Agar bisa dipanggil dari HTML
            window.closeModal = closeModal;
        });
    </script>
</body>
</html>
