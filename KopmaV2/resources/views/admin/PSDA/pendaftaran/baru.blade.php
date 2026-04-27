@extends('layout.master')
@section('judul')
    PSDA | Pendaftaran
@endsection
@section('content')
    @include('layout._pendaftaran')
    <div class="overflow-x-auto mt-3 rounded-b-xl shadow-lg">
        @if ($pendaftars->count() > 0)
            <table id="dataTable" class="min-w-max text-sm text-left text-gray-300">
                <thead class="text-sm uppercase bg-black text-white">
                    <tr>
                        <th class="px-6 py-4">Waktu Daftar</th>
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
                            <td class="px-6 py-4 text-white"><a href="https://wa.me/+62{{ $p->no_wa }}" target="_blank"
                                    class="no-wa">0{{ $p->no_wa }}</a></td>
                            <td class="px-6 py-4 text-white">{{ $p->ttl }}</td>
                            <td class="px-6 py-4 text-white">{{ $p->alamat }}</td>
                            <td class="px-6 py-4 text-white">{{ $p->kelamin }}</td>
                            <td class="px-6 py-4 text-white">{{ $p->agama }}</td>
                            <td class="px-6 py-4 text-white">{{ $p->fakultas }}</td>
                            <td class="px-6 py-4 text-white">{{ $p->jurusan }}</td>
                            <td class="px-6 py-4 text-white">{{ $p->email }}</td>
                            <td class="px-6 py-4 text-white">{{ $p->metode }}</td>
                            <td class="px-6 py-4 text-white">{{ $p->status }}</td>
                            <td class="text-white text-center">
                                <center>
                                    <button type="button" onclick="openModal('modalImage{{ $p->id }}')"
                                        class="flex px-3 py-2 text-sm font-medium text-white bg-gray-600 rounded-lg hover:cursor-pointer hover:bg-gray-700 transition duration-200 shadow-md">
                                        <i class="bi bi-card-image"></i>
                                    </button>
                                </center>

                            </td>
                            <td class="px-6 py-4 text-center inline-flex gap-1">
                                <button type="button" onclick="openModal('modalReject{{ $p->id }}')"
                                    class="flex px-3 py-2 text-sm font-medium text-white bg-red-600 rounded-lg hover:cursor-pointer hover:bg-red-700 transition duration-200 shadow-md">
                                    <i class="bi bi-x-lg"></i>
                                </button>
                                <button type="button" onclick="openModal('modalConfirm{{ $p->id }}')"
                                    class="flex px-3 py-2 text-sm font-medium text-white bg-[#198754] rounded-lg hover:cursor-pointer hover:bg-[#146c43] transition duration-200 shadow-md">
                                    <i class="bi bi-check-lg"></i>
                                </button </td>
                        </tr>
    </div>
    {{-- Modal Reject --}}
    <div id="modalReject{{ $p->id }}"
        class="fixed inset-0 z-50 hidden items-center justify-center backdrop-blur-sm bg-black/60">

        <div class="bg-[#1e2227] w-full max-w-md rounded-xl shadow-2xl p-6">
            <div class="border-b-2 border-white pb-3">
                <h2 class="text-lg font-semibold text-white">Konfirmasi Tolak</h2>
            </div>

            <form action="{{ route('PSDA.tolak', $p->id) }}" method="POST" class="mt-4">
                @csrf
                @method('PUT')
                <input type="hidden" name="status" value="Ditolak">
                <p class="text-white">Apakah anda yakin ingin menolak <b class="text-red-500">{{ $p->nama }}</b>
                    sebagai anggota Kopma UPNVY?</p>
                <div class="flex justify-end gap-3 mt-6">
                    <button type="button" onclick="closeModal('modalReject{{ $p->id }}')"
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
                    <img 
                        src="{{ asset($p->bukti) }}" 
                        alt="Bukti Pembayaran"
                        class="h-[75vh] rounded-xl object-contain">
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
                <a href="{{ asset($p->bukti) }}" download class="px-4 py-2 bg-[#198754] hover:bg-[#146c43] text-white rounded-lg transition duration-200 hover:cursor-pointer">
                    Download
                </a>
            </div>
        </div>
    </div>
    {{-- Modal Confirm --}}
    <div id="modalConfirm{{ $p->id }}"
        class="fixed inset-0 z-50 hidden items-center justify-center backdrop-blur-sm bg-black/60">

        <div class="bg-[#1e2227] w-full max-w-md rounded-xl shadow-2xl p-6">
            <div class="border-b-2 border-white pb-3">
                <h2 class="text-lg font-semibold text-white">Konfirmasi Terima</h2>
            </div>

            <form action="{{ route('PSDA.terima', $p->id) }}" method="POST" class="mt-4">
                @csrf
                @method('PUT')
                <p class="text-white">
                    Apakah anda yakin ingin menerima <span class="font-bold underline uppercase text-[#198754]">{{ $p->nama }}</span>
                    sebagai anggota Kopma UPNVY?
                </p>
                <input type="hidden" name="status" value="Diterima">
                <div class="flex justify-end gap-3 mt-6">
                    <button type="button" onclick="closeModal('modalConfirm{{ $p->id }}')"
                        class="px-4 py-2 bg-gray-600 hover:cursor-pointer hover:bg-gray-700 text-white rounded-lg transition duration-200">
                        Batal
                    </button>

                    <button type="submit"
                        class="px-4 py-2 bg-[#198754] hover:bg-[#146c43] text-white rounded-lg transition duration-200 hover:cursor-pointer">
                        Yakin!
                    </button>
                </div>
            </form>
        </div>
    </div>
    @endforeach
    </tbody>
    </table>

    <div class="text-white">
        Menampilkan {{ $pendaftars->firstItem() }} sampai {{ $pendaftars->lastItem() }} dari
        {{ $pendaftars->total() }}
        hasil
    </div>
    </div>


    <div class="w-full mt-6">
        <hr>
        <div class="mt-6 mx-4">
            <div>
                <div>
                    {{ $pendaftars->links() }}
                </div>
            </div>
        </div>
    </div>
