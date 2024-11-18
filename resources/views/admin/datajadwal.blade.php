@extends('layouts.admin')

@section('title', 'SiJurnal Guru')

@section('content')

<div class="flex-grow p-5">
    <div class="bg-white shadow-md rounded-xl overflow-hidden">
        <div class="flex justify-between items-center m-4">
            <div class="relative text-black font-bold text-xl w-auto">
                <h1>Jadwal Pelajaran</h1>
            </div>
            <button onclick="openModal()" class="bg-blue-500 text-white px-4 py-2 rounded-full hover:bg-blue-700 transition duration-300 ease-in-out">
                Create
            </button>
        </div>
        <table class="w-full">
            <thead>
                <tr class="bg-gray-50">
                    <th class="p-5 text-left text-sm leading-6 font-semibold text-gray-900 capitalize">Nama Guru</th>
                    <th class="p-5 text-left text-sm leading-6 font-semibold text-gray-900 capitalize">Tahun Ajaran</th>
                    <th class="p-5 text-left text-sm leading-6 font-semibold text-gray-900 capitalize">Semester</th>
                    <th class="p-5 text-left text-sm leading-6 font-semibold text-gray-900 capitalize">Kelas</th>
                    <th class="p-5 text-left text-sm leading-6 font-semibold text-gray-900 capitalize">Mata Pelajaran</th>
                    <th class="p-5 text-left text-sm leading-6 font-semibold text-gray-900 capitalize">Hari</th>
                    <th class="p-5 text-left text-sm leading-6 font-semibold text-gray-900 capitalize">Jam Mulai</th>
                    <th class="p-5 text-left text-sm leading-6 font-semibold text-gray-900 capitalize">Jam Selesai</th>
                    <th class="p-5 text-left text-sm leading-6 font-semibold text-gray-900 capitalize">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-300">
                @foreach($jadwal as $item)
                    <tr>
                        <td class="p-5">{{ $item->guru->nama_guru }}</td>
                        <td class="p-5">{{ $item->tahun->tahun_ajaran }}</td>
                        <td class="p-5">{{ $item->tahun->semester }}</td>
                        <td class="p-5">{{ $item->kelas->nama_kelas }}</td>
                        <td class="p-5">{{ $item->mapel->nama_mapel }}</td>
                        <td class="p-5">{{ $item->hari }}</td>
                        <td class="p-5">{{ $item->jam_mulai }}</td>
                        <td class="p-5">{{ $item->jam_selesai }}</td>
                        <td class="p-5 flex space-x-2">
                            <button onclick="openEditModal({{ $item->id }}, '{{ $item->guru->nip }}', '{{ $item->tahun->id_tahun }}', '{{ $item->kelas->id_kelas }}', '{{ $item->mapel->id_mapel }}', '{{ $item->hari }}', '{{ $item->jam_mulai }}', '{{ $item->jam_selesai }}')" class="bg-yellow-500 text-white px-2 py-1 rounded">Edit</button>
                            <button onclick="openDeleteModal({{ $item->id }})" class="bg-red-500 text-white px-2 py-1 rounded">Hapus</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Modal Create -->
