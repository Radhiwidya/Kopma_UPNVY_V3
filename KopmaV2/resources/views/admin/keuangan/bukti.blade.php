@extends('layout.master')
@section('judul')
    Keuangan | Bukti Pendaftaran
@endsection
@section('content')
    <h3 class=" text-3xl font-semibold mb-4 text-white"><i class="bi bi-person-add" style="margin-right: 10px;"></i>BUKTI
        PENDAFTARAN
    </h3>
    <hr class=" border-t border-white/50">
    <!-- Konten -->
    <div class=" bg-[#146841] rounded-2xl py-4 md:p-6 lg:py-6 px-4 lg:px-10 mt-6 mb-12 "> {{-- Done --}}
        <div class="inline-flex justify-between w-full bg-gray-500 px-4 py-2 rounded-t-xl">
            <div class="text-white">
                Simpanan Anggota
            </div>
            @include('layout._search')
            @if ($search)
                <div class="mt-3 text-white" style="width: 97%;">
                    Menampilkan hasil pencarian untuk: <strong>"{{ $search }}"</strong>
                    ({{ $pendaftars->total() }} hasil ditemukan)
                </div>
            @endif
        </div>
        <div class="overflow-x-auto mt-3 rounded-b-xl shadow-lg">
            @if ($pendaftars->count() > 0)
                <table id="dataTable" class="min-w-full text-sm text-left text-gray-300">
                    <thead class="text-sm uppercase bg-black text-white">
                        <tr>
                            <th class="px-6 py-4">Waktu</th>
                            <th class="px-6 py-4">Nama</th>
                            <th class="px-6 py-4">NIM</th>
                            <th class="px-6 py-4">Metode</th>
                            <th class="px-6 py-4 text-center">Bukti</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pendaftars as $p)
                            <tr
                                class="border-b border-gray-700 odd:bg-[#212529] even:bg-[#181b1e] hover:bg-[#2b3035] transition duration-200">
                                <td class="px-6 py-4 text-white">{{ $p->updated_at }}</td>
                                <td class="px-6 py-4 text-white">{{ $p->nama }}</td>
                                <td class="px-6 py-4 text-white">{{ $p->nim }}</td>
                                <td class="px-6 py-4 text-white">{{ $p->metode }}</td>
                                <td class="text-white text-center">
                                    <center>
                                        <button type="button" onclick="openModal('modalImage{{ $p->id }}')"
                                            class="flex px-3 py-2 text-sm font-medium text-white bg-gray-600 rounded-lg hover:cursor-pointer hover:bg-gray-700 transition duration-200 shadow-md">
                                            <i class="bi bi-card-image"></i>
                                        </button>
                                    </center>

                                    {{-- <!-- Modal -->
                                    <div class="modal fade" id="modalBukti{{ $p->id }}" tabindex="-1"
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
                                </td>
                            </tr>
                            <div id="modalImage{{ $p->id }}"
                                class="fixed inset-0 z-50 hidden items-center justify-center backdrop-blur-sm bg-black/60">

                                <div class="bg-[#1e2227] w-full max-w-md rounded-xl shadow-2xl p-6">
                                    <div class="border-b-2 border-white pb-3">
                                        <h2 class="text-lg font-semibold text-white">Bukti Pembayaran</h2>
                                    </div>
                                    <div class="pt-3 w-full flex justify-center items-center text-gray-500">
                                        @if ($p->bukti)
                                            <img src="{{ asset($p->bukti) }}" alt="Bukti Pembayaran"
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
        </div>
        <div class="text-white">
            Menampilkan {{ $pendaftars->firstItem() }} sampai {{ $pendaftars->lastItem() }} dari
            {{ $pendaftars->total() }}
            hasil
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
        <div class="alert alert-danger">DATA MASIH KOSONG</div>
    </div>
    @endif
    </div>
    <!-- Batas Konten -->
@endsection
