@extends('public.layouts._master')

@section('title')
    KOPMA UPNVY | Hasil Cek No. Anggota
@endsection


@section('content')
    <div class=" text-white text-base">
        <center>
            <p>Hallo <span style="font-weight: bold; color:rgb(0, 0, 0)">{!! $nama !!}</span> <br>
            no. anggota kamu adalah <span style="font-weight: bold; color:rgb(0, 0, 0)">{!! $no_anggota !!}</span></p>
            <br>
            <a class=" underline text-blue-700" href="/cek-no-anggota">Kembali</a>
        </center>
    </div>
@endsection
