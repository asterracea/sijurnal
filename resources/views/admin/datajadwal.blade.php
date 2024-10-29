@extends('layouts.admin')

@section('title', 'SiJurnal Guru')

@section('content')

<div class="flex-grow p-5">
    <div class="bg-white shadow-md rounded-xl overflow-hidden">
        <div class="flex justify-between items-center m-4">
            <div class="relative text-black font-bold text-xl w-auto">
                <h1>Data Mapel</h1>
            </div>
            <a href="{{ route('formjadwal') }}" class="bg-blue-500 text-white px-4 py-2 rounded-full hover:bg-blue-700 transition duration-300 ease-in-out">
                Create
            </a>
        </div>
        <table class="w-full">
            <thead>
                <tr class="bg-gray-50">
                    <th class="p-5 text-left text-sm leading-6 font-semibold text-gray-900 capitalize">Tahun Ajaran</th>
                    <th class="p-5 text-left text-sm leading-6 font-semibold text-gray-900 capitalize">Kelas</th>
                    <th class="p-5 text-left text-sm leading-6 font-semibold text-gray-900 capitalize">Semester</th>
                    <th class="p-5 text-left text-sm leading-6 font-semibold text-gray-900 capitalize">Mata Pelajaran</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-300">
                @foreach($dataJadwal as $jadwal)
                    <tr>
                        <td class="p-5">{{ $jadwal->tahun_ajaran }}</td>
                        <td class="p-5">{{ $jadwal->nama_kelas }}</td>
                        <td class="p-5">{{ $jadwal->semester }}</td>
                        <td class="p-5">{{ $jadwal->nama_mapel }}</td>
                    </tr>
                @endforeach
            </tbody>

        </table>
    </div>
</div>

@endsection
