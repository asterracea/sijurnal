@extends('layouts.admin')

@section('title', 'SiJurnal Guru')

@section('content')

<div class="flex-grow p-5">
    <div class="bg-white shadow-md rounded-xl overflow-hidden">
        <div class="flex justify-between items-center m-4">
            <div class="relative text-black font-bold text-xl w-auto">
                <h1>Mata Pelajaran</h1>
            </div>
            <button onclick="openModalMapel()" class="bg-blue-500 text-white px-4 py-2 rounded-full hover:bg-blue-700 transition duration-300 ease-in-out">
                Create
            </button>
        </div>
        <table class="w-full">
            <thead>
                <tr class="bg-gray-50">
                    <th class="p-5 text-left text-sm leading-6 font-semibold text-gray-900 capitalize">Mata Pelajaran</th>
                    <th class="p-5 text-left text-sm leading-6 font-semibold text-gray-900 capitalize">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-300">
                @foreach($mapel as $item)
                    <tr>
                        <td class="p-5">{{ $item->nama_mapel }}</td>
                        <td class="p-5 flex space-x-2">
                            <button onclick="openEditModal({{ $item->id_mapel }}, '{{ $item->nama_mapel }}')" class="bg-yellow-500 text-white px-2 py-1 rounded">Edit</button>
                            <button onclick="openDeleteModal({{ $item->id_mapel }})" class="bg-red-500 text-white px-2 py-1 rounded">Hapus</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@if ($errors->has('error'))
    <div id="error-message" class="bg-red-500 text-white p-3 rounded mb-4">
        {{ $errors->first('error') }}
    </div>
@endif

@if (session('success'))
    <div id="success-message" class="bg-red-500 text-white p-3 rounded mb-4">
        {{ session('success') }}
    </div>
@endif

@if (session('delete'))
    <div id="delete-message" class="bg-red-500 text-white p-3 rounded mb-4">
        {{ session('delete') }}
    </div>
@endif

<!-- Modal -->
<div id="modal" class="fixed inset-0 bg-gray-900 bg-opacity-50 z-50 hidden flex justify-center items-center">
    <div class="bg-white rounded-lg w-1/3 p-5">
        <h2 class="text-xl font-bold mb-4">Create Mata Pelajaran</h2>
        <form action="{{ route('mapel.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="nama_mapel" class="block text-sm font-semibold">Mata Pelajaran</label>
                <input
                    type="text"
                    name="nama_mapel"
                    id="nama_mapel"
                    class="w-full px-3 py-2 border rounded"
                    placeholder="Contoh: Bahasa Inggris"
                    required
                >
                <p class="text-sm text-gray-500 mt-1">
                    Masukkan nama mata pelajaran, misalnya "Bahasa Inggris".
                </p>
            </div>
            <div class="flex justify-end space-x-4">
                <button
                    type="button"
                    onclick="resetAndCloseModal()"
                    class="bg-gray-500 text-white px-4 py-2 rounded"
                >
                    Batal
                </button>
                <button
                    type="submit"
                    class="bg-blue-500 text-white px-4 py-2 rounded"
                >
                    Save
                </button>
            </div>
        </form>
    </div>
</div>


<!-- Modal Edit -->
<div id="edit-modal" class="fixed inset-0 bg-gray-900 bg-opacity-50 z-50 hidden flex justify-center items-center">
    <div class="bg-white rounded-lg w-1/3 p-5">
        <h2 class="text-xl font-bold mb-4">Edit Mata Pelajaran</h2>
        <form id="edit-form" action="" method="POST">
            @csrf
            @method('PUT') <!-- Spoofing method -->
            <input type="hidden" name="id" id="edit-id"> <!-- This should be 'edit-id' -->

            <div class="mb-4">
                <label for="edit_nama_mapel" class="block text-sm font-semibold">Mata Pelajaran</label>
                <input type="text" name="nama_mapel" id="edit_nama_mapel" class="w-full px-3 py-2 border rounded" required>
            </div>

            <!-- Tombol Submit -->
            <div class="flex justify-end space-x-4">
                <button type="button" onclick="closeModalMapel('edit-modal')" class="bg-gray-500 text-white px-4 py-2 rounded">Batal</button>
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Simpan</button>
            </div>
        </form>
    </div>
</div>

<!-- Modal Hapus -->
<div id="delete-modal" class="fixed inset-0 bg-gray-900 bg-opacity-50 z-50 hidden flex justify-center items-center">
    <div class="bg-white rounded-lg w-1/3 p-5">
        <h2 class="text-xl font-bold mb-4">Konfirmasi Hapus</h2>
        <p>Apakah Anda yakin ingin menghapus mata pelajaran ini?</p>
        <form id="delete-form" action="" method="POST">
            @csrf
            @method('DELETE')
            <div class="flex justify-end space-x-4">
                <button type="button" onclick="closeModalMapel('delete-modal')" class="bg-gray-500 text-white px-4 py-2 rounded">Batal</button>
                <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded">Hapus</button>
            </div>
        </form>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const errorMessage = document.getElementById('error-message');
        if (errorMessage) {
            setTimeout(() => {
                errorMessage.style.display = 'none';
            }, 3000);
        }
    });

    document.addEventListener('DOMContentLoaded', function () {
        const successMessage = document.getElementById('success-message');
        if (successMessage) {
            setTimeout(() => {
                successMessage.style.display = 'none';
            }, 3000);
        }
    });

    document.addEventListener('DOMContentLoaded', function () {
        const deleteMessage = document.getElementById('delete-message');
        if (deleteMessage) {
            setTimeout(() => {
                deleteMessage.style.display = 'none';
            }, 3000);
        }
    });

    function openEditModal(id_mapel, nama_mapel) {
    document.getElementById('edit-id').value = id_mapel; // Set ID untuk edit
    document.getElementById('edit_nama_mapel').value = nama_mapel;
    document.getElementById('edit-modal').classList.remove('hidden'); // Tampilkan modal edit

    document.getElementById('edit-form').action = '/admin/mapel/' + id_tahun;

    // Tampilkan modal edit
    document.getElementById('edit-modal').classList.remove('hidden');
    }

    function openDeleteModal(id) {
        document.getElementById('delete-form').action = '/admin/mapel/' + id;  // Set the form action
        document.getElementById('delete-modal').classList.remove('hidden'); // Show the delete modal
    }

    function openModalMapel() {
        resetAndCloseModal();
        document.getElementById('modal').classList.remove('hidden');
        const modal = document.getElementById('modal');
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }

    function closeModalMapel(modalId) {
        document.getElementById(modalId).classList.add('hidden');
    }

    function resetAndCloseModal() {
    // Reset semua select ke opsi default
    document.getElementById('nama_mapel').value = '';

    // Tutup modal
    const modal = document.getElementById('modal');
    modal.classList.add('hidden');
    modal.classList.remove('flex');
    }
</script>

@endsection
