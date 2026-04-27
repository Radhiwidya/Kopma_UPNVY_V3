@extends('layout.master')
@section('judul')
    PSDA | Point Keaktifan
@endsection
@section('content')
    <h3 class=" text-3xl font-semibold mb-4 text-white"><i class="bi bi-activity mr-2.5"></i>POINT ANGGOTA</h3>
    <hr class=" border-t border-white/50">
    <!-- Output -->
    <div class=" bg-[#146841] rounded-2xl py-4 md:p-6 lg:py-6 px-4 lg:px-10 mt-6 mb-12 "> {{-- Done --}}
        <div class="inline-flex justify-between w-full bg-gray-500 px-4 py-2 rounded-t-xl">
            <div class="text-white">
                Point Anggota
            </div>
            {{-- Search --}}
            @include('layout._search')
        </div> {{-- Done --}}
        @if ($search)
            <div class="mt-3 text-white" style="width: 97%;">
                Menampilkan hasil pencarian untuk: <strong>"{{ $search }}"</strong>
                ({{ $poins->total() }} hasil ditemukan)
            </div> {{-- Done --}}
        @endif
        <div class="overflow-x-auto mt-3 rounded-b-xl shadow-lg">
            <table id="dataTable" class="min-w-full text-sm text-left text-gray-300">
                <!-- Header -->
                <thead class="text-sm uppercase bg-black text-white">
                    <tr>
                        <th class="px-6 py-4">No. Anggota</th>
                        <th class="px-6 py-4">Nama</th>
                        <th class="px-6 py-4">Total Point</th>
                        @if (Auth::user()->role === 'psda' || Auth::user()->role === 'ketua' || Auth::user()->role === 'riset')
                            <th class="px-6 py-4 text-center">Aksi</th>
                        @endif
                    </tr>
                </thead>

                <!-- Body -->
                <tbody>
                    @foreach ($poins as $poin)
                        <tr
                            class="border-b border-gray-700 odd:bg-[#212529] even:bg-[#181b1e] hover:bg-[#2b3035] transition duration-200">

                            <td class="px-6 py-4 text-white">
                                {{ $poin->no_anggota }}
                            </td>

                            <td class="px-6 py-4 text-white">
                                {{ $poin->nama }}
                            </td>

                            <td class="px-6 py-4 text-white font-semibold">
                                {{ $poin->point }}
                            </td>

                            @if (Auth::user()->role === 'psda' || Auth::user()->role === 'ketua' || Auth::user()->role === 'riset')
                                <td class="px-6 py-4 text-center">
                                    <button type="button" onclick="openModal('modalEdit{{ $poin->id }}')"
                                        class="px-3 py-2 text-sm font-medium text-white bg-[#198754] rounded-lg hover:cursor-pointer hover:bg-[#146c43] transition duration-200 shadow-md">
                                        <i class="bi bi-plus-lg"></i>
                                    </button>
                                </td>
                            @endif

                        </tr>
                        <!-- Modal -->
                        <div id="modalEdit{{ $poin->id }}"
                            class="fixed inset-0 z-50 hidden items-center justify-center backdrop-blur-sm bg-black/60">

                            <div class="bg-[#1e2227] w-full max-w-lg rounded-2xl shadow-2xl p-6">

                                <!-- Header -->
                                <div class="flex justify-between items-center border-b border-gray-700 pb-3">
                                    <h4 class="text-lg font-semibold text-white">
                                        Tambah Poin {{ $poin->nama }}
                                    </h4>

                                    <button onclick="closeModal('modalEdit{{ $poin->id }}')"
                                        class="text-gray-400 hover:text-white text-xl hover:cursor-pointer transition-all duration-200">
                                        &times;
                                    </button>
                                </div>

                                <!-- Form -->
                                <form action="{{ route('PSDA.tambahPoin', $poin->id) }}" method="post" class="mt-4">
                                    @csrf

                                    <div class="space-y-4">

                                        <div>
                                            <label class="text-gray-400 text-sm">No Anggota</label>
                                            <input type="text" value="{{ $poin->no_anggota }}" disabled
                                                class="w-full mt-1 px-3 py-2 bg-gray-800 text-gray-300 rounded-lg border border-gray-700 hover:cursor-not-allowed">
                                        </div>

                                        <div>
                                            <label class="text-gray-400 text-sm">Nama</label>
                                            <input type="text" value="{{ $poin->nama }}" disabled
                                                class="w-full mt-1 px-3 py-2 bg-gray-800 text-gray-300 rounded-lg border border-gray-700 hover:cursor-not-allowed">
                                        </div>

                                        <div>
                                            <label class="text-gray-400 text-sm">Pilih Opsi Point</label>
                                            <select name="poin" required
                                                class="w-full mt-1 px-3 py-2 bg-gray-800 text-white rounded-lg border border-gray-700 hover:cursor-pointer transition-all duration-200">

                                                <option value="">-- Pilih Opsi Point --</option>

                                                <option value="1">I1 (+100 poin)</option>
                                                <option value="2">I2 (+85 poin)</option>
                                                <option value="4">I3 (+75 poin)</option>
                                                <option value="4">I4 (+75 poin)</option>
                                                <option value="5">I5 (+65 poin)</option>
                                                <option value="6">I6 (+55 poin)</option>
                                                <option value="7">I7 (+45 poin)</option>
                                                <option value="8">I8 (+35 poin)</option>
                                                <option value="8">I9 (+35 poin)</option>
                                                <option value="9">I10 (+30 poin)</option>
                                                <option value="10">I11 (+25 poin)</option>
                                                <option value="12">I12 (+15 poin)</option>

                                                <hr>

                                                <option value="12">E1 (+15 poin)</option>
                                                <option value="8">E2 (+35 poin)</option>
                                                <option value="6">E3 (+55 poin)</option>
                                                <option value="7">E4 (+45 poin)</option>
                                                <option value="8">E5 (+35 poin)</option>
                                                <option value="8">E6 (+35 poin)</option>
                                                <option value="9">E7 (+30 poin)</option>
                                                <option value="10">E8 (+25 poin)</option>
                                                <option value="1">E9 (+100 poin)</option>
                                                <option value="2">E10 (+85 poin)</option>
                                                <option value="3">E11 (+80 poin)</option>
                                                <option value="3">E12 (+80 poin)</option>
                                                <option value="4">E13 (+75 poin)</option>
                                                <option value="5">E14 (+65 poin)</option>

                                                <hr>

                                                <option value="9">O1 (+30 poin)</option>
                                                <option value="9">O2 (+30 poin)</option>
                                                <option value="8">O3 (+35 poin)</option>
                                                <option value="10">O4 (+25 poin)</option>
                                                <option value="10">O5 (+25 poin)</option>
                                                <option value="11">O6 (+20 poin)</option>

                                            </select>
                                        </div>

                                    </div>

                                    <div class="flex justify-end gap-3 mt-6">
                                        <button type="button" onclick="closeModal('modalEdit{{ $poin->id }}')"
                                            class="px-4 py-2 bg-gray-600 hover:cursor-pointer hover:bg-gray-700 text-white rounded-lg transition duration-200">
                                            Batal
                                        </button>

                                        <button type="submit"
                                            class="px-4 py-2 bg-[#198754] hover:bg-[#146c43] text-white rounded-lg transition duration-200 hover:cursor-pointer">
                                            Submit
                                        </button>
                                    </div>
                                </form>

                            </div>
                        </div>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="w-full mt-6">
            <hr>
            <div class="mt-6 mx-4">
                <div>
                    <div>
                        {{ $poins->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
