@extends('layout.master')
@section('judul')
    PSDA | Pendaftaran
@endsection
@section('content')
    @include('layout._pendaftaran')
    <div class=" flex w-full justify-end my-2">
        <form action="{{ route('PSDA.hapusSemua') }}" method="POST" onsubmit="return confirm('Yakin hapus semua data?')">
            @csrf
            @method('DELETE')
            <button
                class="bg-red-500 text-white px-4 py-2 rounded-md hover:bg-red-600 hover:cursor-pointer transition duration-200">Hapus
                Semua Data Diterima</button>
        </form>
    </div>
    <div class="overflow-x-auto rounded-b-xl shadow-lg">
        @if ($pendaftars->count() > 0)
            <table id="dataTable" class="min-w-max text-sm text-left text-gray-300">
                <thead class="text-sm uppercase bg-black text-white">
                    <tr>
                        <th class="px-6 py-4">Waktu Diterima</th>
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
                        <th class="px-6 py-4">Metode</th>
                        <th class="px-6 py-4">Status</th>
                        <th class="px-6 py-4">Bukti</th>
                        <th class="px-6 py-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pendaftars as $p)
                        <tr
                            class="border-b border-gray-700 odd:bg-[#212529] even:bg-[#181b1e] hover:bg-[#2b3035] transition duration-200">
                            <td class="px-6 py-4 text-white">{{ $p->created_at }}</td>
                            <td class="px-6 py-4 text-white">{{ $p->nama }}</td>
                            <td class="px-6 py-4 text-white">{{ $p->nim }}</td>
                            <td class="px-6 py-4 text-white hover:underline hover:cursor-pointer"><a
                                    href="https://wa.me/+62{{ $p->no_wa }}" target="_blank">0{{ $p->no_wa }}</a>
                            </td>
                            <td class="px-6 py-4 text-white">{{ $p->ttl }}</td>
                            <td class="px-6 py-4 text-white">{{ $p->alamat }}</td>
                            <td class="px-6 py-4 text-white">{{ $p->kelamin }}</td>
                            <td class="px-6 py-4 text-white">{{ $p->agama }}</td>
                            <td class="px-6 py-4 text-white">{{ $p->fakultas }}</td>
                            <td class="px-6 py-4 text-white">{{ $p->jurusan }}</td>
                            <td class="px-6 py-4 text-white">{{ $p->email }}</td>
                            <td class="px-6 py-4 text-white">{{ $p->metode }}</td>
                            <td class="px-6 py-4 text-white">{{ $p->status }}</td>
                            <td class="px-6 py-4 text-white">
                                <center>
                                    <button type="button" onclick="openModal('modalImage{{ $p->id }}')"
                                        class="flex px-3 py-2 text-sm font-medium text-white bg-gray-600 rounded-lg hover:cursor-pointer hover:bg-gray-700 transition duration-200 shadow-md">
                                        <i class="bi bi-card-image"></i>
                                    </button>
                                </center>

                            </td>
                            <td class="px-6 py-4 text-center inline-flex gap-1">
                                <button type="button" onclick="openModal('modalDelete{{ $p->id }}')"
                                    class="flex px-3 py-2 text-sm font-medium text-white bg-red-600 rounded-lg hover:cursor-pointer hover:bg-red-700 transition duration-200 shadow-md">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </td>
                        </tr>
    </div>
    {{-- Modal Delete --}}
    <div id="modalDelete{{ $p->id }}"
        class="fixed inset-0 z-50 hidden items-center justify-center backdrop-blur-sm bg-black/60">

        <div class="bg-[#1e2227] w-full max-w-md rounded-xl shadow-2xl p-6">
            <div class="border-b-2 border-white pb-3">
                <h2 class="text-lg font-semibold text-white">Konfirmasi Hapus</h2>
            </div>

            <form action="{{ route('PSDA.delete', $p->id) }}" method="post" class="mt-4">
                @csrf
                @method('DELETE')
                <!-- Modal body -->
                <p class="text-white">
                    Apakah anda yakin ingin menghapus data <span
                        style="font-weight: bold; text-decoration:underline;">{{ $p->nama }}</span>
                    dari data diterima?
                </p>
                <div class="flex justify-end gap-3 mt-6">
                    <button type="button" onclick="closeModal('modalDelete{{ $p->id }}')"
                        class="px-4 py-2 bg-gray-600 hover:cursor-pointer hover:bg-gray-700 text-white rounded-lg transition duration-200">
                        Batal
                    </button>

                    <button type="submit"
                        class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg transition duration-200 hover:cursor-pointer">
                        Yakin!
                    </button>
                </div>
            </form>
        </div>
    </div>
    {{-- Modal Image --}}
    <div id="modalImage{{ $p->id }}"
        class="fixed inset-0 z-50 hidden items-center justify-center backdrop-blur-sm bg-black/60">

        <div class="bg-[#1e2227] w-full max-w-md rounded-xl shadow-2xl p-6">
            <div class="border-b-2 border-white pb-3">
                <h2 class="text-lg font-semibold text-white">Bukti Pembayaran</h2>
            </div>
            <div class="pt-3 w-full flex justify-center items-center text-gray-500">
                @if ($p->bukti)
                    <img src="{{ asset($p->bukti) }}" alt="Bukti Pembayaran" class="h-[75vh] rounded-xl object-contain">
                @else
                    <p class="text-muted text-center">
                        Tidak ada bukti pembayaran.<br>
                        Metode pembayaran: <strong>{{ $p->metode }}</strong>
                    </p>
                @endif
            </div>

            <div class="flex justify-end gap-3 mt-6">
                <button type="button" onclick="closeModal('modalImage{{ $p->id }}')"
                    class="px-4 py-2 bg-gray-600 hover:cursor-pointer hover:bg-gray-700 text-white rounded-lg transition duration-200">
                    Tutup
                </button>
                <a href="{{ asset($p->bukti) }}" download
                    class="px-4 py-2 bg-[#198754] hover:bg-[#146c43] text-white rounded-lg transition duration-200 hover:cursor-pointer">
                    Download
                </a>
            </div>
        </div>
    </div>
    @endforeach
    </tbody>
    </table>

    <div class="text-white my-4">
        Menampilkan {{ $pendaftars->firstItem() }} sampai {{ $pendaftars->lastItem() }} dari
        {{ $pendaftars->total() }}
        hasil
    </div>
    </div>
    <div class="container mt-3">
        <div>
            <div>
                {{ $pendaftars->links() }}
            </div>
        </div>
    </div>
