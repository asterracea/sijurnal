@extends('layouts.guru')

@section('title', 'SiJurnal Guru')

@section('content')
<div class="flex-grow ">
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
    onclick="openEditPiketModal('{{ $jurnal->id_jurnal }}', '{{ $jurnal->jadwal->hari }}','{{ $jurnal->tanggal }}','{{ $jurnal->jadwal->mapel->nama_mapel }}','{{ $jurnal->jam_mulai }}', '{{ $jurnal->jam_selesai }}', '{{ $jurnal->rencana }}', '{{ $jurnal->realisasi }}',  '{{ asset('storage/' . $jurnal->foto) }}')">
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
    <div id="editModal" class="flex fixed z-50 inset-0 items-center justify-center bg-gray-800 bg-opacity-50 hidden">
        <div class="bg-white rounded-lg p-6 w-full max-w-3xl max-h-[80vh] mx-4 overflow-auto">
            <h3 class="text-xl font-semibold mb-6 text-center">Edit Jurnal Harian Mengajar</h3>

            <form method="POST" id="edit-formjurnal" action="{{ route('guru.updatejurnalpiket', $jurnal->id_jurnal) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-2">
                    <input type="hidden" name="id_edit" id="edit_id_jurnal">
                    <!-- Hari -->
                    <div class="mb-2">
                        <label for="hari" class="text-sm font-medium text-gray-700">Hari</label>
                        <input type="text" id="edit_hari" name="hari" value="{{ $jurnal->hari }}" class="w-full p-2 border rounded-lg mt-1 bg-gray-100" readonly>
                    </div>

                    <!-- Tanggal -->
                    <div class="mb-2">
                        <label for="tanggal" class="text-sm font-medium text-gray-700">Tanggal</label>
                        <input type="date" id="edit_tanggal" name="tanggal" value="{{ $jurnal->tanggal }}" class="w-full p-2 border rounded-lg mt-1 bg-gray-100" readonly>
                    </div>

                    <!-- Mata Pelajaran -->
                    <div class="mb-2">
                        <label for="mapel" class="text-sm font-medium text-gray-700">Mata Pelajaran</label>
                        <input type="text" id="edit_mapel" name="mapel" value="{{ $jurnal->jadwal->mapel->nama_mapel }}" class="w-full p-2 border rounded-lg mt-1 bg-gray-100" readonly>
                    </div>

                    <!-- Jam Mulai -->
                    <div class="mb-4">
                        <label for="jam_mulai" class="block text-sm font-medium text-gray-700">Jam Mulai</label>
                        <input type="time" id="edit_jam_mulai" name="jam_mulai" value="{{ $jurnal->jadwal->jam_mulai }}" class="w-full px-3 py-2 border rounded bg-gray-100" readonly>
                    </div>

                    <!-- Jam Selesai -->
                    <div class="mb-4">
                        <label for="jam_selesai" class="block text-sm font-medium text-gray-700">Jam Selesai</label>
                        <input type="time" id="edit_jam_selesai" name="jam_selesai" value="{{ $jurnal->jadwal->jam_selesai }}" class="w-full px-3 py-2 border rounded bg-gray-100" readonly>
                    </div>

                    <!-- Rencana -->
                    <div class="mb-2">
                        <label for="rencana" class="text-sm font-medium text-gray-700">Rencana</label>
                        <textarea id="edit_rencana" name="rencana" class="w-full p-2 border rounded-lg mt-1" required>{{ $jurnal->rencana }}</textarea>
                    </div>

                    <!-- Realisasi -->
                    <div class="mb-2">
                        <label for="realisasi" class="text-sm font-medium text-gray-700">Realisasi</label>
                        <textarea id="edit_realisasi" name="realisasi" class="w-full p-2 border rounded-lg mt-1" required>{{ $jurnal->realisasi }}</textarea>
                    </div>

                    <!-- Foto Kegiatan -->
                    <div class="mb-4">
                        <label for="foto" class="text-sm font-medium text-gray-700">Foto Kegiatan</label>
                        <div class="relative mt-1">
                            <img id="edit_foto" src='' alt="" class="w-32 h-32 object-cover rounded-md">
                        </div>
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
    function openEditPiketModal(id_jurnal, hari, tanggal, nama_mapel, jam_mulai, jam_selesai, rencana, realisasi, foto) {
    // Isi elemen form dengan data yang diterima
    document.getElementById('edit_id_jurnal').value = id_jurnal;
    document.getElementById('edit_hari').value = hari;
    document.getElementById('edit_tanggal').value = tanggal;
    document.getElementById('edit_mapel').value = nama_mapel;
    document.getElementById('edit_jam_mulai').value = jam_mulai;
    document.getElementById('edit_jam_selesai').value = jam_selesai;
    document.getElementById('edit_rencana').value = rencana;
    document.getElementById('edit_realisasi').value = realisasi;

    // Menampilkan foto yang diupload
    const fotoElement = document.getElementById('edit_foto');
    if (fotoElement) {
        fotoElement.src = foto ? foto : ''; // Mengatur sumber gambar jika ada
    }

    // Menampilkan modal dengan menghapus kelas 'hidden'
    document.getElementById('editModal').classList.remove('hidden');
}

</script>
@endsection


