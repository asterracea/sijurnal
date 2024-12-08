@extends('layouts.guru')

@section('title', 'SiJurnal Guru')

@section('content')
<div class="flex-grow ">
    <div class="bg-white shadow-md rounded-xl overflow-hidden">
        <div class="flex justify-between items-center m-4">
            <div class="bg-gray-800 p-6 rounded-lg shadow-lg w-full">
                <div class="flex items-center gap-4 mb-4">
                    @csrf
                  <!-- Tahun Ajaran -->
                  <select id="tahunAjaran" class="w-1/4 px-4 py-2 text-sm bg-gray-700 text-white rounded-lg">
                    @foreach ($tahunAjaran as $tahun)
                        <option 
                        class="w-1/4 px-4 py-2 text-sm bg-gray-700 text-white rounded-lg focus:ring-2 focus:ring-orange-400 focus:outline-none"
                        value="{{$tahun->id}}">{{ $tahun->tahun_ajaran }} {{ $tahun->semester }}</option>
                    @endforeach
                  </select>
                  <select id="kelas" class="w-1/4 px-4 py-2 text-sm bg-gray-700 text-white rounded-lg">
                    @foreach ($kelas as $kelas)
                        <option 
                        class="w-1/4 px-4 py-2 text-sm bg-gray-700 text-white rounded-lg focus:ring-2 focus:ring-orange-400 focus:outline-none"
                        value="{{$kelas->id_kelas}}">{{ $kelas->nama_kelas }}</option>
                    @endforeach
                  </select>            
                  <!-- Mata Pelajaran -->
                  <input
                    type="text"
                    placeholder="Matematika"
                    class="w-1/4 px-4 py-2 text-sm bg-gray-700 text-white rounded-lg focus:ring-2 focus:ring-orange-400 focus:outline-none"
                    id="mataPelajaran"
                  />
                </div>
            
                <!-- Tombol Aksi -->
                <div class="flex gap-4">
                  <button
                    class="bg-orange-500 hover:bg-orange-600 text-white px-4 py-2 rounded-lg text-sm font-medium flex items-center"
                    {{-- onclick="cariData()" --}}
                  >
                    Cari Data
                  </button>
                  <button
                    class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg text-sm font-medium flex items-center"
                    id="openModal"
                    {{-- onclick="openModal()" --}}
                  >
                    Isi Jurnal Baru
                  </button>
                  <button
                    class="bg-indigo-500 hover:bg-indigo-600 text-white px-4 py-2 rounded-lg text-sm font-medium flex items-center"
                    {{-- onclick="cetak()" --}}
                  >
                    Cetak
                  </button>
                </div>
            </div>
        </div>
        {{-- <table class="w-full">
            <thead>
                @php
                   $theads = [
                                'Tanggal',
                                'Nama Guru',
                                'Kelas',
                                'Mata Pelajaran',
                                'Rencana',
                                'Realisasi',
                                'Foto'
                            ];
                 @endphp
                <tr class="bg-gray-50">
                    @foreach($theads as $thead)
                        <th class="p-5 text-left text-sm leading-6 font-semibold text-gray-900 capitalize">{{$thead}}</th>
                    @endforeach
                    
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-300">
                @foreach($jurnals as $jurnal)
                    <tr>
                        <td>{{ $jurnal->tanggal }}</td>
                        <td>{{ $jurnal->guru->nama_guru }}</td>
                        <td>{{ $jurnal->kelas->nama_kelas }}</td>
                        
                    </tr>
                @endforeach
            </tbody>
        </table> --}}
        <table class="min-w-full bg-white border border-gray-300 rounded-lg">
            <thead>
                <tr class="bg-gray-100">
                    <th class="px-4 py-2 border">Tanggal</th>
                    <th class="px-4 py-2 border">Jam Mulai</th>
                    <th class="px-4 py-2 border">Jam Selesai</th>
                    <th class="px-4 py-2 border">Rencana</th>
                    <th class="px-4 py-2 border">Realisasi</th>
                    <th class="px-4 py-2 border">Kelas</th>
                    <th class="px-4 py-2 border">Mata Pelajaran</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($jurnals as $jurnal)
                    <tr>
                        <td class="px-4 py-2 border">{{ $jurnal->tanggal }}</td>
                        <td class="px-4 py-2 border">{{ $jurnal->jam_mulai }}</td>
                        <td class="px-4 py-2 border">{{ $jurnal->jam_selesai }}</td>
                        <td class="px-4 py-2 border">{{ $jurnal->rencana }}</td>
                        <td class="px-4 py-2 border">{{ $jurnal->realisasi }}</td>
                        <td class="px-4 py-2 border">{{ $jurnal->jadwal->kelas->nama_kelas }}</td> <!-- Nama kelas dari relasi jadwal.kelas -->
                        <td class="px-4 py-2 border">{{ $jurnal->jadwal->mapel->nama_mapel }}</td> <!-- Nama mata pelajaran dari relasi jadwal.mapel -->
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <!-- Modal Pop-Up -->
    <div id="modal" class="flex fixed z-50 inset-0 items-center justify-center bg-gray-800 bg-opacity-50 hidden">
        <div class="bg-white rounded-lg p-6 w-full max-w-3xl max-h-[80vh] mx-4 overflow-auto">
            <h3 class="text-xl font-semibold mb-6 text-center">Isi Jurnal Harian Mengajar</h3>
            <form method="POST" enctype="multipart/form-data">
                @csrf
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-2">
                    <!-- Tanggal -->
                    
                    <div class="mb-2">
                        <label for="tanggal" class="text-sm font-medium text-gray-700">Tanggal</label>
                        <input type="date" id="tanggal" name="tanggal" class="w-full p-2 border rounded-lg mt-1" required>
                    </div>
                    <div class="mb-2">
                        <label for="jam_mulai" class="text-sm font-medium text-gray-700">Jam mulai</label>
                        <input type="text" id="jam_mulai" name="jam_mulai" class="w-full p-2 border rounded-lg mt-1" required>
                    </div>
                    <div class="mb-2">
                        <label for="jam_selesai" class="text-sm font-medium text-gray-700">Jam Selesai</label>
                        <input type="text" id="jam_selesai" name="jam_selesai" class="w-full p-2 border rounded-lg mt-1" required>
                    </div>

                    <!-- Rencana -->
                    <div class="mb-2">
                        <label for="rencana" class="text-sm font-medium text-gray-700">Rencana</label>
                        <textarea id="rencana" name="rencana" class="w-full p-2 border rounded-lg mt-1" required></textarea>
                    </div>
    
                    <!-- Realisasi -->
                    <div class="mb-2">
                        <label for="realisasi" class="text-sm font-medium text-gray-700">Realisasi</label>
                        <textarea id="realisasi" name="realisasi" class="w-full p-2 border rounded-lg mt-1" required></textarea>
                    </div>
    
                    <!-- Foto -->
                    <div class="mb-4">
                        <label for="foto" class="text-sm font-medium text-gray-700">Foto Kegiatan <span class="text-red-500">*</span></label>
                        <div class="relative mt-1">
                            <input type="file" id="foto" name="foto" class="hidden" accept=".jpg, .jpeg, .png, .heic" onchange="validateFile()">
                            <label for="foto" class="block w-full p-4 border-2 border-dashed border-gray-300 rounded-lg text-center text-gray-600 hover:border-gray-400 cursor-pointer">
                                <span class="block">Masukkan Foto Max 1 MB</span>
                                <span id="file-name" class="text-gray-500"></span>
                            </label>
                            <div id="error-message" class="text-red-500 mt-2 hidden">Ukuran file maksimal 1 MB!</div>
                        </div>
                    </div>
                    <div class="mt-4">
                        <img id="preview-image" class="hidden w-32 h-32 object-cover rounded-md" alt="Preview Foto">
                    </div>
                </div>

    
                <!-- Tombol Submit -->
                <div class="flex justify-end mt-6">
                    <button type="submit" class="px-5 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600">
                        Simpan
                    </button>
                </div>
            </form>
    
            <!-- Tombol Tutup Modal -->
            <button id="closeModal" class="absolute top-2 right-2 text-gray-500 hover:text-gray-700">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div>
    </div>
    

