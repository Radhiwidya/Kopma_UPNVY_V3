@extends('public.layouts._master')

@section('title')
KOPMA UPNVY | Hasil
@endsection

@section('content')
<div class=" text-white text-base mx-5">
    <center>
        <b>Selamat <span style="color: red">{{ $pesan }}</span> anda diterima menjadi anggota KOPMA UPNVY tahun {{ date('Y') }}! </b> <br>
        <b>No. Anggota anda adalah <span style="color: red">{{ $no_anggota }}</span></b>
        <p>Untuk Informasi Selengkapnya Silahkan Join <a class=" underline text-blue-700" href="{{ $LinkAnggota }}">Grup Anggota</a> dan <a class=" underline text-blue-700" href="{{ $LinkDiklat }}">Grup Diklat</a></p>
        <a class=" underline text-blue-700" href="/pengumuman">Kembali</a>
    </center>
</div>
@endsection