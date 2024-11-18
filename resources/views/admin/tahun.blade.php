@extends('layouts.admin')

@section('title', 'SiJurnal Guru')

@section('content')

<div class="flex-grow p-5">
    <div class="bg-white shadow-md rounded-xl overflow-hidden">
        <div class="flex justify-between items-center m-4">
            <div class="relative text-black font-bold text-xl w-auto">
                <h1>Tahun Pelajaran</h1>
            </div>
            <button onclick="openModal()" class="bg-blue-500 text-white px-4 py-2 rounded-full hover:bg-blue-700 transition duration-300 ease-in-out">
                Create
            </button>
        </div>
        <table class="w-full">
            <thead>
                <tr class="bg-gray-50">
                    <th class="p-5 text-left text-sm leading-6 font-semibold text-gray-900 capitalize">Tahun Ajaran</th>
                    <th class="p-5 text-left text-sm leading-6 font-semibold text-gray-900 capitalize">Semester</th>
                    <th class="p-5 text-left text-sm leading-6 font-semibold text-gray-900 capitalize">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-300">
                @foreach($tahun as $item)
                    <tr>
                        <td class="p-5">{{ $item->tahun_ajaran }}</td>
                        <td class="p-5">{{ $item->semester }}</td>
                        <td class="p-5 flex space-x-2">
                            <button onclick="openEditModal({{ $item->id_tahun }}, '{{ $item->tahun_ajaran }}', '{{ $item->semester }}')" class="bg-yellow-500 text-white px-2 py-1 rounded">Edit</button>
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
            <div class="flex justify-end space-x-4">
                <button type="button" onclick="closeModal()" class="bg-gray-500 text-white px-4 py-2 rounded">Cancel</button>
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Save</button>
            </div>
        </form>
    </div>
</div>

<!-- Modal Edit -->
<div id="edit-modal" class="fixed inset-0 bg-gray-900 bg-opacity-50 z-50 hidden justify-center items-center">
    <div class="bg-white rounded-lg w-1/3 p-5">
        <h2 class="text-xl font-bold mb-4">Edit Tahun dan Semester</h2>
        <form id="edit-form" action="{{ route('tahun.update', ['id_tahun' => $item->id_tahun]) }}" method="POST">
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

            <!-- Tombol Submit -->
            <div class="flex justify-end space-x-4">
                <button type="button" onclick="closeModal('edit-modal')" class="bg-gray-500 text-white px-4 py-2 rounded">Batal</button>
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Simpan</button>
            </div>
        </form>
    </div>
</div>

<!-- Modal Hapus -->
<div id="delete-modal" class="fixed inset-0 bg-gray-900 bg-opacity-50 z-50 hidden justify-center items-center">
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
    document.addEventListener('DOMContentLoaded', function () {
        const errorMessage = document.getElementById('error-message');
        if (errorMessage) {
            setTimeout(() => {
                errorMessage.style.display = 'none';
            }, 3000);
        }
    });

    function openEditModal(id_tahun, tahun_ajaran, semester) {
    document.getElementById('edit-id').value = id_tahun; // Set ID untuk edit
    document.getElementById('edit_tahun_ajaran').value = tahun_ajaran; // Set nilai tahun ajaran
    document.getElementById('edit_semester').value = semester; // Set nilai semester
    document.getElementById('edit-modal').classList.remove('hidden'); // Tampilkan modal edit
    }

    function openDeleteModal(id) {
        document.getElementById('delete-form').action = '/admin/tahun/' + id;  // Set the form action
        document.getElementById('delete-modal').classList.remove('hidden'); // Show the delete modal
    }

    function openModal() {
        document.getElementById('modal').classList.remove('hidden');
    }

    function closeModal(modalId) {
        document.getElementById(modalId).classList.add('hidden');
    }
</script>

@endsection
