@extends('public.layouts._master')

@section('title')
KOPMA UPNVY | Lupa Password
@endsection

@section('content')
<div class="bg-white/30 w-full mx-4 md:mx-10 md:w-[400px] px-6 py-6 shadow-[15px_15px_15px_rgba(0,0,0,0.25)] rounded-xl backdrop-blur-md">
    
    <h2 class="text-2xl font-bold text-white text-center mb-4">
        Lupa Password
    </h2>

    <p class="text-black text-sm leading-relaxed mb-4">
        Silakan kirim email ke 
        <span class="font-semibold">techdev@kopma-upnvy.com</span> 
        dengan subjek:
        <span class="italic">"Lupa Password"</span>.
    </p>

    <div class="text-black text-sm space-y-2 mb-4">
        <p class="font-semibold">Format keterangan:</p>
        <ul class="space-y-2">
            <li class="flex">
                <span class="w-24 font-medium">Anggota</span>
                <span class="mx-1">:</span>
                <span>Nama Lengkap_Nomor Anggota</span>
            </li>
            <li class="flex">
                <span class="w-24 font-medium">Bidang</span>
                <span class="mx-1">:</span>
                <span>Nama Bidang_Username</span>
            </li>
        </ul>
    </div>

    <p class="text-black text-sm leading-relaxed">
        Tim kami akan membantu mereset password Anda maksimal dalam 
        <span class="font-semibold">3 hari kerja</span>.  
        Terima kasih!
    </p>
    <a href="/login">
        <div
            class="w-full mt-8 bg-gray-400 py-2 rounded-lg text-white text-center hover:bg-gray-500 hover:cursor-pointer duration-200 transition-all">
            Kembali ke Login
        </div>
    </a>

</div>
@endsection