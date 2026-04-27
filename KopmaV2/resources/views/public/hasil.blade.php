@extends('public.layouts._master')

@section('title')
KOPMA UPNVY | Hasil
@endsection

@section('content')
<div class="text-white text-base mx-5">
    <center>
        {!! $pesan !!}
        <a href="/pengumuman" class=" underline text-blue-700">Kembali</a>
    </center>
</div>
@endsection
