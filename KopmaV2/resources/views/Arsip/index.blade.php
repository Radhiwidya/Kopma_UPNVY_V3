
@extends('layout.master')

@section('judul')
    {{ $bidang }} | Arsip
@endsection

@section('content')

<h3 class="text-3xl font-semibold mb-4 text-white">
    <i class="bi bi-folder2-open mr-2"></i>
    DATA ARSIP
</h3>
@if(session('success'))
<div id="notif"
     class="bg-green-500 text-white px-4 py-3 rounded mb-4">
    {{ session('success') }}
</div>

<script>
setTimeout(function() {
    let notif = document.getElementById('notif');
    if(notif){
        notif.style.display = 'none';
    }
}, 3000);
</script>
@endif

<hr class="border-t border-white/50">





<!-- BUTTON TAMBAH -->

<button onclick="openModal('modalTambah')"
    class="text-white px-3 py-2 bg-[#146841] mt-5 rounded-md hover:bg-[#146c43] transition duration-200">

    + Tambah Arsip

</button>





<!-- TABLE -->

<div class="bg-[#146841] rounded-2xl py-4 md:p-6 lg:py-6 px-4 lg:px-10 mt-6 mb-12">

    <div class="flex justify-between items-center w-full bg-gray-500 px-4 py-3 rounded-t-xl">

        <div class="text-white font-semibold">

            Data Arsip

        </div>





        <!-- SEARCH -->

        <form method="GET"
            action="{{ route('arsip.index', $bidang) }}"
            class="flex gap-2">

            <input type="text"
                name="search"
                value="{{ request('search') }}"
                placeholder="Cari judul arsip..."
                class="px-3 py-2 rounded bg-gray-700 text-white border-none outline-none">

            <button type="submit"
                class="bg-[#146841] text-white px-4 rounded hover:bg-green-700">

                <i class="bi bi-search"></i>

            </button>

        </form>

    </div>





    <div class="overflow-x-auto mt-3 rounded-b-xl shadow-lg">

        <table class="min-w-full text-sm text-left text-gray-300">

            <thead class="text-sm uppercase bg-black text-white">

                <tr>

                    <th class="px-6 py-4">
                        NO. ARSIP
                    </th>

                    <th class="px-6 py-4">
                        JUDUL
                    </th>

                    <th class="px-6 py-4">
                        BIDANG
                    </th>

                    <th class="px-6 py-4">
                        STATUS
                    </th>

                    <th class="px-6 py-4">
                        TANGGAL
                    </th>

                    <th class="px-6 py-4 text-center">
                        AKSI
                    </th>

                </tr>

            </thead>





            <tbody>

                @forelse ($arsips as $arsip)

                    <tr
                        class="border-b border-gray-700 odd:bg-[#212529] even:bg-[#181b1e] hover:bg-[#2b3035] transition duration-200">

                        <td class="px-6 py-4 text-white">

                            {{ $arsip->nomor_arsip }}

                        </td>





                        <td class="px-6 py-4 text-white">

                            {{ $arsip->judul }}

                        </td>





                        <td class="px-6 py-4 text-white uppercase">

                            {{ $arsip->bidang }}

                        </td>





                        <td class="px-6 py-4">

                            @if ($arsip->status == 'public')

                                <span class="bg-green-600 text-white px-3 py-1 rounded-md text-xs">

                                    Public

                                </span>

                            @else

                                <span class="bg-yellow-500 text-black px-3 py-1 rounded-md text-xs">

                                    Privat

                                </span>

                            @endif

                        </td>





                        <td class="px-6 py-4 text-white">

                            {{ $arsip->created_at->format('d F Y') }}

                        </td>





                        <td class="px-6 py-4">

                            <div class="flex gap-2 justify-center">

                                <!-- VIEW -->

                                <a href="{{ $arsip->link }}"
                                    target="_blank"
                                    class="bg-sky-500 hover:bg-sky-600 text-white px-3 py-2 rounded-md transition">

                                    <i class="bi bi-eye-fill"></i>

                                </a>





                                <!-- EDIT -->

                                <button
                                    onclick="openModal('editModal{{ $arsip->id }}')"
                                    class="bg-yellow-400 hover:bg-yellow-500 text-black px-3 py-2 rounded-md transition">

                                    <i class="bi bi-pencil-fill"></i>

                                </button>





                                <!-- DELETE -->

                                <form action="{{ route('arsip.destroy', $arsip->id) }}"
                                    method="POST"
                                    onsubmit="return confirm('Hapus arsip ini?')">

                                    @csrf
                                    @method('DELETE')

                                    <button
                                        class="bg-red-500 hover:bg-red-600 text-white px-3 py-2 rounded-md transition">

                                        <i class="bi bi-trash-fill"></i>

                                    </button>

                                </form>

                            </div>

                        </td>

                    </tr>





                    <!-- MODAL EDIT -->

                    <div id="editModal{{ $arsip->id }}"
                        class="fixed inset-0 hidden z-50">

                        <div class="fixed inset-0 flex items-center justify-center bg-black/50">

                            <div class="bg-[#212529] rounded-xl shadow-lg w-full max-w-lg p-6">

                                <div class="flex justify-between items-center mb-4">

                                    <h2 class="text-xl text-white font-semibold">

                                        Edit Arsip

                                    </h2>

                                    <button onclick="closeModal('editModal{{ $arsip->id }}')"
                                        class="text-white text-2xl">

                                        &times;

                                    </button>

                                </div>





                                <form action="{{ route('arsip.update', $arsip->id) }}"
                                    method="POST">

                                    @csrf
                                    @method('PUT')





                                    <div class="mb-4">

                                        <label class="block text-white mb-2">

                                            Judul Arsip

                                        </label>

                                        <input type="text"
                                            name="judul"
                                            value="{{ $arsip->judul }}"
                                            required
                                            class="w-full px-4 py-2 rounded bg-gray-700 text-white border-none">

                                    </div>





                                    <div class="mb-4">

                                        <label class="block text-white mb-2">

                                            Link File

                                        </label>

                                        <input type="text"
                                            name="link"
                                            value="{{ $arsip->link }}"
                                            required
                                            class="w-full px-4 py-2 rounded bg-gray-700 text-white border-none">

                                    </div>





                                    <div class="mb-4">

                                        <label class="block text-white mb-2">

                                            Status

                                        </label>

                                        <select name="status"
                                            class="w-full px-4 py-2 rounded bg-gray-700 text-white border-none">

                                            <option value="public"
                                                {{ $arsip->status == 'public' ? 'selected' : '' }}>

                                                Public

                                            </option>

                                            <option value="privat"
                                                {{ $arsip->status == 'privat' ? 'selected' : '' }}>

                                                Privat

                                            </option>

                                        </select>

                                    </div>





                                    <button type="submit"
                                        class="bg-yellow-500 hover:bg-yellow-600 text-black px-4 py-2 rounded-md">

                                        Update Arsip

                                    </button>

                                </form>

                            </div>

                        </div>

                    </div>

                @empty

                    <tr>

                        <td colspan="6"
                            class="px-6 py-4 text-center text-white">

                            Belum ada arsip

                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>