</div>
<script>
    // Mengatur nilai input tanggal ke hari ini dan menampilkan dalam span
    const tanggalInput = document.getElementById('tanggal');

    // Menentukan tanggal saat ini dalam format YYYY-MM-DD
    const today = new Date();
    const year = today.getFullYear();
    const month = String(today.getMonth() + 1).padStart(2, '0'); // Menambahkan leading zero jika bulan < 10
    const day = String(today.getDate()).padStart(2, '0'); // Menambahkan leading zero jika hari < 10

    // Format tanggal dalam bentuk YYYY-MM-DD
    const formattedDate = `${year}-${month}-${day}`;

    // Ambil elemen modal dan tombol
    const modal = document.getElementById('modal');
    const openModalButton = document.getElementById('openModal');
    const closeModalButton = document.getElementById('closeModal');

    // Fungsi untuk membuka modal
    openModalButton.addEventListener('click', () => {
        modal.classList.remove('hidden');
    });

    // Fungsi untuk menutup modal
    closeModalButton.addEventListener('click', () => {
        modal.classList.add('hidden');
    });

    // Klik di luar modal untuk menutupnya
    window.addEventListener('click', (e) => {
        if (e.target === modal) {
            modal.classList.add('hidden');
        }
    });
    // Fungsi untuk memvalidasi ukuran file
    function validateFile() {
    const fileInput = document.getElementById('foto');
    const fileName = document.getElementById('file-name');
    const errorMessage = document.getElementById('error-message');
    const previewImage = document.getElementById('preview-image');

    const file = fileInput.files[0];
    const maxSize = 1 * 1024 * 1024; // 1 MB dalam byte

    if (file) {
        // Tampilkan nama file
        fileName.textContent = file.name;

        // Cek apakah ukuran file melebihi batas maksimal
        if (file.size > maxSize) {
            errorMessage.classList.remove('hidden'); // Tampilkan pesan error
            fileInput.value = ''; // Hapus file yang dipilih
            fileName.textContent = ''; // Hapus nama file yang ditampilkan
            previewImage.src = ''; // Kosongkan gambar pratinjau
            previewImage.classList.add('hidden'); // Sembunyikan gambar pratinjau
        } else {
            errorMessage.classList.add('hidden'); // Sembunyikan pesan error jika ukuran file sesuai

            // Tampilkan pratinjau gambar
            const reader = new FileReader();
            reader.onload = function (e) {
                previewImage.src = e.target.result;
                previewImage.classList.remove('hidden'); // Tampilkan gambar pratinjau
            };
            reader.readAsDataURL(file);
        }
    }
}

</script>
@endsection


