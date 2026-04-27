@extends('layout.master')
@section('judul')
    Technology Development | Pusat Password
@endsection
@section('content')
    <h3 class=" text-3xl font-semibold mb-4 text-white"><i class="bi bi-lock-fill" style="margin-right: 10px;"></i>PUSAT
        PASSWORD</h3>
    <hr class=" border-t border-white/50">
    <button onclick="openModal('modalTambah')"
        class="text-white px-2.5 py-1.5 bg-[#146841] mt-5 rounded-md hover:cursor-pointer hover:bg-[#146c43] transition duration-200">
        Tambah Akun </button>
    {{-- Konten --}}
    <div class="bg-[#146841] rounded-2xl py-4 md:p-6 lg:py-6 px-4 lg:px-10 mt-6 mb-12">
        <div class="inline-flex justify-between w-full bg-gray-500 px-4 py-2 rounded-t-xl">
            <div class="text-white">
                Pusat Password
            </div>
            @include('layout._search')
        </div>
        @if ($search)
            <div class="mt-3 text-white" style="width: 97%;">
                Menampilkan hasil pencarian untuk: <strong>"{{ $search }}"</strong>
                ({{ $users->total() }} hasil ditemukan)
            </div>
        @endif
        <div class="overflow-x-auto mt-3 rounded-b-xl shadow-lg">
            <table id="dataTable" class="min-w-full text-sm text-left text-gray-300">
                <thead class="text-sm uppercase bg-black text-white">
                    <tr>
                        <th class="px-6 py-4">No Anggota</th>
                        <th class="px-6 py-4">Nama</th>
                        <th class="px-6 py-4">Username</th>
                        <th class="px-6 py-4">Type</th>
                        <th class="px-6 py-4">Role</th>
                        <th class="px-6 py-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr
                            class="border-b border-gray-700 odd:bg-[#212529] even:bg-[#181b1e] hover:bg-[#2b3035] transition duration-200">
                            <td class="px-6 py-4 text-white">{{ $user->no_anggota }}</td>
                            <td class="px-6 py-4 text-white">{{ $user->name }}</td>
                            <td class="px-6 py-4 text-white">{{ $user->username }}</td>
                            <td class="px-6 py-4 text-white">{{ $user->user_type }}</td>
                            <td class="px-6 py-4 text-white">{{ $user->role }}</td>
                            <td class="px-6 py-4 text-center inline-flex w-full justify-center gap-1">
                                <button type="button" onclick="openModal('modalEdit{{ $user->id }}')""
                                    class="flex px-3 py-2 text-sm font-medium text-white bg-yellow-500 rounded-lg hover:cursor-pointer hover:bg-yellow-600 transition duration-200 shadow-md">
                                    <i class="bi bi-pencil-square"></i>
                                </button>
                                <button type="button" onclick="openModal('modalDelete{{ $user->id }}')"
                                    class="flex px-3 py-2 text-sm font-medium text-white bg-red-600 rounded-lg hover:cursor-pointer hover:bg-red-700 transition duration-200 shadow-md">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </td>
                        </tr>
                        {{-- MODAL EDIT --}}
                        <div id="modalEdit{{ $user->id }}"
                            class="fixed inset-0 z-50 hidden items-center justify-center backdrop-blur-sm bg-black/60">
                            <div
                                class="bg-[#1e2227] w-full max-w-2xl rounded-xl shadow-2xl 
                                    flex flex-col max-h-[90vh] p-6">

                                <div class="flex justify-between items-center border-b-2 border-white shrink-0 pb-4">
                                    <h2 class="text-xl font-semibold text-white">Ganti Password {{ $user->name }}</h2>
                                    <button onclick="closeModal('modalEdit{{ $user->id }}')"
                                        class="text-gray-400 hover:text-white text-xl hover:cursor-pointer transition-all duration-200">&times;</button>
                                </div>

                                <div class="overflow-y-auto no-scrollbar px-6 py-4">
                                    <form action="{{ route('PT.pusat-akun.update', $user->id) }}" method="POST" class="mt-4 space-y-3">
                                        @csrf
                                        @method('PUT')

                                        <div class="space-y-4">
                                            <div class="mb-3">
                                                <label for="no_anggota" class="text-gray-400 text-sm">Username</label>
                                                <br>
                                                <input type="text" name="username"
                                                    class="w-full mt-1 px-3 py-2 bg-gray-800 text-gray-300 rounded-lg border border-gray-700 hover:cursor-not-allowed"
                                                    placeholder="Username" value="{{ $user->username }}" readonly>
                                            </div>
                                            <div class="mb-3">
                                                <label for="password" class="text-gray-400 text-sm">Password Baru</label>
                                                <br>
                                                <input type="password" name="password"
                                                    class="w-full mt-1 px-3 py-2 bg-gray-800 text-gray-300 rounded-lg border border-gray-700"
                                                    placeholder="Password Baru">
                                            </div>

                                            <div class="flex justify-end gap-3 mt-6">
                                                <button type="button" onclick="closeModal('modalEdit{{ $user->id }}')"
                                                    class="px-4 py-2 bg-gray-600 hover:cursor-pointer hover:bg-gray-700 text-white rounded-lg transition duration-200">
                                                    Batal
                                                </button>

                                                <button type="submit"
                                                    class="px-4 py-2 bg-yellow-500 hover:bg-yellow-600 text-white rounded-lg transition duration-200 hover:cursor-pointer">
                                                    Update
                                                </button>
                                            </div>
                                        </div>

                                    </form>
                                </div>

                            </div>
                        </div>
                        <!-- Modal Delete -->
                        <div id="modalDelete{{ $user->id }}"
                            class="fixed inset-0 z-50 hidden items-center justify-center backdrop-blur-sm bg-black/60">

                            <div class="bg-[#1e2227] w-full max-w-md rounded-xl shadow-2xl p-6">
                                <div class="border-b-2 border-white pb-3">
                                    <h2 class="text-lg font-semibold text-white">Hapus Data</h2>
                                </div>

                                <form action="{{ route('PT.pusat-akun.destroy', $user->id) }}" method="POST"
                                    class="mt-4">
                                    @csrf
                                    @method('DELETE')
                                    <p class="text-white">Yakin ingin menghapus akun <b>{{ $user->name }}</b>?</p>
                                    <div class="flex justify-end gap-3 mt-6">
                                        <button type="button" onclick="closeModal('modalDelete{{ $user->id }}')"
                                            class="px-4 py-2 bg-gray-600 hover:cursor-pointer hover:bg-gray-700 text-white rounded-lg transition duration-200">
                                            Batal
                                        </button>
                                        <button type="submit"
                                            class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg transition duration-200 hover:cursor-pointer">
                                            Hapus
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    @endforeach
                    @if ($users->isEmpty())
                        <tr>
                            <td class="text-center">Tidak Ada Data</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
        <div class="mt-6 mx-4">
            <div>
                <div>
                    {{ $users->links() }}
                </div>
            </div>
        </div>
    </div>

    {{-- --------------------------------PASSWORD ADMIN---------------------------------- --}}

    <div class="bg-[#146841] rounded-2xl py-4 md:p-6 lg:py-6 px-4 lg:px-10 mt-6 mb-12">
        <div class="inline-flex justify-between w-full bg-gray-500 px-4 py-2 rounded-t-xl">
            <div class="text-white">
                Pusat Akun Admin
            </div>
        </div>
        <div class="overflow-x-auto mt-3 rounded-b-xl shadow-lg">
            <table id="dataTable" class="min-w-full text-sm text-left text-gray-300">
                <thead class="text-sm uppercase bg-black text-white">
                    <tr>
                        <th class="px-6 py-4">Nama</th>
                        <th class="px-6 py-4">Username</th>
                        <th class="px-6 py-4">Type</th>
                        <th class="px-6 py-4">Role</th>
                        <th class="px-6 py-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($admins as $admin)
                        <tr
                            class="border-b border-gray-700 odd:bg-[#212529] even:bg-[#181b1e] hover:bg-[#2b3035] transition duration-200">
                            <td class="px-6 py-4 text-white">{{ $admin->name }}</td>
                            <td class="px-6 py-4 text-white">{{ $admin->username }}</td>
                            <td class="px-6 py-4 text-white">{{ $admin->user_type }}</td>
                            <td class="px-6 py-4 text-white">{{ $admin->role }}</td>
                            <td class="px-6 py-4 text-center inline-flex w-full justify-center gap-1">
                                <button type="button" onclick="openModal('modalEdit{{ $admin->id }}')""
                                    class="flex px-3 py-2 text-sm font-medium text-white bg-yellow-500 rounded-lg hover:cursor-pointer hover:bg-yellow-600 transition duration-200 shadow-md">
                                    <i class="bi bi-pencil-square"></i>
                                </button>
                                <button type="button" onclick="openModal('modalDelete{{ $admin->id }}')"
                                    class="flex px-3 py-2 text-sm font-medium text-white bg-red-600 rounded-lg hover:cursor-pointer hover:bg-red-700 transition duration-200 shadow-md">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </td>
                        </tr>
                        <div id="modalEdit{{ $admin->id }}"
                            class="fixed inset-0 z-50 hidden items-center justify-center backdrop-blur-sm bg-black/60">
                            <div
                                class="bg-[#1e2227] w-full max-w-2xl rounded-xl shadow-2xl 
                                    flex flex-col max-h-[90vh] p-6">

                                <div class="flex justify-between items-center border-b-2 border-white shrink-0 pb-4">
                                    <h2 class="text-xl font-semibold text-white">Ganti Password {{ $admin->name }}</h2>
                                    <button onclick="closeModal('modalEdit{{ $admin->id }}')"
                                        class="text-gray-400 hover:text-white text-xl hover:cursor-pointer transition-all duration-200">&times;</button>
                                </div>

                                <div class="overflow-y-auto no-scrollbar px-6 py-4">
                                    <form action="{{ route('PT.pusat-akun.update', $admin->id) }}" method="POST"
                                        class="mt-4 space-y-3">
                                        @csrf
                                        @method('PUT')

                                        <div class="space-y-4">
                                            <div class="mb-3">
                                                <label for="name" class="text-gray-400 text-sm">Nama</label>
                                                <br>
                                                <input type="text" name="name"
                                                    class="w-full mt-1 px-3 py-2 bg-gray-800 text-gray-300 rounded-lg border border-gray-700"
                                                    placeholder="Nama" value="{{ $admin->name }}">
                                            </div>
                                            <div class="mb-3">
                                                <label for="username" class="text-gray-400 text-sm">Username</label>
                                                <br>
                                                <input type="text" name="username"
                                                    class="w-full mt-1 px-3 py-2 bg-gray-800 text-gray-300 rounded-lg border border-gray-700"
                                                    placeholder="Username" value="{{ $admin->username }}">
                                            </div>
                                            <div class="mb-3">
                                                <label for="password" class="text-gray-400 text-sm">Password Baru</label>
                                                <br>
                                                <input type="password" name="password"
                                                    class="w-full mt-1 px-3 py-2 bg-gray-800 text-gray-300 rounded-lg border border-gray-700"
                                                    placeholder="Password Baru">
                                            </div>

                                            <div class="flex justify-end gap-3 mt-6">
                                                <button type="button"
                                                    onclick="closeModal('modalEdit{{ $admin->id }}')"
                                                    class="px-4 py-2 bg-gray-600 hover:cursor-pointer hover:bg-gray-700 text-white rounded-lg transition duration-200">
                                                    Batal
                                                </button>

                                                <button type="submit"
                                                    class="px-4 py-2 bg-yellow-500 hover:bg-yellow-600 text-white rounded-lg transition duration-200 hover:cursor-pointer">
                                                    Update
                                                </button>
                                            </div>
                                        </div>

                                    </form>
                                </div>

                            </div>
                        </div>
                        <!-- Modal Delete -->
                        <div id="modalDelete{{ $admin->id }}"
                            class="fixed inset-0 z-50 hidden items-center justify-center backdrop-blur-sm bg-black/60">

                            <div class="bg-[#1e2227] w-full max-w-md rounded-xl shadow-2xl p-6">
                                <div class="border-b-2 border-white pb-3">
                                    <h2 class="text-lg font-semibold text-white">Hapus Data</h2>
                                </div>

                                <form action="{{ route('PT.pusat-akun.destroy', $admin->id) }}" method="POST"
                                    class="mt-4">
                                    @csrf
                                    @method('DELETE')
                                    <p class="text-white">Yakin ingin menghapus akun <b>{{ $admin->name }}</b>?</p>
                                    <div class="flex justify-end gap-3 mt-6">
                                        <button type="button" onclick="closeModal('modalDelete{{ $user->id }}')"
                                            class="px-4 py-2 bg-gray-600 hover:cursor-pointer hover:bg-gray-700 text-white rounded-lg transition duration-200">
                                            Batal
                                        </button>
                                        <button type="submit"
                                            class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg transition duration-200 hover:cursor-pointer">
                                            Hapus
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    @endforeach
                    @if ($users->isEmpty())
                        <tr>
                            <td class="text-center">Tidak Ada Data</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
    {{-- MODAL TAMBAH USER --}}
    <div id="modalTambah" class="fixed inset-0 z-50 hidden items-center justify-center backdrop-blur-sm bg-black/60">
        <div class="bg-[#1e2227] w-full max-w-2xl rounded-xl shadow-2xl flex flex-col max-h-[90vh]">
            <div class="flex justify-between items-center border-b p-6 shrink-0">
                <h2 class="text-xl font-semibold text-white">Tambah Akun</h2>
                <button onclick="closeModal('modalTambah')"
                    class="text-gray-400 hover:text-white text-xl hover:cursor-pointer transition-all duration-200">&times;</button>
            </div>
            <div class="overflow-y-auto no-scrollbar px-6 py-4">
                <form action="{{ route('PT.pusat-akun.store') }}" method="POST" class="space-y-4">
                    @csrf
                    <div class="space-y-4">
                        <div class="mb-3">
                            <label for="no_anggota" class="text-gray-400 text-sm">No Anggota</label> <br>
                            <input type="text" name="name"
                                class="w-full mt-1 px-3 py-2 bg-gray-800 text-gray-300 rounded-lg border border-gray-700"
                                placeholder="No Anggota (opsional)">
                        </div>
                        <div class="mb-3">
                            <label for="name" class="text-gray-400 text-sm">Nama</label> <br>
                            <input type="text" name="name"
                                class="w-full mt-1 px-3 py-2 bg-gray-800 text-gray-300 rounded-lg border border-gray-700"
                                placeholder="Nama" required>
                        </div>
                        <div class="mb-3">
                            <label for="username" class="text-gray-400 text-sm">Username</label> <br>
                            <input type="text" name="username"
                                class="w-full mt-1 px-3 py-2 bg-gray-800 text-gray-300 rounded-lg border border-gray-700"
                                placeholder="Username" required>
                        </div>
                        <div class="mb-3">
                            <label for="user_type" class="text-gray-400 text-sm">Tipe User</label> <br>
                            <select name="user_type"
                                class="w-full mt-1 px-3 py-2 bg-gray-800 text-white rounded-lg border border-gray-700 hover:cursor-pointer transition-all duration-200"
                                required>
                                <option value="" class="text-gray-400" disabled selected>- Pilih Tipe User -
                                </option>
                                <option value="admin">Admin</option>
                                <option value="user">User</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="role" class="text-gray-400 text-sm">Role</label> <br>
                            <input type="text" name="role"
                                class="w-full mt-1 px-3 py-2 bg-gray-800 text-gray-300 rounded-lg border border-gray-700"
                                placeholder="Role (PSDA/Ketum/PT/dll)" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="text-gray-400 text-sm">Password</label> <br>
                            <input type="password" name="password"
                                class="w-full mt-1 px-3 py-2 bg-gray-800 text-gray-300 rounded-lg border border-gray-700"
                                placeholder="Password" required>
                        </div>
                        <div class="flex justify-end gap-3 mt-6">
                            <button type="button" onclick="closeModal('modalTambah')"
                                class="px-4 py-2 bg-gray-600 hover:cursor-pointer hover:bg-gray-700 text-white rounded-lg transition duration-200">
                                Batal
                            </button>
                            <button type="submit"
                                class="px-4 py-2 bg-[#198754] hover:bg-[#146c43] text-white rounded-lg transition duration-200 hover:cursor-pointer">
                                Submit
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('script')
@endsection
