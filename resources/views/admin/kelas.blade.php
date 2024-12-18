@extends('layouts.admin')

@section('title', 'SiJurnal Guru')

@section('content')

<div class="flex-grow p-5">
    <div class="bg-white shadow-md rounded-xl overflow-hidden">
        <div class="flex justify-between items-center m-4">
            <div class="relative text-black font-bold text-xl w-auto">
                <h1>Kelas</h1>
            </div>
            <div class="flex items-center space-x-4">
                <!-- Dropdown Filter -->
                <select id="filter" onchange="filterKelas()" class="border border-gray-300 rounded px-8 py-2">
                    <option value="all">Semua</option>
                    <option value="12">Kelas 12</option>
                    <option value="11">Kelas 11</option>
                    <option value="10">Kelas 10</option>
                </select>
                <button onclick="openModalKelas()" class="bg-blue-500 text-white px-4 py-2 rounded-full hover:bg-blue-700 transition duration-300 ease-in-out">
                    Create
                </button>
            </div>
        </div>
        <table id="data-table" class="w-full">
            <thead>
                <tr class="bg-gray-50">
                    <th class="p-5 text-left text-sm leading-6 font-semibold text-gray-900 capitalize">Nama Kelas</th>
                    <th class="p-5 text-left text-sm leading-6 font-semibold text-gray-900 capitalize">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-300" id="kelas-table-body">
                @foreach($kelas as $item)
                    <tr data-nama-kelas="{{ $item->nama_kelas }}">
                        <td class="p-5">{{ $item->nama_kelas }}</td>
                        <td class="p-5 flex space-x-2">
                            <button onclick="openEditModal({{ $item->id_kelas }}, '{{ $item->nama_kelas }}')" class="bg-yellow-500 text-white px-2 py-1 rounded">Edit</button>
                            <button onclick="openDeleteModal({{ $item->id_kelas }})" class="bg-red-500 text-white px-2 py-1 rounded">Hapus</button>
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
        <h2 class="text-xl font-bold mb-4">Create Kelas</h2>
        <form action="{{ route('kelas.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="nama_kelas" class="block text-sm font-semibold">Nama Kelas</label>
                <input
                    type="text"
                    name="nama_kelas"
                    id="nama_kelas"
                    class="w-full px-3 py-2 border rounded"
                    placeholder="Contoh: 10 MA"
                    required
                >
                <p class="text-sm text-gray-500 mt-1">
                    Masukkan nama kelas sesuai format, misalnya "10 MA".
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
        <h2 class="text-xl font-bold mb-4">Edit Kelas</h2>
        <form id="edit-form" action="" method="POST">
            @csrf
            @method('PUT') <!-- Spoofing method -->
            <input type="hidden" name="id" id="edit-id"> <!-- This should be 'edit-id' -->

            <!-- Field Tahun Ajaran -->
            <div class="mb-4">
                <label for="edit_nama_kelas" class="block text-sm font-semibold">Kelas</label>
                <input type="text" name="nama_kelas" id="edit_nama_kelas" class="w-full px-3 py-2 border rounded" required>
            </div>

            <!-- Tombol Submit -->
            <div class="flex justify-end space-x-4">
                <button type="button" onclick="closeModalKelas('edit-modal')" class="bg-gray-500 text-white px-4 py-2 rounded">Batal</button>
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Simpan</button>
            </div>
        </form>
    </div>
</div>


<!-- Modal Hapus -->
<div id="delete-modal" class="fixed inset-0 bg-gray-900 bg-opacity-50 z-50 hidden flex justify-center items-center">
    <div class="bg-white rounded-lg w-1/3 p-5">
        <h2 class="text-xl font-bold mb-4">Konfirmasi Hapus</h2>
        <p>Apakah Anda yakin ingin menghapus kelas ini?</p>
        <form id="delete-form" action="" method="POST">
            @csrf
            @method('DELETE')
            <div class="flex justify-end space-x-4">
                <button type="button" onclick="closeModalKelas('delete-modal')" class="bg-gray-500 text-white px-4 py-2 rounded">Batal</button>
                <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded">Hapus</button>
            </div>
        </form>
    </div>
</div>

<script>
    function filterKelas() {
        const filter = document.getElementById('filter').value; // Ambil nilai filter
        const rows = document.querySelectorAll('#kelas-table-body tr'); // Ambil semua baris tabel

        rows.forEach(row => {
            const namaKelas = row.getAttribute('data-nama-kelas'); // Ambil atribut data-nama-kelas
            if (filter === 'all') {
                row.style.display = ''; // Tampilkan semua baris
            } else if (namaKelas.startsWith(filter)) {
                row.style.display = ''; // Tampilkan baris yang sesuai filter
            } else {
                row.style.display = 'none'; // Sembunyikan baris yang tidak sesuai
            }
        });
    }

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

    function openEditModal(id_kelas, nama_kelas) {
    document.getElementById('edit-id').value = id_kelas; // Set ID untuk edit
    document.getElementById('edit_nama_kelas').value = nama_kelas;
    document.getElementById('edit-modal').classList.remove('hidden'); // Tampilkan modal edit

    document.getElementById('edit-form').action = '/admin/kelas/' + id_tahun;

    // Tampilkan modal edit
    document.getElementById('edit-modal').classList.remove('hidden');
    }

    function openDeleteModal(id) {
        document.getElementById('delete-form').action = '/admin/kelas/' + id;  // Set the form action
        document.getElementById('delete-modal').classList.remove('hidden'); // Show the delete modal
    }

    function openModalKelas() {
        resetAndCloseModal();
        document.getElementById('modal').classList.remove('hidden');
        const modal = document.getElementById('modal');
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }

    function closeModalKelas(modalId) {
        document.getElementById(modalId).classList.add('hidden');
    }

    function resetAndCloseModal() {
    // Reset semua select ke opsi default
    document.getElementById('nama_kelas').value = '';

    // Tutup modal
    const modal = document.getElementById('modal');
    modal.classList.add('hidden');
    modal.classList.remove('flex');
    }
</script>

@endsection
