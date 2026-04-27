@extends('public.layouts._master')

@section('title')
    KOPMA UPNVY | Presensi Diklat
@endsection

@section('content')
    <div class="flex items-center justify-center min-h-screen px-4">
        <div class="w-full max-w-md p-8 rounded-2xl bg-white/20 backdrop-blur-lg border border-white/30 shadow-xl">
            @if (!session('anggota'))
                <div class="text-center mb-6">
                    <h2 class="text-3xl font-bold text-white">Presensi Diklat</h2>
                </div>
            @endif
            @if (session('anggota'))
                <div class="text-center mb-6">
                    <h2 class="text-3xl font-bold text-white">Data Anggota</h2>
                    <p class="text-sm text-red-500">Pastikan data anda seusai sebelum melakukan konfirmasi kehadiran!</p>
                </div>
            @endif


            {{-- ERROR --}}
            @if (session('error'))
                <div class="mb-4 p-3 rounded-lg bg-red-500/20 text-red-200">
                    {{ session('error') }}
                </div>
            @endif

            {{-- SUCCESS --}}
            @if (session('success'))
                <div class="mb-4 p-3 rounded-lg bg-green-500/20 text-green-200">
                    {{ session('success') }}
                </div>
            @endif
            {{-- STEP 1: INPUT --}}
            @if (!session('anggota'))
                <form action="{{ route('diklat.cek') }}" method="POST" class="space-y-6">
                    @csrf
                    <div>
                        <label class="block text-sm text-white/80 mb-1">
                            Nomor Anggota
                        </label>
                        <input type="text" name="no_anggota" placeholder="contoh : 020.23.08.23 "required
                            class="w-full px-4 py-2 rounded-lg bg-white/80 focus:bg-white outline-none transition">
                        <a href="/cek-no-anggota" target="_blank"
                            class="text-xs text-blue-600 hover:text-blue-800 hover:underline mt-1 inline-block">
                            Lupa nomor anggota?
                        </a>
                    </div>
                    <!-- Button -->
                    <button type="submit"
                        class="mb-5 py-2 w-full rounded-md text-white bg-[#059212] hover:cursor-pointer hover:bg-white/50 hover:text-[#059212] transition">
                        Submit Presensi
                    </button>
                </form>
            @endif
            {{-- STEP 2: PREVIEW --}}
            @if (session('anggota'))
                <div class="space-y-2 text-white mb-4">

                    <div class="grid grid-cols-[110px_1fr]">
                        <span class="font-semibold">Nama</span>
                        <span>: {{ session('anggota')->nama }}</span>
                    </div>

                    <div class="grid grid-cols-[110px_1fr]">
                        <span class="font-semibold">No Anggota</span>
                        <span>: {{ session('anggota')->no_anggota }}</span>
                    </div>

                    <div class="grid grid-cols-[110px_1fr]">
                        <span class="font-semibold">NIM</span>
                        <span>: {{ session('anggota')->nim }}</span>
                    </div>

                    <div class="grid grid-cols-[110px_1fr] items-center">
                        <span class="font-semibold">Status Diklat</span>
                        <span>
                            :
                            <span
                                class="uppercase text-xs px-1.5 py-[1px] rounded-sm border 
                                    @if (session('anggota')->diklat == 'sudah') bg-green-300 text-green-700 
                                    @elseif (session('anggota')->diklat == 'belum')
                                        bg-red-300 text-red-700
                                    @else hidden @endif">
                                {{ session('anggota')->diklat }}
                            </span>
                        </span>
                    </div>

                </div>
                <form action="{{ route('diklat.update') }}" method="POST">
                    @csrf
                    <input type="hidden" name="no_anggota" value="{{ session('anggota')->no_anggota }}">
                    <button type="submit" class="w-full py-2 rounded-lg bg-blue-600 text-white hover:bg-blue-700 cursor-pointer">
                        Konfirmasi Presensi
                    </button>
                </form>
                <a href="/presensi-diklat" class="">
                    <div
                        class="w-full mt-2 bg-gray-400 py-2 rounded-lg text-white text-center hover:bg-gray-500 hover:cursor-pointer duration-200 transition-all">
                        Ganti Nomor
                    </div>
                </a>
            @endif
        </div>
    </div>
@endsection
