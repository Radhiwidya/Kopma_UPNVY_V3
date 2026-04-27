@extends('layout.master')
@section('judul')
    Usaha | Laporan
@endsection
@section('content')
    <h3><i class="bi bi-people" style="margin-right: 10px;"></i>LAPORAN USAHA</h3>
    <hr>
    <select class="btn btn-primary" style="margin-right: 10px" name="" id="">
        <option value="">Pilih Tahun</option>
        <option value="">2024</option>
        <option value="">2025</option>
        <option value="">2026</option>
    </select>
    <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#tambahAnggota"> Unduh Excel </button>

    <div class="card mt-3">
        @include('layout._laporan-usaha')
        {{-- @if ($search)
            <div class="mt-3" style="width: 97%;">
                Menampilkan hasil pencarian untuk: <strong>"{{ $search }}"</strong>
                ({{ $anggotas->total() }} hasil ditemukan)
            </div>
        @endif --}}
        <div class="card-body" style="overflow-y: auto; width:100%">
            <center>
                <b>KOPERASI MAHASISWA UPN "VETERAN" YOGYAKARTA <br> LAPORAN LABA RUGI TAHUN 2025</b>
            </center>
            <table id="dataTable" class="table table-striped table-hover table-bordered mt-3" style="width: max-content;">
                <thead>
                    <tr>
                        <th scope="col">Keterangan</th>
                        <th scope="col">Januari</th>
                        <th scope="col">Februari</th>
                        <th scope="col">Maret</th>
                        <th scope="col">April</th>
                        <th scope="col">Mei</th>
                        <th scope="col">Juni</th>
                        <th scope="col">Juli</th>
                        <th scope="col">Agustus</th>
                        <th scope="col">September</th>
                        <th scope="col">Oktober</th>
                        <th scope="col">November</th>
                        <th scope="col">Desember</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Baris "Cek" yang memenuhi semua kolom -->
                    <tr>
                        <td colspan="13" class="fw-bold">PENDAPATAN</td>
                    </tr>
            
                    <!-- Contoh baris data -->
                    <tr>
                        <th>4101 Pendapatan Usaha</th>
                        <td>Rp. 0</td>
                        <td>Rp. 0</td>
                        <td>Rp. 0</td>
                        <td>Rp. 0</td>
                        <td>Rp. 0</td>
                        <td>Rp. 0</td>
                        <td>Rp. 0</td>
                        <td>Rp. 0</td>
                        <td>Rp. 0</td>
                        <td>Rp. 0</td>
                        <td>Rp. 0</td>
                        <td>Rp. 0</td>
                    </tr>
                    <tr>
                        <td>Konveksi</td>
                        <td>Rp. 0</td>
                        <td>Rp. 0</td>
                        <td>Rp. 0</td>
                        <td>Rp. 0</td>
                        <td>Rp. 0</td>
                        <td>Rp. 0</td>
                        <td>Rp. 0</td>
                        <td>Rp. 0</td>
                        <td>Rp. 0</td>
                        <td>Rp. 0</td>
                        <td>Rp. 0</td>
                        <td>Rp. 0</td>
                    </tr>
                    <tr>
                        <th>Total Pendapatan</th>
                        <td>Rp. 0</td>
                        <td>Rp. 0</td>
                        <td>Rp. 0</td>
                        <td>Rp. 0</td>
                        <td>Rp. 0</td>
                        <td>Rp. 0</td>
                        <td>Rp. 0</td>
                        <td>Rp. 0</td>
                        <td>Rp. 0</td>
                        <td>Rp. 0</td>
                        <td>Rp. 0</td>
                        <td>Rp. 0</td>
                    </tr>
                    {{-- GAP --}}
                    <tr>
                        <td colspan="13" class="fw-bold" style="color: transparent">GAP</td>
                    </tr>
                    {{-- HPP --}}
                    <tr>
                        <td colspan="13" class="fw-bold">HARGA POKOK PENJUALAN</td>
                    </tr>
                    <tr>
                        <th>5112 Harga Pokok Penjualan</th>
                        <td>Rp. 0</td>
                        <td>Rp. 0</td>
                        <td>Rp. 0</td>
                        <td>Rp. 0</td>
                        <td>Rp. 0</td>
                        <td>Rp. 0</td>
                        <td>Rp. 0</td>
                        <td>Rp. 0</td>
                        <td>Rp. 0</td>
                        <td>Rp. 0</td>
                        <td>Rp. 0</td>
                        <td>Rp. 0</td>
                    </tr>
                    <tr>
                        <td>Konveksi</td>
                        <td>Rp. 0</td>
                        <td>Rp. 0</td>
                        <td>Rp. 0</td>
                        <td>Rp. 0</td>
                        <td>Rp. 0</td>
                        <td>Rp. 0</td>
                        <td>Rp. 0</td>
                        <td>Rp. 0</td>
                        <td>Rp. 0</td>
                        <td>Rp. 0</td>
                        <td>Rp. 0</td>
                        <td>Rp. 0</td>
                    </tr>
                    <tr>
                        <th>TOTAL HPP</th>
                        <td>Rp. 0</td>
                        <td>Rp. 0</td>
                        <td>Rp. 0</td>
                        <td>Rp. 0</td>
                        <td>Rp. 0</td>
                        <td>Rp. 0</td>
                        <td>Rp. 0</td>
                        <td>Rp. 0</td>
                        <td>Rp. 0</td>
                        <td>Rp. 0</td>
                        <td>Rp. 0</td>
                        <td>Rp. 0</td>
                    </tr>
                    <tr>
                        <th>LABA KOTOR</th>
                        <td>Rp. 0</td>
                        <td>Rp. 0</td>
                        <td>Rp. 0</td>
                        <td>Rp. 0</td>
                        <td>Rp. 0</td>
                        <td>Rp. 0</td>
                        <td>Rp. 0</td>
                        <td>Rp. 0</td>
                        <td>Rp. 0</td>
                        <td>Rp. 0</td>
                        <td>Rp. 0</td>
                        <td>Rp. 0</td>
                    </tr>
                </tbody>
            </table>
            
            {{-- <div class="tampil">
                Menampilkan {{ $anggotas->firstItem() }} sampai {{ $anggotas->lastItem() }} dari {{ $anggotas->total() }}
                hasil
            </div> --}}
        </div>
        {{-- <div class="container mt-3">
            <div>
                <div>
                    {{ $anggotas->links() }}
                </div>
            </div>
        </div> --}}

    </div>
@endsection
