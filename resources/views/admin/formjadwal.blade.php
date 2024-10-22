@extends('layouts.admin')

@section('title', 'SiJurnal Guru - Form')

@section('content')

@if(session('success'))
    <div class="bg-green-500 text-white p-4 rounded mb-4">
        {{ session('success') }}
    </div>
@endif

<form action="{{ route('formjadwal.store') }}" method="POST">
    @csrf
    <div class="min-h-screen p-6 bg-gray-100 flex items-center justify-center">
        <div class="container min-h-screen-lg min-w-screen-lg mx-auto">
            <div>
                <h2 class="font-semibold text-xl text-gray-600">Form Jadwal Mata Pelajaran</h2>
                <p class="text-gray-500 mb-6">Silahkan isi form jadwal.</p>

                <div class="bg-white rounded shadow-lg p-4 px-4 md:p-8 mb-6">
                    <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 lg:grid-cols-3">
                        <div class="lg:col-span-2">
                            <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 md:grid-cols-5">
                                <div class="md:col-span-5">
                                    <label for="tahun_ajaran">Tahun Ajaran</label>
                                    <input type="text" name="tahun_ajaran" id="tahun_ajaran" class="h-10 border mt-1 rounded px-4 w-full bg-gray-50" required placeholder="Masukkan Tahun Ajaran" />
                                </div>
                                <div class="md:col-span-5">
                                    <label for="semester">Semester</label>
                                    <select name="semester" id="semester" class="h-10 border mt-1 rounded px-4 w-full bg-gray-50" required>
                                        <option value="Ganjil">Ganjil</option>
                                        <option value="Genap">Genap</option>
                                    </select>
                                </div>
                                <div class="md:col-span-5">
                                    <label for="nama_kelas">Nama Kelas</label>
                                    <input type="text" name="nama_kelas" id="nama_kelas" class="h-10 border mt-1 rounded px-4 w-full bg-gray-50" required placeholder="Masukkan Nama Kelas" />
                                </div>
                                <div class="md:col-span-5">
                                    <label for="nama_mapel">Nama Mapel</label>
                                    <input type="text" name="nama_mapel" id="nama_mapel" class="h-10 border mt-1 rounded px-4 w-full bg-gray-50" required placeholder="Masukkan Nama Mapel" />
                                </div>
                                <div class="md:col-span-5 text-right">
                                    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Submit</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</form>

<script>
    document.querySelector('form').addEventListener('submit', function() {
        this.querySelector('button[type="submit"]').disabled = true;
    });
</script>

@endsection
