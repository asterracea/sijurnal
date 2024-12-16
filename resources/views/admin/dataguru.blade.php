@extends('layouts.admin')

@section('title', 'SiJurnal Guru')

@section('content')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
    @vite('resources/css/app.css')
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sistem Informasi Jurnal Guru</title>
</head>
<body class="flex bg-white min-h-screen">
    <div class="flex-grow p-5">
        <div class="bg-white shadow-md rounded-xl overflow-hidden">
            <div class="flex justify-between items-center m-4">
                <h1 class="font-bold text-xl">Daftar Data Guru</h1>
                <button onclick="openModal('create-modal')" class="bg-blue-500 text-white px-4 py-2 rounded-full hover:bg-blue-700">
                    Create
                </button>
            </div>

            <table class="w-full">
                <thead>
                    <tr class="bg-gray-50">
                        <th class="p-5 text-left text-sm font-semibold">NIP</th>
                        <th class="p-5 text-left text-sm font-semibold">Nama Guru</th>
                        <th class="p-5 text-left text-sm font-semibold">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($dataguru as $guru)
                        <tr class="hover:bg-gray-50">
                            <td class="p-5">{{ $guru->nip }}</td>
                            <td class="p-5">{{ $guru->nama_guru }}</td>
                            <td class="p-5">
                                <button onclick="openEditModal('{{ $guru->nip }}', '{{ $guru->nama_guru }}')"
                                    class="text-blue-500 hover:text-blue-700 mr-4">
                                    <i class="fa fa-pencil" aria-hidden="true"></i>
                                </button>
                                <form action="{{ route('dataguru.destroy', $guru->nip) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button class="text-red-500 hover:text-red-700" type="submit">
                                        <i class="fa fa-trash" aria-hidden="true"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal Create -->
    <div id="create-modal" class="fixed inset-0 bg-gray-900 bg-opacity-50 hidden z-50 flex justify-center items-center">
        <div class="bg-white p-6 rounded-lg shadow-lg w-1/3">
            <h2 class="text-lg font-semibold mb-4">Create Data Guru</h2>
            <form action="{{ route('dataguru.store') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="nip" class="block text-sm font-semibold">NIP</label>
                    <input type="text" name="nip" id="nip" class="w-full px-3 py-2 border rounded" required>
                </div>
                <div class="mb-4">
                    <label for="nama_guru" class="block text-sm font-semibold">Nama Guru</label>
                    <input type="text" name="nama_guru" id="nama_guru" class="w-full px-3 py-2 border rounded" required>
                </div>
                <div class="flex justify-end space-x-4">
                    <button type="button" onclick="closeModal('create-modal')" class="bg-gray-500 text-white px-4 py-2 rounded">Cancel</button>
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Save</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Edit -->
    <div id="edit-modal" class="fixed inset-0 bg-gray-900 bg-opacity-50 hidden z-50 flex justify-center items-center">
        <div class="bg-white p-6 rounded-lg shadow-lg w-1/3">
            <h2 class="text-lg font-semibold mb-4">Edit Data Guru</h2>
            <form id="edit-form" action="#" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <label for="edit-nip" class="block text-sm font-semibold">NIP</label>
                    <input type="text" name="nip" id="edit-nip" class="w-full px-3 py-2 border rounded" required>
                </div>
                <div class="mb-4">
                    <label for="edit-nama_guru" class="block text-sm font-semibold">Nama Guru</label>
                    <input type="text" name="nama_guru" id="edit-nama_guru" class="w-full px-3 py-2 border rounded" required>
                </div>
                <div class="flex justify-end space-x-4">
                    <button type="button" onclick="closeModal('edit-modal')" class="bg-gray-500 text-white px-4 py-2 rounded">Cancel</button>
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Save</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Hapus -->
    <div id="delete-modal" class="fixed inset-0 bg-gray-900 bg-opacity-50 z-50 hidden flex justify-center items-center">
        <div class="bg-white rounded-lg w-1/3 p-5">
            <h2 class="text-xl font-bold mb-4">Konfirmasi Hapus</h2>
            <p>Apakah Anda yakin ingin menghapus tahun ajaran ini?</p>
            <div class="flex justify-end space-x-4">
                <button type="button" onclick="closeModal('delete-modal')" class="bg-gray-500 text-white px-4 py-2 rounded">Batal</button>
                <button id="confirm-delete" class="bg-red-500 text-white px-4 py-2 rounded">Hapus</button>
            </div>
        </div>
    </div>

    <script>
        function openModal(modalId) {
            document.getElementById(modalId).classList.remove('hidden');
        }

        function closeModal(modalId) {
            document.getElementById(modalId).classList.add('hidden');
        }

        function openEditModal(nip, namaGuru) {
            const editModal = document.getElementById('edit-modal');
            const editForm = document.getElementById('edit-form');

            document.getElementById('edit-nip').value = nip;
            document.getElementById('edit-nama_guru').value = namaGuru;

            // Ubah URL action untuk update
            editForm.action = `/dataguru/${nip}`;

            editModal.classList.remove('hidden');
        }
    </script>
</body>
</html>

@endsection