<div id="modal" class="fixed inset-0 bg-gray-900 bg-opacity-50 z-50 hidden flex justify-center items-center">
    <div class="bg-white rounded-lg w-1/3 p-5">
        <h2 class="text-xl font-bold mb-4">Tambah Jadwal Pelajaran</h2>
        <form action="{{ route('datajadwal.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="nip" class="block text-sm font-semibold">Nama Guru</label>
                <select name="nip" id="nip" class="w-full px-3 py-2 border rounded" required>
                    @foreach($gurus as $guru)
                        <option value="{{ $guru->nip }}">{{ $guru->nama_guru }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-4">
                <label for="id_tahun" class="block text-sm font-semibold">Tahun Ajaran</label>
                <select name="id_tahun" id="id_tahun" class="w-full px-3 py-2 border rounded" required>
                    @foreach($tahun as $item)
                        <option value="{{ $item->id_tahun }}">{{ $item->tahun_ajaran }} - {{ $item->semester }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-4">
                <label for="id_kelas" class="block text-sm font-semibold">Nama Kelas</label>
                <select name="id_kelas" id="id_kelas" class="w-full px-3 py-2 border rounded" required>
                    @foreach($kelas as $item)
                        <option value="{{ $item->id_kelas }}">{{ $item->nama_kelas }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-4">
                <label for="id_mapel" class="block text-sm font-semibold">Mata Pelajaran</label>
                <select name="id_mapel" id="id_mapel" class="w-full px-3 py-2 border rounded" required>
                    @foreach($mapel as $item)
                        <option value="{{ $item->id_mapel }}">{{ $item->nama_mapel }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-4">
                <label for="hari" class="block text-sm font-semibold">Hari</label>
                <select name="hari" id="hari" class="w-full px-3 py-2 border rounded" required>
                    <option value="Senin">Senin</option>
                    <option value="Selasa">Selasa</option>
                    <option value="Rabu">Rabu</option>
                    <option value="Kamis">Kamis</option>
                    <option value="Jumat">Jumat</option>
                    <option value="Sabtu">Sabtu</option>
                </select>
            </div>
            <div class="mb-4">
                <label for="jam_mulai" class="block text-sm font-semibold">Jam Mulai</label>
                <input type="time" name="jam_mulai" id="jam_mulai" class="w-full px-3 py-2 border rounded" required>
            </div>
            <div class="mb-4">
                <label for="jam_selesai" class="block text-sm font-semibold">Jam Selesai</label>
                <input type="time" name="jam_selesai" id="jam_selesai" class="w-full px-3 py-2 border rounded" required>
            </div>
            <div class="flex justify-end space-x-4">
                <button type="button" onclick="closeModal()" class="bg-gray-500 text-white px-4 py-2 rounded">Batal</button>
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Simpan</button>
            </div>
        </form>
    </div>
</div>

<div id="edit-modal" class="fixed inset-0 bg-gray-900 bg-opacity-50 z-50 hidden justify-center items-center">
    <div class="bg-white rounded-lg w-1/3 p-5">
        <h2 class="text-xl font-bold mb-4">Edit Jadwal Pelajaran</h2>
        <form id="edit-form" action="{{ route('datajadwal.update', ['id_jadwal' => $item->id_jadwa]) }}" method="POST">
            @csrf
            @method('PUT') <!-- Spoofing method -->
            <input type="hidden" name="id" id="edit-id">

            <div class="mb-4">
                <label for="edit_nip" class="block text-sm font-semibold">Nama Guru</label>
                <input type="text" name="nip" id="edit_nip" class="w-full px-3 py-2 border rounded" required>
            </div>

            <div class="mb-4">
                <label for="edit_id_tahun" class="block text-sm font-semibold">Tahun Ajaran</label>
                <input type="text" name="id_tahun" id="edit_id_tahun" class="w-full px-3 py-2 border rounded" required>
            </div>

            <div class="mb-4">
                <label for="edit_id_kelas" class="block text-sm font-semibold">Nama Kelas</label>
                <input type="text" name="id_kelas" id="edit_id_kelas" class="w-full px-3 py-2 border rounded" required>
            </div>

            <div class="mb-4">
                <label for="edit_id_mapel" class="block text-sm font-semibold">Mata Pelajaran</label>
                <input type="text" name="id_mapel" id="edit_id_mapel" class="w-full px-3 py-2 border rounded" required>
            </div>

            <div class="mb-4">
                <label for="edit_hari" class="block text-sm font-semibold">Hari</label>
                <input type="text" name="hari" id="edit_hari" class="w-full px-3 py-2 border rounded" required>
            </div>

            <div class="mb-4">
                <label for="edit_jam_mulai" class="block text-sm font-semibold">Jam Mulai</label>
                <input type="time" name="jam_mulai" id="edit_jam_mulai" class="w-full px-3 py-2 border rounded" required>
            </div>

            <div class="mb-4">
                <label for="edit_jam_selesai" class="block text-sm font-semibold">Jam Selesai</label>
                <input type="time" name="jam_selesai" id="edit_jam_selesai" class="w-full px-3 py-2 border rounded" required>
            </div>

            <!-- Tombol Submit -->
            <div class="flex justify-end space-x-4">
                <button type="button" onclick="closeModal('edit-modal')" class="bg-gray-500 text-white px-4 py-2 rounded">Batal</button>
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Simpan</button>
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

    function openEditModal(id_jadwal, id_tahun, nip, id_kelas, id_mapel, hari, jam_mulai, jam_selesai) {
    document.getElementById('edit-id').value = id_jadwal;
    document.getElementById('edit_id_tahun').value = id_tahun;
    document.getElementById('edit_nip').value = nip;
    document.getElementById('edit_id_kelas').value = id_kelas;
    document.getElementById('edit_id_mapel').value = id_mapel;
    document.getElementById('edit_hari').value = hari;
    document.getElementById('edit_jam_mulai').value = jam_mulai;
    document.getElementById('edit_jam_selesai').value = jam_selesai;
    document.getElementById('edit-modal').classList.remove('hidden');
    }

    function openDeleteModal(id) {
        document.getElementById('delete-form').action = '/admin/mapel/' + id;  // Set the form action
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
