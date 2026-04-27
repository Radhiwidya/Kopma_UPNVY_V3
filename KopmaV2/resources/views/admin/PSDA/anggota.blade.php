@extends('layout.master')
@section('judul')
    PSDA | Data Anggota
@endsection
@section('content')
    <h3 class=" text-3xl font-semibold mb-4 text-white"><i class="bi bi-people" style="margin-right: 10px;"></i>DATA ANGGOTA
    </h3>
    <hr class=" border-t border-white/50">
    <!--Input-->
    <button onclick="openModal('modalTambah')"
        class="text-white px-2.5 py-1.5 bg-[#146841] mt-5 rounded-md hover:cursor-pointer hover:bg-[#146c43] transition duration-200">
        Tambah Anggota </button>
    <!-- Output -->
    <div class=" bg-[#146841] rounded-2xl py-4 md:p-6 lg:py-6 px-4 lg:px-10 mt-6 mb-12 "> {{-- Done --}}
        <div class="inline-flex justify-between w-full bg-gray-500 px-4 py-2 rounded-t-xl">
            <div class="text-white">
                Data Anggota
            </div>
            @include('layout._search')
        </div>
        @if ($search)
            <div class="mt-3 text-white" style="width: 97%;">
                Menampilkan hasil pencarian untuk: <strong>"{{ $search }}"</strong>
                ({{ $anggotas->total() }} hasil ditemukan)
            </div> {{-- Done --}}
        @endif

        <div class="overflow-x-auto mt-3 rounded-b-xl shadow-lg">
            <table id="dataTable" class="min-w-max text-sm text-left text-gray-300">
                <thead class="text-sm uppercase bg-black text-white">
                    <tr>
                        <th class="px-6 py-4">No. Anggota</th>
                        <th class="px-6 py-4">Diklat</th>
                        <th class="px-6 py-4">Nama</th>
                        <th class="px-6 py-4">NIM</th>
                        <th class="px-6 py-4">No. WhatsApp</th>
                        <th class="px-6 py-4">Tanggal Lahir</th>
                        <th class="px-6 py-4">Alamat</th>
                        <th class="px-6 py-4">Jenis Kelamin</th>
                        <th class="px-6 py-4">Agama</th>
                        <th class="px-6 py-4">Fakultas</th>
                        <th class="px-6 py-4">Prodi</th>
                        <th class="px-6 py-4">E-mail</th>
                        <th class="px-6 py-4">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($anggotas as $anggota)
                        <tr
                            class="border-b border-gray-700 odd:bg-[#212529] even:bg-[#181b1e] hover:bg-[#2b3035] transition duration-200">
                            <td class="px-6 py-4 text-white">{{ $anggota->no_anggota }}</td>
                            <td class="px-6 py-4 @if ($anggota->diklat == 'sudah') text-green-500 @elseif ($anggota->diklat == 'belum') text-red-500
                            @endif uppercase">{{ $anggota->diklat }}</td>
                            <td class="px-6 py-4 text-white uppercase">{{ $anggota->nama }}</td>
                            <td class="px-6 py-4 text-white">{{ $anggota->nim }}</td>
                            <td class="px-6 py-4 text-white"><a href="https://wa.me/+62{{ $anggota->no_wa }}"
                                    target="_blank" class="no-wa">0{{ $anggota->no_wa }}</a></td>
                            <td class="px-6 py-4 text-white">{{ $anggota->ttl }}</td>
                            <td class="px-6 py-4 text-white">{{ $anggota->alamat }}</td>
                            <td class="px-6 py-4 text-white">{{ $anggota->kelamin }}</td>
                            <td class="px-6 py-4 text-white">{{ $anggota->agama }}</td>
                            <td class="px-6 py-4 text-white">{{ $anggota->fakultas }}</td>
                            <td class="px-6 py-4 text-white">{{ $anggota->jurusan }}</td>
                            <td class="px-6 py-4 text-white">{{ $anggota->email }}</td>
                            <td class="px-6 py-4 text-center inline-flex gap-1">
                                <button type="button" onclick="openModal('modalEdit{{ $anggota->id }}')""
                                    class="flex px-3 py-2 text-sm font-medium text-white bg-yellow-500 rounded-lg hover:cursor-pointer hover:bg-yellow-600 transition duration-200 shadow-md">
                                    <i class="bi bi-pencil-square"></i>
                                </button>
                                <button type="button" onclick="openModal('modalDelete{{ $anggota->id }}')"
                                    class="flex px-3 py-2 text-sm font-medium text-white bg-red-600 rounded-lg hover:cursor-pointer hover:bg-red-700 transition duration-200 shadow-md">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </td>
                        </tr>

                        <!-- Modal Edit -->
                        <div id="modalEdit{{ $anggota->id }}"
                            class="fixed inset-0 z-50 hidden items-center justify-center backdrop-blur-sm bg-black/60">
                            <div
                                class="bg-[#1e2227] w-full max-w-2xl rounded-xl shadow-2xl 
                                    flex flex-col max-h-[90vh] p-6">

                                <div class="flex justify-between items-center border-b-2 border-white shrink-0 pb-4">
                                    <h2 class="text-xl font-semibold text-white">Edit data {{ $anggota->nama }}</h2>
                                    <button onclick="closeModal('modalEdit{{ $anggota->id }}')"
                                        class="text-gray-400 hover:text-white text-xl hover:cursor-pointer transition-all duration-200">&times;</button>
                                </div>

                                <div class="overflow-y-auto no-scrollbar px-6 py-4">
                                    <form action="{{ route('PSDA.anggota.update', $anggota->id) }}" method="POST"
                                        class="mt-4 space-y-3">
                                        @csrf
                                        @method('PUT')

                                        <div class="space-y-4">
                                            <div class="mb-3">
                                                <label for="no_anggota" class="text-gray-400 text-sm">No. Anggota</label>
                                                <br>
                                                <input type="text" name="no_anggota"
                                                    class="w-full mt-1 px-3 py-2 bg-gray-800 text-gray-300 rounded-lg border border-gray-700"
                                                    placeholder="No Anggota" value="{{ $anggota->no_anggota }}" required>
                                            </div>

                                            <div class="mb-3">
                                                <label for="nama" class="text-gray-400 text-sm">Nama</label> <br>
                                                <input type="text" name="nama"
                                                    class="w-full mt-1 px-3 py-2 bg-gray-800 text-gray-300 rounded-lg border border-gray-700"
                                                    placeholder="Nama" value="{{ $anggota->nama }}" required>
                                            </div>

                                            <div class="mb-3">
                                                <label for="nim" class="text-gray-400 text-sm">NIM</label> <br>
                                                <input type="number" name="nim"
                                                    class="w-full mt-1 px-3 py-2 bg-gray-800 text-gray-300 rounded-lg border border-gray-700"
                                                    placeholder="NIM" value="{{ $anggota->nim }}" required>
                                            </div>

                                            <div class="mb-3">
                                                <label for="no_wa" class="text-gray-400 text-sm">No WhatsApp</label>
                                                <br>
                                                <input type="number" name="no_wa"
                                                    class="w-full mt-1 px-3 py-2 bg-gray-800 text-gray-300 rounded-lg border border-gray-700"
                                                    placeholder="No WhatsApp" value="{{ $anggota->no_wa }}" required>
                                            </div>

                                            <div class="mb-3">
                                                <label for="ttl" class="text-gray-400 text-sm">Tanggal Lahir</label>
                                                <br>
                                                <input type="date" name="ttl"
                                                    class="w-full mt-1 px-3 py-2 bg-gray-800 text-gray-300 rounded-lg border border-gray-700"
                                                    value="{{ $anggota->ttl }}" required>
                                            </div>

                                            <div class="mb-3">
                                                <label for="alamat" class="text-gray-400 text-sm">Alamat</label> <br>
                                                <input type="text" name="alamat"
                                                    class="w-full mt-1 px-3 py-2 bg-gray-800 text-gray-300 rounded-lg border border-gray-700"
                                                    placeholder="Alamat" value="{{ $anggota->alamat }}" required>
                                            </div>

                                            <div class="mb-3">
                                                <label for="kelamin" class="text-gray-400 text-sm">Jenis Kelamin</label>
                                                <br>
                                                <select name="kelamin"
                                                    class="w-full mt-1 px-3 py-2 bg-gray-800 text-white rounded-lg border border-gray-700 hover:cursor-pointer transition-all duration-200"
                                                    value="{{ $anggota->kelamin }}" required>
                                                    <option value="Laki-Laki">Laki-Laki</option>
                                                    <option value="Perempuan">Perempuan</option>
                                                </select>
                                            </div>

                                            <div class="mb-3">
                                                <label for="agama" class="text-gray-400 text-sm">Agama</label> <br>
                                                <select name="agama"
                                                    class="w-full mt-1 px-3 py-2 bg-gray-800 text-white rounded-lg border border-gray-700 hover:cursor-pointer transition-all duration-200"
                                                    value="{{ $anggota->agama }}" required>
                                                    <option value="Islam">Islam</option>
                                                    <option value="Kristen">Kristen</option>
                                                    <option value="Katholik">Katholik</option>
                                                    <option value="Budha">Budha</option>
                                                    <option value="Hindu">Hindu</option>
                                                    <option value="Konghucu">Konghucu</option>
                                                    <option value="Lainnya">Lainnya</option>
                                                </select>
                                            </div>

                                            <div class="mb-3">
                                                <label for="fakultas" class="text-gray-400 text-sm">Fakultas</label> <br>
                                                <select name="fakultas"
                                                    class="w-full mt-1 px-3 py-2 bg-gray-800 text-white rounded-lg border border-gray-700 hover:cursor-pointer transition-all duration-200"
                                                    value="{{ $anggota->fakultas }}" required>
                                                    <option value="FTI">FTI</option>
                                                    <option value="FEB">FEB</option>
                                                    <option value="FISIP">FISIP</option>
                                                    <option value="FP">FP</option>
                                                    <option value="FTME">FTME</option>
                                                    <option value="Lainnya">Lainnya</option>
                                                </select>
                                            </div>

                                            <div class="mb-3">
                                                <label for="jurusan" class="text-gray-400 text-sm">Program Studi</label>
                                                <br>
                                                <input type="text" name="jurusan"
                                                    class="w-full mt-1 px-3 py-2 bg-gray-800 text-gray-300 rounded-lg border border-gray-700"
                                                    placeholder="Program Studi" value="{{ $anggota->jurusan }}" required>
                                            </div>

                                            <div class="mb-3">
                                                <label for="email" class="text-gray-400 text-sm">E-Mail</label> <br>
                                                <input type="email" name="email"
                                                    class="w-full mt-1 px-3 py-2 bg-gray-800 text-gray-300 rounded-lg border border-gray-700"
                                                    placeholder="E-Mail" value="{{ $anggota->email }}" required>
                                            </div>
                                            <div class="flex justify-end gap-3 mt-6">
                                                <button type="button"
                                                    onclick="closeModal('modalEdit{{ $anggota->id }}')"
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
                        <div id="modalDelete{{ $anggota->id }}"
                            class="fixed inset-0 z-50 hidden items-center justify-center backdrop-blur-sm bg-black/60">

                            <div class="bg-[#1e2227] w-full max-w-md rounded-xl shadow-2xl p-6">
                                <div class="border-b-2 border-white pb-3">
                                    <h2 class="text-lg font-semibold text-white">Hapus Data</h2>
                                </div>

                                <form action="{{ route('PSDA.anggota.destroy', $anggota->no_anggota) }}" method="POST"
                                    class="mt-4">
                                    @csrf
                                    @method('DELETE')

                                    <p class="text-white">Yakin ingin menghapus <b>{{ $anggota->nama }}</b> dari <b
                                            class="text-red-500">SEMUA</b> database?</p>
                                    <p class=" text-[10px] text-red-500 mt-2">*Pastikan No. Anggota sudah terisi untuk
                                        menghindari error!</p>

                                    <div class="flex justify-end gap-3 mt-6">
                                        <button type="button" onclick="closeModal('modalDelete{{ $anggota->id }}')"
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
                </tbody>
            </table>
        </div>
        <div class="w-full mt-6">
            <hr>
            <div class="mt-6 mx-4">
                <div>
                    <div>
                        {{ $anggotas->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="modalTambah" class="fixed inset-0 z-50 hidden items-center justify-center backdrop-blur-sm bg-black/60">
        <!-- Container -->
        <div class="bg-[#1e2227] w-full max-w-2xl rounded-xl shadow-2xl 
                flex flex-col max-h-[90vh]">

            <!-- HEADER (TIDAK SCROLL) -->
            <div class="flex justify-between items-center border-b p-6 shrink-0">
                <h2 class="text-xl font-semibold text-white">Tambah Anggota</h2>
                <button onclick="closeModal('modalTambah')"
                    class="text-gray-400 hover:text-white text-xl hover:cursor-pointer transition-all duration-200">&times;</button>
            </div>

            <!-- BODY (SCROLL AREA) -->
            <div class="overflow-y-auto no-scrollbar px-6 py-4">
                <form action="{{ route('PSDA.anggota.store') }}" method="POST" class="space-y-4">
                    @csrf

                    <div class="space-y-4">
                        <div class="mb-3" style="display: none;">
                            <input type="text" name="no_anggota"
                                class="w-full mt-1 px-3 py-2 bg-gray-800 text-gray-300 rounded-lg border border-gray-700"
                                placeholder="No Anggota">
                        </div>

                        <div class="mb-3">
                            <label for="nama" class="text-gray-400 text-sm">Nama</label> <br>
                            <input type="text" name="nama"
                                class="w-full mt-1 px-3 py-2 bg-gray-800 text-gray-300 rounded-lg border border-gray-700"
                                placeholder="Nama" required>
                        </div>

                        <div class="mb-3">
                            <label for="nim" class="text-gray-400 text-sm">NIM</label> <br>
                            <input type="number" name="nim"
                                class="w-full mt-1 px-3 py-2 bg-gray-800 text-gray-300 rounded-lg border border-gray-700"
                                placeholder="NIM" required>
                        </div>

                        <div class="mb-3">
                            <label for="no_wa" class="text-gray-400 text-sm">No WhatsApp</label> <br>
                            <input type="number" name="no_wa"
                                class="w-full mt-1 px-3 py-2 bg-gray-800 text-gray-300 rounded-lg border border-gray-700"
                                placeholder="No WhatsApp" required>
                        </div>

                        <div class="mb-3">
                            <label for="ttl" class="text-gray-400 text-sm">Tanggal Lahir</label> <br>
                            <input type="date" name="ttl"
                                class="w-full mt-1 px-3 py-2 bg-gray-800 text-gray-300 rounded-lg border border-gray-700"
                                required>
                        </div>

                        <div class="mb-3">
                            <label for="alamat" class="text-gray-400 text-sm">Alamat</label> <br>
                            <input type="text" name="alamat"
                                class="w-full mt-1 px-3 py-2 bg-gray-800 text-gray-300 rounded-lg border border-gray-700"
                                placeholder="Alamat" required>
                        </div>

                        <div class="mb-3">
                            <label for="kelamin" class="text-gray-400 text-sm">Jenis Kelamin</label> <br>
                            <select name="kelamin"
                                class="w-full mt-1 px-3 py-2 bg-gray-800 text-white rounded-lg border border-gray-700 hover:cursor-pointer transition-all duration-200"
                                required>
                                <option value="" class="text-gray-400" disabled selected>- Pilih Jenis Kelamin -
                                </option>
                                <option value="Laki-Laki">Laki-Laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="agama" class="text-gray-400 text-sm">Agama</label> <br>
                            <select name="agama"
                                class="w-full mt-1 px-3 py-2 bg-gray-800 text-white rounded-lg border border-gray-700 hover:cursor-pointer transition-all duration-200"
                                required>
                                <option value="" class="text-gray-400" disabled selected>- Pilih Agama -</option>
                                <option value="Islam">Islam</option>
                                <option value="Kristen">Kristen</option>
                                <option value="Katholik">Katholik</option>
                                <option value="Budha">Budha</option>
                                <option value="Hindu">Hindu</option>
                                <option value="Konghucu">Konghucu</option>
                                <option value="Lainnya">Lainnya</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="fakultas" class="text-gray-400 text-sm">Fakultas</label> <br>
                            <select name="fakultas"
                                class="w-full mt-1 px-3 py-2 bg-gray-800 text-white rounded-lg border border-gray-700 hover:cursor-pointer transition-all duration-200"
                                required>
                                <option value="" class="text-gray-400" disabled selected>- Pilih Fakultas -</option>
                                <option value="FTI">FTI</option>
                                <option value="FEB">FEB</option>
                                <option value="FISIP">FISIP</option>
                                <option value="FP">FP</option>
                                <option value="FTME">FTME</option>
                                <option value="Lainnya">Lainnya</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="jurusan" class="text-gray-400 text-sm">Program Studi</label> <br>
                            <input type="text" name="jurusan"
                                class="w-full mt-1 px-3 py-2 bg-gray-800 text-gray-300 rounded-lg border border-gray-700"
                                placeholder="Program Studi" required>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="text-gray-400 text-sm">E-Mail</label> <br>
                            <input type="email" name="email"
                                class="w-full mt-1 px-3 py-2 bg-gray-800 text-gray-300 rounded-lg border border-gray-700"
                                placeholder="E-Mail" required>
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