@else
<div class="text-white font-bold">DATA MASIH KOSONG</div>
@endif
    </div>
    <!-- Batas Konten -->
@endsection




<!-- Modal -->
{{-- <div class="modal fade" id="modalBukti{{ $p->id }}" tabindex="-1"
                                        aria-labelledby="modalLabel{{ $p->id }}" aria-hidden="true">
                                        <div class="modal-dialog modal-lg modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="modalLabel{{ $p->id }}">Bukti
                                                        Pembayaran</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body text-center">
                                                    @if ($p->bukti)
                                                        <img src="/public/img/bukti/{{ $p->bukti }}"
                                                            alt="Bukti Pembayaran" class="img-fluid rounded">
                                                    @else
                                                        <p class="text-muted">Tidak ada bukti pembayaran.<br>Metode
                                                            pembayaran: <strong>{{ $p->metode }}</strong></p>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div> --}}
<!-- Modal reject -->
{{-- <div class="modal fade" id="rejectModal{{ $p->id }}">
                                <div class="modal-dialog">
                                    <div class="modal-content">

                                        <!-- Modal Header -->
                                        <div class="modal-header">
                                            <h4 class="modal-title">Konfirmasi Tolak</h4>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>


                                        <form action="{{ route('PSDA.tolak', $p->id) }}" method="post">
                                            @csrf
                                            @method('PUT')
                                            <!-- Modal body -->
                                            <div class="modal-body">
                                                Apakah anda yakin ingin menolak <span
                                                    style="font-weight: bold; text-decoration:underline;">{{ $p->nama }}</span>
                                                sebagai anggota Kopma UPNVY?
                                            </div>
                                            <input type="hidden" name="status" value="Ditolak">
                                            <!-- Modal footer -->
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-success">Ya</button>
                                                <button type="button" class="btn btn-danger"
                                                    data-bs-dismiss="modal">Tidak</button>
                                            </div>
                                        </form>

                                    </div>
                                </div>
                            </div> --}}

<!-- Modal confirm -->
{{-- <div class="modal fade" id="confirmModal{{ $p->id }}">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Konfirmasi Terima</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>


                <form action="{{ route('PSDA.terima', $p->id) }}" method="post">
                    @csrf
                    @method('PUT')
                    <!-- Modal body -->
                    <div class="modal-body">
                        Apakah anda yakin ingin menerima <span
                            style="font-weight: bold; text-decoration:underline;">{{ $p->nama }}</span>
                        sebagai anggota Kopma UPNVY?
                    </div>
                    <input type="hidden" name="status" value="Diterima">
                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Ya</button>
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Tidak</button>
                    </div>
                </form>

            </div>
        </div>
    </div> --}}
