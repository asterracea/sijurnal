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
            <button onclick="openModal('createModal')" class="bg-blue-500 text-white px-4 py-2 rounded-full hover:bg-blue-700">
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
                                @if ($user->status === 'Aktif')
                                    <span class="bg-blue-500 text-white px-3 py-1 rounded-full">Aktif</span>
                                @else
                                    <span class="bg-red-500 text-white px-3 py-1 rounded-full">Tidak Aktif</span>
                                @endif
                            </td>
                            <td class="p-5 flex space-x-4">
                                <button
                                    onclick="openEditModal('{{ $user->id_user }}', '{{ $user->nip }}','{{ $user->email }}','{{ $user->password }}','{{ $user->role }}', '{{ $user->status }}')"
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
        <form action="{{ route('admin.createdatauser') }}" method="POST">
            @csrf

            <div class="grid grid-cols-2 gap-4"> <!-- Two-column grid -->

                <!-- NIP Dropdown -->
                <div class="mb-4">
                    <label for="nip" class="block text-gray-700">NIP</label>
                    <select name="nip" id="nip" class="w-full p-2 border border-gray-300 rounded @error('nip') border-red-500 @enderror" required>
                        <option value="">Select NIP</option>
                        @foreach ($availableNips as $nip)
                            <option value="{{ $nip }}" {{ old('nip') == $nip ? 'selected' : '' }}>{{ $nip }}</option>
                        @endforeach
                    </select>
                    @error('nip')
                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Email -->
                <div class="mb-4">
                    <label for="email" class="block text-gray-700">Email</label>
                    <input type="email" name="email" id="email" class="w-full p-2 border border-gray-300 rounded" required>
                </div>

                <!-- Role -->
                <div class="mb-4">
                    <label for="role" class="block text-gray-700">Role</label>
                    <select name="role" id="role" class="w-full p-2 border border-gray-300 rounded" required>
                        <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                        <option value="guru" {{ old('role') == 'guru' ? 'selected' : '' }}>Guru</option>
                    </select>
                </div>

                <!-- Status -->
                <div class="mb-4">
                    <label for="status" class="block text-gray-700">Status</label>
                    <select name="status" id="status" class="w-full p-2 border border-gray-300 rounded" required>
                        <option value="Aktif" {{ old('status') == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                        <option value="NonAktif" {{ old('status') == 'NonAktif' ? 'selected' : '' }}>Tidak Aktif</option>
                    </select>
                </div>

                <!-- Password -->
                <div class="mb-4">
                    <label for="password" class="block text-gray-700">Password</label>
                    <input type="password" name="password" id="password" class="w-full p-2 border border-gray-300 rounded @error('password') border-red-500 @enderror" required>
                    @error('password')
                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Confirm Password -->
                <div class="mb-4">
                    <label for="password_confirmation" class="block text-gray-700">Confirm Password</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" class="w-full p-2 border border-gray-300 rounded @error('password_confirmation') border-red-500 @enderror" required>
                    @error('password_confirmation')
                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>

            </div>

            <!-- Buttons -->
            <div class="flex justify-end space-x-2 mt-4">
                <button type="button" onclick="closeCreateModal()" class="bg-gray-500 text-white px-4 py-2 rounded">Cancel</button>
                <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">Create User</button>
            </div>
        </form>
    </div>
</div>



<!-- Modal Edit Data Guru -->
<div id="editModal" class="fixed inset-0 bg-gray-900 bg-opacity-50 hidden z-50 flex justify-center items-center">
    <div class="bg-white p-6 rounded-lg shadow-lg w-11/12 sm:w-2/3 md:w-1/2 lg:w-1/3">
        <h2 class="text-lg md:text-xl font-semibold mb-4">Edit Data Guru</h2>

        <form id="editForm" action="{{ route('admin.updatedatauser', $user->id_user) }}" method="POST">
            @csrf
            @method('PUT')
            <input type="hidden" name="id_edit" id="edit_id_user" value="{{ $user->id_user }}">
            <!-- NIP -->
            <div class="mb-4">
                <label for="nip" class="block text-sm font-medium text-gray-700">NIP</label>
                <input type="text" name="nip" id="editNip" value="{{ old('nip', $user->nip) }}" required
                    class="w-full px-3 py-2 border rounded-lg text-gray-800 focus:outline-none focus:ring focus:ring-blue-300" readonly>
            </div>
            <!-- Email -->
            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" name="email" id="editEmail" required
                    value="{{ old('email', $user->email) }}"
                    class="w-full px-3 py-2 border rounded-lg text-gray-800 focus:outline-none focus:ring focus:ring-blue-300">
            </div>
            {{-- <div class="mb-4">
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                <input type="password" placeholder="Isi jika ingin mengganti password" name="password" id="password"
                       class="w-full px-3 py-2 border rounded-lg text-gray-800">
            </div> --}}

            <!-- Role -->
            <div class="mb-4">
                <label for="role" class="block text-gray-700">Role</label>
                <select name="role" id="editRole" class="w-full p-2 border border-gray-300 rounded" required>
                    @foreach($roles as $role)
                        <option value="{{ $role->name ?? $role }}" {{ old('role', $user->role) == ($role->name ?? $role) ? 'selected' : '' }}>
                            {{ ucfirst($role->name ?? $role) }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Status -->
            <div class="mb-4">
                <label for="status" class="block text-gray-700">Status</label>
                <select name="status" id="editStatus" class="w-full p-2 border border-gray-300 rounded" required>
                    @foreach($statuses as $status)
                        <option value="{{ $status->name ?? $status }}" {{ old('status', $user->status) == ($status->name ?? $status) ? 'selected' : '' }}>
                            {{ ucfirst($status->name ?? $status) }}
                        </option>
                    @endforeach
                </select>
            </div>


            <!-- Actions -->
            <div class="flex justify-end space-x-4">
                <button type="button" onclick="closeEditModal()"
                    class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                    Tutup
                </button>
                <button type="submit"
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>


<script>
    // Function to open the edit modal and populate the form with current user data
    function openEditModal(id_user, nip, email, password,role, status) {
        document.getElementById('editModal').classList.remove('hidden');
        document.getElementById('editNip').value = nip;
        document.getElementById('editEmail').value = email;
        document.getElementById('password').value = password;
        document.getElementById('editRole').value = role;
        document.getElementById('editStatus').value = status;

        // Update form action with correct nip
        // document.getElementById('editForm').action = '{{ route('admin.updatedatauser', ':id_user') }}'.replace(':id_user', id_user);
        //document.getElementById('editForm').action = "/admin/users/" + id_user;
    }

    // Function to close the edit modal
    function closeEditModal() {
        document.getElementById('editModal').classList.add('hidden');
    }
    function openModal() {
        document.getElementById('createModal').classList.remove('hidden');
    }

    function closeCreateModal() {
        document.getElementById('createModal').classList.add('hidden');
    }
</script>

@endsection
