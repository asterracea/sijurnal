<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  @vite('resources/css/app.css')
</head>
<body class="bg-white">
    <section class="min-h-screen  flex box-border justify-center items-center">
    <div class="bg-gray-100 bg-opacity-90 backdrop-filter backdrop-blur-lg shadow-md rounded-2xl flex max-w-3xl p-5 items-center">
        <div class="md:w-1/2 px-8">
            <h2 class="font-bold text-3xl text-[#002D74]">Login</h2>
            <p class="text-sm mt-4 text-[#002D74]">If you already a member, easily log in now.</p>

            <form action="{{ route('login') }}" method="POST" class="flex flex-col gap-4">
                @csrf
                <input class="p-2 mt-8 rounded-xl border" type="email" id="email" name="email" value="{{old('email')}}" placeholder="Email" required>
                <div class="relative mb-8">
                    <input class="p-2 rounded-xl border w-full" type="password" name="password" id="password" placeholder="Password" required>
                </div>

                <button class="bg-[#002D74] text-white py-2 rounded-xl hover:scale-105 duration-300 hover:bg-[#206ab1] font-medium" type="submit">Login</button>

            </form>

        </div>
        <div class="md:block hidden w-1/2">
            <img class="rounded-2xl max-h-[1600px]" src="https://images.unsplash.com/photo-1552010099-5dc86fcfaa38?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3w0NzEyNjZ8MHwxfHNlYXJjaHwxfHxmcmVzaHxlbnwwfDF8fHwxNzEyMTU4MDk0fDA&ixlib=rb-4.0.3&q=80&w=1080" alt="login form image">
        </div>
        </div>
    </section>
    @if($errors->any() || session('account_inactive') || session('error'))
    <div id="modal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50">
        <div class="bg-white border-t-4 border-red-500 rounded-lg p-6 shadow-lg w-11/12 sm:w-2/3 md:w-1/2 lg:w-1/3">
            <h3 class="text-lg md:text-xl font-bold text-red-600 mb-4">Kesalahan</h3>
            <p class="text-sm md:text-base text-gray-700 mb-4">
                @if($errors->any())
                    <!-- Jika ada error dari validasi -->
                    @foreach ($errors->all() as $error)
                        <span class="block">{{ $error }}</span>
                    @endforeach
                @elseif(session('account_inactive'))
                    <!-- Jika akun tidak aktif -->
                    Akun Anda tidak aktif. Silakan hubungi administrator untuk informasi lebih lanjut.
                @elseif(session('error'))
                    <!-- Pesan error dari session -->
                    {{ session('error') }}
                @endif
            </p>
            <div class="flex justify-end">
                <button onclick="closeModal()"
                        class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                    Tutup
                </button>
            </div>
        </div>
    </div>
    <script>
        function closeModal() {
            document.getElementById('modal').style.display = 'none';
        }
    </script>
@endif

</body>
</html>
