@extends('public.layouts._master')

@section('title')
    KOPMA UPNVY | Cek No. Anggota
@endsection

@section('content')
    <div class="bg-white/30 w-full mx-10 md:w-[350px] px-6 shadow-[15px_15px_15px_rgba(0,0,0,0.25)] py-4 rounded-xl">
        <center>
            <h2 class="pt-5 text-2xl font-bold text-white">Cek No. Anggota</h2>
        </center>
        @if (session('error'))
            <p style="color: red;">{{ session('error') }}</p>
        @endif
        <form method="POST" action="{{ route('cek.no') }}">
            @csrf
            <div class="w-full my-14">
                <input type="text" name="nim" id="nim" class="w-full p-2 rounded-md bg-white/80 "
                    placeholder="NIM" required>
            </div>
            <button type="submit" name="submit" class="mb-5 py-2 w-full rounded-md text-white bg-[#059212] hover:cursor-pointer hover:bg-white/50 hover:text-[#059212] transition">Cek No Anggota</button>
        </form>
    </div>
@endsection