@else
    <div class="alert alert-danger">DATA MASIH KOSONG</div>
    </div>
    @endif
    </div>

    <div class=" bg-[#146841] rounded-2xl py-6 px-10 mt-6 mb-12 ">
        <div class=" overflow-y-auto w-full">
            <form action="{{ route('PSDA.addLink') }}" method="POST">
                @csrf
                <select id="jenis_link"
                    class="flex-1 px-2 py-1.5 text-sm rounded-md text-gray-700 placeholder-gray-400 focus:outline-none bg-white"
                    name="jenis_link" required>
                    <option value="" selected disabled>- Pilih Jenis Link -</option>
                    <option value="Keluarga">Link Keluarga Kopma</option>
                    <option value="Diklat">Link Diklat</option>
                </select>
                <input
                    class="flex-1 px-2 py-[5px] text-sm rounded-md text-gray-700 placeholder-gray-400 focus:outline-none bg-white"
                    type="text" name="link" placeholder="Link grup WhatsApp">
                <button
                    class="bg-blue-600 px-2 py-1 text-white rounded-md hover:bg-blue-700 hover:cursor-pointer transition-all duration-200"
                    type="submit">Submit</button>
            </form>
            <div class="overflow-x-auto rounded-b-xl shadow-lg">
                <table id="dataTable" class="w-full my-4 text-sm text-left text-gray-300">
                    <thead class="text-sm uppercase bg-black text-white">
                        <tr>
                            <th class="px-6 py-4">Link Grup Keluarga Kopma</th>
                            <th class="px-6 py-4 text-end">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($keluarga->count() > 0)
                            @foreach ($keluarga as $k)
                                <tr
                                    class="border-b border-gray-700 odd:bg-[#212529] even:bg-[#181b1e] hover:bg-[#2b3035] transition duration-200">
                                    <td class="px-6 py-4 text-white">
                                        <a href="{{ $k->link }}" class=" hover:underline" target="_blank">{{ $k->link }}</a></td>
                                    <td class="px-6 py-4 text-white text-right">
                                        <form action="{{ route('PSDA.hapusKeluarga') }}" method="POST"
                                            onsubmit="return confirm('Yakin hapus link grup keluarga kopma?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="inline-flex px-3 py-2 text-sm font-medium text-white bg-red-600 rounded-lg hover:bg-red-700 transition duration-200 shadow-md">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr
                                class="border-b border-gray-700 odd:bg-[#212529] even:bg-[#181b1e] hover:bg-[#2b3035] transition duration-200">
                                <td colspan="2" class="text-center text-red-500 py-4"><b>Link WhatsApp Group belum
                                        ditambahkan!</b></td>
                            </tr>
                        @endif
                    </tbody>
                </table>
                <table id="dataTable" class="w-full my-4 text-sm text-left text-gray-300">
                    <thead class="text-sm uppercase bg-black text-white">
                        <tr>
                            <th class="px-6 py-4">Link Grup Peserta Diklat</th>
                            <th class="px-6 py-4 text-end">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($diklat->count() > 0)
                            @foreach ($diklat as $d)
                                <tr
                                    class="border-b border-gray-700 odd:bg-[#212529] even:bg-[#181b1e] hover:bg-[#2b3035] transition duration-200">
                                    <td class="px-6 py-4 text-white">
                                        <a href="{{ $d->link }}" class=" hover:underline" target="_blank">{{ $k->link }}</a></td>
                                    </td>
                                    <td class="px-6 py-4 text-white text-right">
                                        <form action="{{ route('PSDA.hapusDiklat') }}" method="POST"
                                            onsubmit="return confirm('Yakin hapus link grup diklat kopma?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="inline-flex px-3 py-2 text-sm font-medium text-white bg-red-600 rounded-lg hover:bg-red-700 transition duration-200 shadow-md">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr
                                class="border-b border-gray-700 odd:bg-[#212529] even:bg-[#181b1e] hover:bg-[#2b3035] transition duration-200">
                                <td colspan="2" class="text-center text-red-500 py-4"><b>Link WhatsApp Group belum
                                        ditambahkan!</b></td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>

        </div>
    </div>
    <!-- Batas Konten -->
@endsection
