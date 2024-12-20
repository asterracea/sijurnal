@extends('layouts.admin')

@section('title', 'SiJurnal Guru')

@section('content')
<div class="flex-grow p-5">
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="bg-white shadow-md rounded-xl overflow-hidden">
        <div class="flex justify-between items-center m-4">
            <h1 class="font-bold text-xl">Daftar Data User</h1>
            <button onclick="openCreateModal()" class="bg-blue-500 text-white px-4 py-2 rounded-full hover:bg-blue-700">
                Create
            </button>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full border-collapse bg-white text-left text-sm">
                <thead>
                    <tr class="bg-gray-50">
                        <th class="p-5 text-left font-semibold text-sm">NIP</th>
                        <th class="p-5 text-left font-semibold text-sm">Email</th>
                        <th class="p-5 text-left font-semibold text-sm">Role</th>
                        <th class="p-5 text-left font-semibold text-sm">Status</th>
                        <th class="p-5 text-left font-semibold text-sm">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                        <tr class="hover:bg-gray-50 border-t">
                            <td class="p-5">{{ $user->nip }}</td>
                            <td class="p-5">{{ $user->email }}</td>
                            <td class="p-5">{{ $user->role }}</td>
                            <td class="p-5">
                                <span class="{{ $user->status === 'Aktif' ? 'bg-blue-500' : 'bg-red-500' }} text-white px-3 py-1 rounded-full">
                                    {{ $user->status }}
                                </span>
                            </td>
                            <td class="p-5 flex space-x-4">
                                <button
                                    onclick="openEditModal('{{ $user->id_user }}', '{{ $user->nip }}', '{{ $user->email }}', '{{ $user->role }}', '{{ $user->status }}')"
                                    class="text-blue-500 hover:text-blue-700">
                                    <i class="fa fa-pencil" aria-hidden="true"></i>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Create -->
<div id="createModal" class="fixed inset-0 bg-gray-900 bg-opacity-50 hidden z-50 flex justify-center items-center">
    <div class="bg-white p-6 rounded-lg w-1/2">
        <h2 class="text-xl font-bold mb-4">Buat Data User</h2>
        <form action="{{ route('admin.createdatauser') }}" method="POST" id="createForm">
            @csrf
            <div class="grid grid-cols-2 gap-4">
                <div class="mb-4">
                    <label for="nip" class="block text-gray-700">NIP</label>
                    <select name="nip" id="nip" class="w-full p-2 border border-gray-300 rounded" required>
                        <option value="">Select NIP</option>
                        @foreach ($availableNips as $nip)
                            <option value="{{ $nip }}">{{ $nip }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-4">
                    <label for="email" class="block text-gray-700">Email</label>
                    <input type="email" name="email" id="email" class="w-full p-2 border border-gray-300 rounded" required>
                </div>
                <div class="mb-4">
                    <label for="role" class="block text-gray-700">Role</label>
                    <select name="role" id="role" class="w-full p-2 border border-gray-300 rounded" required>
                        <option value="admin">Admin</option>
                        <option value="guru">Guru</option>
                    </select>
                </div>
                <div class="mb-4">
                    <label for="status" class="block text-gray-700">Status</label>
                    <select name="status" id="status" class="w-full p-2 border border-gray-300 rounded" required>
                        <option value="Aktif">Aktif</option>
                        <option value="NonAktif">Tidak Aktif</option>
                    </select>
                </div>
                <div class="mb-4">
                    <label for="password" class="block text-gray-700">Password</label>
                    <input type="password" name="password" id="password" class="w-full p-2 border border-gray-300 rounded" required minlength="8">
                </div>
                <div class="mb-4">
                    <label for="password_confirmation" class="block text-gray-700">Confirm Password</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" class="w-full p-2 border border-gray-300 rounded" required>
                </div>
            </div>
            <div class="flex justify-end space-x-2 mt-4">
                <button type="button" onclick="closeCreateModal()" class="bg-gray-500 text-white px-4 py-2 rounded">Cancel</button>
                <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">Create User</button>
            </div>
        </form>
    </div>
</div>

<!-- Modal Edit -->
<div id="editModal" class="fixed inset-0 bg-gray-900 bg-opacity-50 hidden z-50 flex justify-center items-center">
    <div class="bg-white p-6 rounded-lg w-1/2">
        <h2 class="text-xl font-bold mb-4">Edit Data User</h2>
        <form id="editForm" method="POST" action="">
            @csrf
            @method('PUT')
            <input type="hidden" name="id_user" id="edit_id_user">
            <div class="grid grid-cols-2 gap-4">
                <div class="mb-4">
                    <label for="editNip" class="block text-gray-700">NIP</label>
                    <input type="text" id="editNip" name="nip" class="w-full p-2 border border-gray-300 rounded" required>
                </div>
                <div class="mb-4">
                    <label for="editEmail" class="block text-gray-700">Email</label>
                    <input type="email" id="editEmail" name="email" class="w-full p-2 border border-gray-300 rounded" required>
                </div>
                <div class="mb-4">
                    <label for="editRole" class="block text-gray-700">Role</label>
                    <select id="editRole" name="role" class="w-full p-2 border border-gray-300 rounded" required>
                        <option value="admin">Admin</option>
                        <option value="guru">Guru</option>
                    </select>
                </div>
                <div class="mb-4">
                    <label for="editStatus" class="block text-gray-700">Status</label>
                    <select id="editStatus" name="status" class="w-full p-2 border border-gray-300 rounded" required>
                        <option value="Aktif">Aktif</option>
                        <option value="NonAktif">Tidak Aktif</option>
                    </select>
                </div>
            </div>
            <div class="flex justify-end space-x-4 mt-4">
                <button type="button" onclick="closeEditModal()" class="bg-gray-500 text-white px-4 py-2 rounded">Cancel</button>
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Save Changes</button>
            </div>
        </form>
    </div>
</div>

<script>
    // Fungsi untuk membuka modal Create
    function openCreateModal() {
        document.getElementById('createModal').classList.remove('hidden');
    }

    // Fungsi untuk menutup modal Create
    function closeCreateModal() {
        document.getElementById('createModal').classList.add('hidden');
    }

    // Fungsi untuk membuka modal Edit
    function openEditModal(id_user, nip, email, role, status) {
        // Tampilkan modal edit
        document.getElementById('editModal').classList.remove('hidden');

        // Isi data dari parameter ke dalam field modal
        document.getElementById('edit_id_user').value = id_user;
        document.getElementById('editNip').value = nip;
        document.getElementById('editEmail').value = email;
        document.getElementById('editRole').value = role;
        document.getElementById('editStatus').value = status;

        // Update URL action pada form
        const editForm = document.getElementById('editForm');
        editForm.action = `{{ url('admin/datauser') }}/${id_user}`;
    }

    // Fungsi untuk menutup modal Edit
    function closeEditModal() {
        document.getElementById('editModal').classList.add('hidden');
    }
</script>
@endsection