<!-- MODAL TAMBAH -->

<div id="modalTambah"
    class="fixed inset-0 hidden z-50">

    <div class="fixed inset-0 flex items-center justify-center bg-black/50">

        <div class="bg-[#212529] rounded-xl shadow-lg w-full max-w-lg p-6">

            <div class="flex justify-between items-center mb-4">

                <h2 class="text-xl text-white font-semibold">

                    Tambah Arsip

                </h2>

                <button onclick="closeModal('modalTambah')"
                    class="text-white text-2xl">

                    &times;

                </button>

            </div>





            <form action="{{ route('arsip.store', $bidang) }}"
                method="POST">

                @csrf





                <div class="mb-4">

                    <label class="block text-white mb-2">

                        Judul Arsip

                    </label>

                    <input type="text"
                        name="judul"
                        required
                        class="w-full px-4 py-2 rounded bg-gray-700 text-white border-none">

                </div>





                <div class="mb-4">

                    <label class="block text-white mb-2">

                        Link File

                    </label>

                    <input type="text"
                        name="link"
                        placeholder="https://drive.google.com/..."
                        required
                        class="w-full px-4 py-2 rounded bg-gray-700 text-white border-none">

                </div>





                <div class="mb-4">

                    <label class="block text-white mb-2">

                        Status

                    </label>

                    <select name="status"
                        class="w-full px-4 py-2 rounded bg-gray-700 text-white border-none">

                        <option value="public">

                            Public

                        </option>

                        <option value="privat">

                            Privat

                        </option>

                    </select>

                </div>





                <button type="submit"
                    class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-md">

                    Upload Arsip

                </button>

            </form>

        </div>

    </div>

</div>

@endsection

