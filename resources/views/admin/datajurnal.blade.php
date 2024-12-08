@extends('layouts.admin')

@section('title', 'SiJurnal Guru')

@section('content')
<div class="flex-grow p-5">
    <div class="bg-white shadow-md rounded-xl overflow-hidden">
        <div class="flex justify-between items-center m-4">
            <div class="relative text-black font-bold text-xl w-auto">
                <h1>Jurnal Guru</h1>
            </div>
            
        </div>
        <table class="w-full">
            <thead>
                <tr class="bg-gray-50">
                    <th class="p-5 text-left text-sm leading-6 font-semibold text-gray-900 capitalize">Tanggal</th>
                    <th class="p-5 text-left text-sm leading-6 font-semibold text-gray-900 capitalize">Nama Guru</th>
                    <th class="p-5 text-left text-sm leading-6 font-semibold text-gray-900 capitalize">Kelas</th>
                    <th class="p-5 text-left text-sm leading-6 font-semibold text-gray-900 capitalize">Mata Pelajaran</th>
                    <th class="p-5 text-left text-sm leading-6 font-semibold text-gray-900 capitalize">Capaian Pembelajaran</th>
                    <th class="p-5 text-left text-sm leading-6 font-semibold text-gray-900 capitalize">Materi</th>
                    <th class="p-5 text-left text-sm leading-6 font-semibold text-gray-900 capitalize">Tugas</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-300">
                
            </tbody>
        </table>
    </div>
</div>
@endsection
