@extends('layout.master')
@section('judul')
    Dashboard
@endsection
@section('content')
    <h3 class=" text-3xl font-semibold mb-4 text-white"><i class="fa-solid fa-gauge" style="margin-right: 10px;"></i>DASHBOARD</h3>
    <hr class=" border-t border-white/50">
    <div class=" mt-6 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-2 gap-4">
        <!-- Total Anggota -->
        <div class="bg-[#6C757D] rounded-xl shadow-md px-10 py-8 relative overflow-hidden">
            <div class="absolute right-10 top-7 self-center text-8xl text-white opacity-20">
                <i class="bi bi-people"></i>
            </div>
            <h5 class="text-white text-lg font-semibold">Total Anggota</h5>
            <div class="text-6xl text-white font-bold mt-4">{{ $jumlahAnggota }}</div>
            <a href="" class="block mt-4 text-white hover:underline">
                Lihat Detail <i class="bi bi-caret-right"></i>
            </a>
        </div>
    
        <!-- Pendaftar -->
        <div class="bg-[#0D6EFD] rounded-xl shadow-md px-10 py-8 relative overflow-hidden">
            <div class="absolute right-10 top-7 text-8xl text-white opacity-20">
                <i class="bi bi-person-add"></i>
            </div>
            <h5 class="text-white text-lg font-semibold">Pendaftar</h5>
            <div class="text-6xl text-white font-bold mt-4">{{ $jumlahDaftar }}</div>
            <a href="" class="block mt-4 text-white hover:underline">
                Lihat Detail <i class="bi bi-caret-right"></i>
            </a>
        </div>
    
        <!-- Diterima -->
        <div class="bg-[#DC3545] rounded-xl shadow-md px-10 py-8 relative overflow-hidden">
            <div class="absolute right-10 top-7 text-8xl text-white opacity-20">
                <i class="bi bi-person-check"></i>
            </div>
            <h5 class="text-white text-lg font-semibold">Di Terima</h5>
            <div class="text-6xl text-white font-bold mt-4">{{ $jumlahDiterima }}</div>
            <a href="" class="block mt-4 text-white hover:underline">
                Lihat Detail <i class="bi bi-caret-right"></i>
            </a>
        </div>
    
        <!-- Coming Soon -->
        <div class="bg-[#198752] rounded-xl shadow-md px-10 py-8 relative overflow-hidden">
            <div class="absolute right-10 top-7 text-8xl text-white opacity-20">
                <i class="bi bi-clock"></i>
            </div>
            <h5 class="text-white text-lg font-semibold">Coming Soon</h5>
            <div class="text-6xl text-white font-bold mt-4">xxx</div>
            <a href="#" class="block mt-4 text-white hover:underline">
                Lihat Detail <i class="bi bi-caret-right"></i>
            </a>
        </div>
    
        <div class="bg-[#0DCAF0] rounded-xl shadow-md px-10 py-8 relative overflow-hidden">
            <div class="absolute right-10 top-7 text-8xl text-white opacity-20">
                <i class="bi bi-clock"></i>
            </div>
            <h5 class="text-white text-lg font-semibold">Coming Soon</h5>
            <div class="text-6xl text-white font-bold mt-4">xxx</div>
            <a href="#" class="block mt-4 text-white hover:underline">
                Lihat Detail <i class="bi bi-caret-right"></i>
            </a>
        </div>
    
        <div class="bg-[#FFC107] rounded-xl shadow-md px-10 py-8 relative overflow-hidden">
            <div class="absolute right-10 top-7 text-8xl text-white opacity-20">
                <i class="bi bi-clock"></i>
            </div>
            <h5 class="text-white text-lg font-semibold">Coming Soon</h5>
            <div class="text-6xl text-white font-bold mt-4">xxx</div>
            <a href="#" class="block mt-4 text-white hover:underline">
                Lihat Detail <i class="bi bi-caret-right"></i>
            </a>
        </div>
    
    </div>
@endsection
