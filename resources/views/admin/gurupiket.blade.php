@extends('layouts.admin')

@section('title', 'SiJurnal Guru')

@section('content')

<div class="flex-grow p-5">
    <div class="bg-white shadow-md rounded-xl overflow-hidden">
        <div class="flex justify-between items-center m-4">
            <div class="relative text-black font-bold text-xl w-auto">
                <h1>Jadwal Guru Piket</h1>
            </div>
            <div class="flex items-center space-x-4">
                <!-- Dropdown Filter -->
                <select id="statusFilter" class="px-8 py-2 border rounded" onchange="filterStatus()">
                    <option value="">Semua Status</option>
                    <option value="Aktif">Aktif</option>
                    <option value="Tidak Aktif">Tidak Aktif</option>
                </select>
                <button onclick="openModalPiket()" class="bg-blue-500 text-white px-4 py-2 rounded-full hover:bg-blue-700 transition duration-300 ease-in-out">
                    Create
                </button>
            </div>
        </div>
        <table id="data-table" class="w-full">
            <thead>
                <tr class="bg-gray-50">
                    <th class="p-5 text-left text-sm leading-6 font-semibold text-gray-900 capitalize">Nama Guru</th>
                    <th class="p-5 text-left text-sm leading-6 font-semibold text-gray-900 capitalize">Tahun Ajaran</th>
                    <th class="p-5 text-left text-sm leading-6 font-semibold text-gray-900 capitalize">Semester</th>
                    <th class="p-5 text-left text-sm leading-6 font-semibold text-gray-900 capitalize">Hari</th>
                    <th class="p-5 text-left text-sm leading-6 font-semibold text-gray-900 capitalize">Jam Mulai</th>
                    <th class="p-5 text-left text-sm leading-6 font-semibold text-gray-900 capitalize">Jam Selesai</th>
                    <th class="p-5 text-left text-sm leading-6 font-semibold text-gray-900 capitalize">Status</th>
                    <th class="p-5 text-left text-sm leading-6 font-semibold text-gray-900 capitalize">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-300" id="piket-table-body">
                @foreach($piket as $item)
                    <tr>
                        <td class="p-5">{{ $item->guru->nama_guru }}</td>
                        <td class="p-5">{{ $item->tahun->tahun_ajaran }}</td>
                        <td class="p-5">{{ $item->tahun->semester }}</td>
                        <td class="p-5">{{ $item->hari }}</td>
                        <td class="p-5">{{ $item->jam_mulai }}</td>
                        <td class="p-5">{{ $item->jam_selesai }}</td>
                        <td class="p-5">{{ $item->tahun->status }}</td>
                        <td class="p-5 flex space-x-2">
                            <button onclick="openEditModal({{ $item->id_piket }}, '{{ $item->guru->nip }}', '{{ $item->tahun->id_tahun }}', '{{ $item->hari }}', '{{ $item->jam_mulai }}', '{{ $item->jam_selesai }}')" class="bg-yellow-500 text-white px-2 py-1 rounded">Edit</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@if ($errors->any())
    <div id="error-message" class="bg-red-500 text-white p-3 rounded mb-4">
        @foreach ($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    </div>
@endif

@if (session('success'))
    <div id="success-message" class="bg-red-500 text-white p-3 rounded mb-4">
        {{ session('success') }}
    </div>
@endif

<!-- Modal Create -->
<div id="modal" class="fixed inset-0 bg-gray-900 bg-opacity-50 z-50 hidden flex justify-center items-center">
    <div class="bg-white rounded-lg w-1/3 p-5">
        <h2 class="text-xl font-bold mb-4">Tambah Guru Piket</h2>
        <form action="{{ route('gurupiket.createpiket') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="nip" class="block text-sm font-semibold">Nama Guru</label>
                <select name="nip" id="nip" class="w-full px-3 py-2 border rounded" required>
                    <option value="">Pilih Guru</option>
                    @foreach($gurus as $guru)
                        <option value="{{ $guru->nip }}">{{ $guru->nama_guru }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-4">
                <label for="id_tahun" class="block text-sm font-semibold">Tahun Ajaran</label>
                <select name="id_tahun" id="id_tahun" class="w-full px-3 py-2 border rounded" required>
                    <option value="">Pilih Tahun Ajaran</option>
                    @foreach($tahun as $item)
                        <option value="{{ $item->id_tahun }}">{{ $item->tahun_ajaran }} - {{ $item->semester }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-4">
                <label for="hari" class="block text-sm font-semibold">Hari</label>
                <select name="hari" id="hari" class="w-full px-3 py-2 border rounded" required>
                    <option value="">Pilih Hari</option>
                    <option value="Senin">Senin</option>
                    <option value="Selasa">Selasa</option>
                    <option value="Rabu">Rabu</option>
                    <option value="Kamis">Kamis</option>
                    <option value="Jumat">Jumat</option>
                    <option value="Sabtu">Sabtu</option>
                    <option value="Minggu">Minggu</option>
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
                <button type="button" onclick="resetAndCloseModal()" class="bg-gray-500 text-white px-4 py-2 rounded">Batal</button>
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Simpan</button>
            </div>
        </form>
    </div>
</div>

<div id="edit-modal" class="fixed inset-0 bg-gray-900 bg-opacity-50 z-50 hidden flex justify-center items-center">
    <div class="bg-white rounded-lg w-1/3 p-5">
        <h2 class="text-xl font-bold mb-4">Edit Guru Piket</h2>
        <form id="edit-form" action="" method="POST">
            @csrf
            @method('PUT') <!-- Spoofing method -->
            <input type="hidden" name="id" id="edit-id">

            <div class="mb-4">
                <label for="edit_nip" class="block text-sm font-semibold">Nama Guru</label>
                <select name="nip" id="edit_nip" class="w-full px-3 py-2 border rounded" required>
                    @foreach($gurus as $guru)
                        <option value="{{ $guru->nip }}">{{ $guru->nama_guru }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label for="edit_id_tahun" class="block text-sm font-semibold">Tahun Ajaran</label>
                <select name="id_tahun" id="edit_id_tahun" class="w-full px-3 py-2 border rounded" required>
                    @foreach($tahun as $tahun)
                        <option value="{{ $tahun->id_tahun }}">{{ $tahun->tahun_ajaran }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label for="edit_hari" class="block text-sm font-semibold">Hari</label>
                <select name="hari" id="edit_hari" class="w-full px-3 py-2 border rounded" required>
                    <option value="Senin">Senin</option>
                    <option value="Selasa">Selasa</option>
                    <option value="Rabu">Rabu</option>
                    <option value="Kamis">Kamis</option>
                    <option value="Jumat">Jumat</option>
                    <option value="Sabtu">Sabtu</option>
                </select>
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
    function filterStatus() {
    const status = document.getElementById('statusFilter').value;
    const rows = document.querySelectorAll('tbody tr');

    rows.forEach(row => {
        const statusCell = row.querySelector('td:nth-child(9)'); // Kolom Status
        if (status === '' || statusCell.textContent.trim() === status) {
            row.style.display = ''; // Tampilkan baris
        } else {
            row.style.display = 'none'; // Sembunyikan baris
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

    function openEditModal(id_piket, nip, id_tahun, hari, jam_mulai, jam_selesai) {
    document.getElementById('edit-id').value = id_piket;
    document.getElementById('edit_nip').value = nip;
    document.getElementById('edit_id_tahun').value = id_tahun;
    document.getElementById('edit_hari').value = hari;
    document.getElementById('edit_jam_mulai').value = jam_mulai;
    document.getElementById('edit_jam_selesai').value = jam_selesai;
    document.getElementById('edit-modal').classList.remove('hidden');

    document.getElementById('edit-form').action = '/admin/gurupiket/' + id_piket;

    // document.getElementById('edit-form').action = '{{ route('gurupiket.createpiket', ':id') }}'.replace(':id', id_piket);

    document.getElementById('edit-modal').classList.remove('hidden');
    }

    function openDeleteModal(id) {
        document.getElementById('delete-form').action = '/admin/gurupiket/' + id;
        document.getElementById('delete-modal').classList.remove('hidden');
    }

    function openModalPiket() {
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
    document.getElementById('nip').value = '';
    document.getElementById('id_tahun').value = '';
    document.getElementById('hari').value = '';

    // Reset input time
    document.getElementById('jam_mulai').value = '';
    document.getElementById('jam_selesai').value = '';

    // Tutup modal
    const modal = document.getElementById('modal');
    modal.classList.add('hidden');
    modal.classList.remove('flex');
    }
</script>

@endsection
