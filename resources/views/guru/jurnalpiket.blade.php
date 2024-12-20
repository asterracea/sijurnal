@extends('layouts.guru')

@section('title', 'SiJurnal Guru')

@section('content')
<div class="flex-grow">
    <div class="bg-white shadow-md rounded-xl overflow-hidden">

        @if ($piket)
        <div class="bg-white p-5 rounded-lg shadow mb-5">
            <p class="text-green-700 font-bold">
                Anda sedang piket hari ini ({{ $today }}), dari jam {{ $piket->jam_mulai }} sampai {{ $piket->jam_selesai }}.
            </p>

            @if ($jumlahPending > 0)
                <h3 class="text-lg font-bold text-gray-700 mt-4">Silakan lengkapi jurnal berikut:</h3>
                <div class="overflow-x-auto mt-3">
                    <table class="min-w-full mt-3 bg-white border border-gray-300 rounded-lg">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="px-4 py-2 border">Tanggal</th>
                                <th class="px-4 py-2 border">Jam Mulai</th>
                                <th class="px-4 py-2 border">Jam Selesai</th>
                                <th class="px-4 py-2 border">Kelas</th>
                                <th class="px-4 py-2 border">Mata Pelajaran</th>
                                <th class="px-4 py-2 border">Status</th>
                                <th class="px-4 py-2 border">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($jurnals as $jurnal)
                                <tr>
                                    <td class="px-4 py-2 border">{{ $jurnal->tanggal }}</td>
                                    <td class="px-4 py-2 border">{{ $jurnal->jam_mulai }}</td>
                                    <td class="px-4 py-2 border">{{ $jurnal->jam_selesai }}</td>
                                    <td class="px-4 py-2 border">{{ $jurnal->jadwal->kelas->nama_kelas ?? 'Tidak tersedia' }}</td>
                                    <td class="px-4 py-2 border">{{ $jurnal->jadwal->mapel->nama_mapel ?? 'Tidak tersedia' }}</td>
                                    <td class="px-4 py-2 border">
                                        <span class="px-2 py-1 rounded {{ $jurnal->status === 'pending' ? 'bg-yellow-500' : 'bg-green-500' }}">
                                            {{ ucfirst($jurnal->status) }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-2 border text-center">
                                        <button
                                        class="text-blue-500 edit-button"
                                        onclick="openEditPiketModal('{{ $jurnal->id_jurnal }}', '{{ $jurnal->jadwal->hari }}','{{ $jurnal->tanggal }}','{{ $jurnal->jadwal->kelas->nama_kelas }}', '{{ $jurnal->jadwal->mapel->nama_mapel }}','{{ $jurnal->jam_mulai }}', '{{ $jurnal->jam_selesai }}', '{{ $jurnal->status }}', '{{ $jurnal->piket->nip ?? '' }}')">
                                        Edit
                                    </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center py-2">Tidak ada jurnal dengan status pending.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
        @else
        <div class="bg-white p-5 rounded-lg shadow">
            <p class="text-red-700 font-bold">
                Anda tidak sedang piket hari ini ({{ $today }}).
            </p>
        </div>
        @endif
    </div>

    <!-- Modal untuk Edit Jurnal -->
    <div id="editModal" class="flex fixed z-50 inset-0 items-center justify-center bg-gray-800 bg-opacity-50 hidden">
        <div class="bg-white rounded-lg p-6 w-full max-w-3xl max-h-[80vh] mx-4 overflow-auto">
            <h3 class="text-xl font-semibold mb-6 text-center">Edit Jurnal Harian Mengajar</h3>

            <form method="POST" id="edit-formjurnal" action="{{ isset($jurnal) ? route('guru.updatejurnalpiket', $jurnal->id_jurnal) : '#' }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-2">
                    <input type="hidden" name="id_edit" id="edit_id">
                    <!-- Hari -->
                    <div class="mb-2">
                        <label for="hari" class="text-sm font-medium text-gray-700">Hari</label>
                        <input type="text" id="edit_hari" name="hari" class="w-full p-2 border rounded-lg mt-1 bg-gray-100" readonly>
                    </div>

                    <!-- Tanggal -->
                    <div class="mb-2">
                        <label for="tanggal" class="text-sm font-medium text-gray-700">Tanggal</label>
                        <input type="date" id="edit_tanggal" name="tanggal" class="w-full p-2 border rounded-lg mt-1 bg-gray-100" readonly>
                    </div>

                    <!-- Nama Kelas -->
                    <div class="mb-4">
                        <label for="nama_kelas" class="text-sm font-medium text-gray-700">Nama Kelas</label>
                        <input type="text" id="edit_nama_kelas" name="nama_kelas" class="w-full p-2 border rounded-lg mt-1 bg-gray-100" readonly>
                    </div>

                    <!-- Mata Pelajaran -->
                    <div class="mb-2">
                        <label for="mapel" class="text-sm font-medium text-gray-700">Mata Pelajaran</label>
                        <input type="text" id="edit_mapel" name="mapel" class="w-full p-2 border rounded-lg mt-1 bg-gray-100" readonly>
                    </div>

                    <!-- Jam Mulai -->
                    <div class="mb-4">
                        <label for="jam_mulai" class="block text-sm font-medium text-gray-700">Jam Mulai</label>
                        <input type="time" id="edit_jam_mulai" name="jam_mulai" class="w-full px-3 py-2 border rounded bg-gray-100" readonly>
                    </div>

                    <!-- Jam Selesai -->
                    <div class="mb-4">
                        <label for="jam_selesai" class="block text-sm font-medium text-gray-700">Jam Selesai</label>
                        <input type="time" id="edit_jam_selesai" name="jam_selesai" class="w-full px-3 py-2 border rounded bg-gray-100" readonly>
                    </div>

                    <div class="mb-2">
                        <label for="status" class="text-sm font-medium text-gray-700">Status</label>
                        <select id="edit_status" name="status" class="w-full p-2 border rounded-lg mt-1 bg-white">
                            <option value="pending">Pending</option>
                            <option value="succes">Success</option>
                        </select>
                    </div>

                    <div class="mb-2">
                        <label for="edit_nip" class="text-sm font-medium text-gray-700">Guru Piket</label>
                        <input type="text" id="edit_nip" name="nip" class="w-full p-2 border rounded-lg mt-1 bg-gray-100" value="{{ Auth::user()->nip }}">
                    </div>

                </div>

                <!-- Tombol Aksi -->
                <div class="flex justify-end mt-6">
                    <button type="button" id="closeEditModal" class="px-5 py-2 bg-gray-300 text-gray-800 rounded-lg hover:bg-gray-400 mr-2">Batal</button>
                    <button type="submit" class="px-5 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600">Simpan</button>
                </div>
            </form>
        </div>
    </div>

</div>

<script>
    function openEditPiketModal(id_jurnal, hari, tanggal, nama_kelas, mapel, jam_mulai, jam_selesai, status, nip) {
    // Set nilai input modal dengan data yang dipilih
    document.getElementById('edit_id').value = id_jurnal;
    document.getElementById('edit_hari').value = hari;
    document.getElementById('edit_tanggal').value = tanggal;
    document.getElementById('edit_nama_kelas').value = nama_kelas;
    document.getElementById('edit_mapel').value = mapel;
    document.getElementById('edit_jam_mulai').value = jam_mulai;
    document.getElementById('edit_jam_selesai').value = jam_selesai;
    document.getElementById('edit_status').value = status;

    // Cek keberadaan nip sebelum menyimpan ke modal
    if (nip) {
        document.getElementById('edit_nip').value = nip;
    } else {
        document.getElementById('edit_nip').value = ''; // Set nilai kosong jika tidak ada nip
    }

    // Tampilkan modal
    document.getElementById('editModal').classList.remove('hidden');
}

    // Fungsi untuk menutup modal
    document.getElementById('closeEditModal').addEventListener('click', function() {
        document.getElementById('editModal').classList.add('hidden');
    });
</script>
@endsection
