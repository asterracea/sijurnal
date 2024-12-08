@extends('layouts.admin')

@section('title', 'SiJurnal Guru')

@section('content')

<div class="flex-grow p-5">
    <div class="bg-white shadow-md rounded-xl overflow-hidden">
        <div class="flex justify-between items-center m-4">
            <div class="relative text-black font-bold text-xl w-auto">
                <h1>Tahun Pelajaran</h1>
            </div>
            <div class="flex items-center space-x-4">
                <!-- Dropdown Filter -->
                <select id="status-filter" class="border px-8 py-2 rounded" onchange="filterStatus()">
                    <option value="">Semua Status</option>
                    <option value="Aktif">Aktif</option>
                    <option value="Tidak Aktif">Tidak Aktif</option>
                </select>
                <button onclick="openModal()" class="bg-blue-500 text-white px-4 py-2 rounded-full hover:bg-blue-700 transition duration-300 ease-in-out">
                    Create
                </button>
            </div>
        </div>
        <table id="data-table" class="w-full">
            <thead>
                <tr class="bg-gray-50">
                    <th class="p-5 text-left text-sm leading-6 font-semibold text-gray-900 capitalize">Tahun Ajaran</th>
                    <th class="p-5 text-left text-sm leading-6 font-semibold text-gray-900 capitalize">Semester</th>
                    <th class="p-5 text-left text-sm leading-6 font-semibold text-gray-900 capitalize">Status</th>
                    <th class="p-5 text-left text-sm leading-6 font-semibold text-gray-900 capitalize">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-300">
                @foreach($tahun as $item)
                    <tr data-status="{{ $item->status }}">
                        <td class="p-5">{{ $item->tahun_ajaran }}</td>
                        <td class="p-5">{{ $item->semester }}</td>
                        <td class="p-5">{{ $item->status }}</td>
                        <td class="p-5 flex space-x-2">
                            <button onclick="openEditModal({{ $item->id_tahun }}, '{{ $item->tahun_ajaran }}', '{{ $item->semester }}', '{{ $item->status }}')" class="bg-yellow-500 text-white px-2 py-1 rounded">Edit</button>
                            <button onclick="openDeleteModal({{ $item->id_tahun }})" class="bg-red-500 text-white px-2 py-1 rounded">Hapus</button>
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
        <h2 class="text-xl font-bold mb-4">Create Tahun dan Semester</h2>
        <form action="{{ route('tahun.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="tahun_ajaran" class="block text-sm font-semibold">Tahun Ajaran</label>
                <input type="text" name="tahun_ajaran" id="tahun_ajaran" class="w-full px-3 py-2 border rounded" required>
            </div>
            <div class="mb-4">
                <label for="semester" class="block text-sm font-semibold">Semester</label>
                <select name="semester" id="semester" class="w-full px-3 py-2 border rounded" required>
                    <option value="Ganjil">Ganjil</option>
                    <option value="Genap">Genap</option>
                </select>
            </div>
            <div class="mb-4">
                <label for="status" class="block text-sm font-semibold">Status</label>
                <select name="status" id="status" class="w-full px-3 py-2 border rounded" required>
                    <option value="Aktif">Aktif</option>
                    <option value="Tidak Aktif">Tidak Aktif</option>
                </select>
            </div>
            <div class="flex justify-end space-x-4">
                <button type="button" onclick="resetAndCloseModal()" class="bg-gray-500 text-white px-4 py-2 rounded">Batal</button>
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Save</button>
            </div>
        </form>
    </div>
</div>

