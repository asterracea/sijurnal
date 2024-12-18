@extends('layouts.admin')

@section('title', 'SiJurnal Guru')

@section('content')

<div class="flex-grow p-5">
    <div class="bg-white shadow-md rounded-xl overflow-hidden">
        <div class="flex justify-between items-center m-4">
            <div class="relative text-black font-bold text-xl w-auto">
                <h1>Jadwal Pelajaran Kelas 10</h1>
            </div>
            <div class="flex items-center space-x-4">
                <!-- Dropdown Filter untuk Kelas -->
                <select id="filterKelas" onchange="filterData()" class="border border-gray-300 rounded px-8 py-2">
                    <option value="all">Semua Kelas</option>
                    <!-- Loop untuk menampilkan kelas secara dinamis -->
                    @foreach($jadwal->pluck('kelas.nama_kelas')->unique() as $kelas)
                        <option value="{{ $kelas }}">{{ $kelas }}</option>
                    @endforeach
                </select>

                <!-- Dropdown Filter untuk Status -->
                <select id="filterStatus" onchange="filterData()" class="border border-gray-300 rounded px-8 py-2">
                    <option value="all">Semua Status</option>
                    <option value="Aktif">Aktif</option>
                    <option value="Non-Aktif">Tidak Aktif</option>
                </select>
            </div>
        </div>

        <table id="data-table" class="w-full">
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
                    <th class="p-5 text-left text-sm leading-6 font-semibold text-gray-900 capitalize">Status</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-300" id="kelas-table-body">
                @foreach($jadwal as $item)
                <tr data-nama-kelas="{{ $item->kelas->nama_kelas }}" data-status="{{ $item->tahun->status }}">
                        <td class="p-5">{{ $item->guru->nama_guru }}</td>
                        <td class="p-5">{{ $item->tahun->tahun_ajaran }}</td>
                        <td class="p-5">{{ $item->tahun->semester }}</td>
                        <td class="p-5">{{ $item->kelas->nama_kelas }}</td>
                        <td class="p-5">{{ $item->mapel->nama_mapel }}</td>
                        <td class="p-5">{{ $item->hari }}</td>
                        <td class="p-5">{{ $item->jam_mulai }}</td>
                        <td class="p-5">{{ $item->jam_selesai }}</td>
                        <td class="p-5">{{ $item->tahun->status }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>
</div>

<script>
    function filterData() {
        const filterKelas = document.getElementById('filterKelas').value; // Ambil nilai filter kelas
        const filterStatus = document.getElementById('filterStatus').value; // Ambil nilai filter status
        const rows = document.querySelectorAll('#kelas-table-body tr'); // Ambil semua baris tabel

        rows.forEach(row => {
            const namaKelas = row.getAttribute('data-nama-kelas'); // Ambil atribut data-nama-kelas
            const status = row.getAttribute('data-status'); // Ambil atribut data-status

            // Filter berdasarkan kelas dan status
            if ((filterKelas === 'all' || namaKelas === filterKelas) &&
                (filterStatus === 'all' || status === filterStatus)) {
                row.style.display = ''; // Tampilkan baris jika sesuai filter
            } else {
                row.style.display = 'none'; // Sembunyikan baris yang tidak sesuai filter
            }
        });
    }
</script>

@endsection