<!-- Modal Edit -->
<div id="edit-modal" class="fixed inset-0 bg-gray-900 bg-opacity-50 z-50 hidden flex justify-center items-center">
    <div class="bg-white rounded-lg w-1/3 p-5">
        <h2 class="text-xl font-bold mb-4">Edit Tahun dan Semester</h2>
        <form id="edit-form" action="" method="POST">
            @csrf
            @method('PUT') <!-- Spoofing method -->
            <input type="hidden" name="id" id="edit-id"> <!-- This should be 'edit-id' -->

            <!-- Field Tahun Ajaran -->
            <div class="mb-4">
                <label for="edit_tahun_ajaran" class="block text-sm font-semibold">Tahun Ajaran</label>
                <input type="text" name="tahun_ajaran" id="edit_tahun_ajaran" class="w-full px-3 py-2 border rounded" required>
            </div>

            <!-- Field Semester -->
            <div class="mb-4">
                <label for="edit_semester" class="block text-sm font-semibold">Semester</label>
                <select name="semester" id="edit_semester" class="w-full px-3 py-2 border rounded" required>
                    <option value="Ganjil">Ganjil</option>
                    <option value="Genap">Genap</option>
                </select>
            </div>

            <div class="mb-4">
                <label for="edit_status" class="block text-sm font-semibold">Status</label>
                <select name="status" id="edit_status" class="w-full px-3 py-2 border rounded" required>
                    <option value="Aktif">Aktif</option>
                    <option value="Tidak Aktif">Tidak Aktif</option>
                </select>
            </div>

            <!-- Tombol Submit -->
            <div class="flex justify-end space-x-4">
                <button type="button" onclick="closeModal('edit-modal')" class="bg-gray-500 text-white px-4 py-2 rounded">Batal</button>
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Simpan</button>
            </div>
        </form>
    </div>
</div>

<!-- Modal Hapus -->
<div id="delete-modal" class="fixed inset-0 bg-gray-900 bg-opacity-50 z-50 hidden flex justify-center items-center">
    <div class="bg-white rounded-lg w-1/3 p-5">
        <h2 class="text-xl font-bold mb-4">Konfirmasi Hapus</h2>
        <p>Apakah Anda yakin ingin menghapus tahun ajaran ini?</p>
        <form id="delete-form" action="" method="POST">
            @csrf
            @method('DELETE')
            <div class="flex justify-end space-x-4">
                <button type="button" onclick="closeModal('delete-modal')" class="bg-gray-500 text-white px-4 py-2 rounded">Batal</button>
                <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded">Hapus</button>
            </div>
        </form>
    </div>
</div>

<script>

    function filterStatus() {
        const filter = document.getElementById('status-filter').value; // Ambil nilai filter
        const rows = document.querySelectorAll('#data-table tbody tr'); // Ambil semua baris tabel

        rows.forEach(row => {
            const status = row.getAttribute('data-status'); // Ambil atribut data-status
            if (filter === '' || status === filter) {
                row.style.display = ''; // Tampilkan baris jika cocok
            } else {
                row.style.display = 'none'; // Sembunyikan baris jika tidak cocok
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

    function openEditModal(id_tahun, tahun_ajaran, semester, status) {
    document.getElementById('edit-id').value = id_tahun; // Set ID untuk edit
    document.getElementById('edit_tahun_ajaran').value = tahun_ajaran; // Set nilai tahun ajaran
    document.getElementById('edit_semester').value = semester;
    document.getElementById('edit_status').value = status;
    document.getElementById('edit-modal').classList.remove('hidden'); // Tampilkan modal edit

    document.getElementById('edit-form').action = '/admin/tahun/' + id_tahun;

    document.getElementById('edit-modal').classList.remove('hidden');
    }

    function openDeleteModal(id) {
        document.getElementById('delete-form').action = '/admin/tahun/' + id;
        document.getElementById('delete-modal').classList.remove('hidden');
    }

    function openModal() {
        resetAndCloseModal();
        document.getElementById('modal').classList.remove('hidden');
        const modal = document.getElementById('modal');
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }

    function closeModal(modalId) {
        document.getElementById(modalId).classList.add('hidden');
    }

    function resetAndCloseModal() {
    // Reset semua select ke opsi default
    document.getElementById('tahun_ajaran').value = '';
    document.getElementById('semester').value = '';
    document.getElementById('status').value = '';

    // Tutup modal
    const modal = document.getElementById('modal');
    modal.classList.add('hidden');
    modal.classList.remove('flex');
    }
</script>

@endsection
