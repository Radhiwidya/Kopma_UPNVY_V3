@extends('layout.master')
@section('judul')
    Keuangan | Simpanan
@endsection
@section('content')
    <h3 class=" text-3xl font-semibold mb-4 text-white"><i class="bi bi-piggy-bank" style="margin-right: 10px;"></i>SIMPANAN
        ANGGOTA</h3>
    <hr class=" border-t border-white/50">
    {{-- Konten --}}
    <div class=" bg-[#146841] rounded-2xl py-4 md:p-6 lg:py-6 px-4 lg:px-10 mt-6 mb-12 "> {{-- Done --}}

        <!-- Filter Angkatan -->
        <div class="w-full mb-3">
            <div class="flex flex-col md:flex-row md:justify-between gap-2">

                <!-- Kolom kiri: Filter angkatan -->
                <div class="flex flex-wrap justify-center md:justify-start gap-2">
                    <a href="{{ route('Keuangan.simpanan.index') }}"
                        class="px-4 py-2 border rounded-md text-sky-400 border-sky-400 hover:bg-sky-100 hover:text-sky-600 transition duration-200
                    {{ $angkatanFilter == '' ? 'bg-sky-500 text-white border-sky-500' : '' }}">
                        Semua
                    </a>

                    @foreach ($angkatanTahun as $angkatan)
                        <a href="{{ route('Keuangan.simpanan.index', ['filter' => $angkatan] + request()->only('search')) }}"
                            class="px-4 py-2 border rounded-md text-sky-400 border-sky-400 hover:bg-sky-100 hover:text-sky-600 transition duration-200
                        {{ $angkatanFilter == $angkatan ? 'bg-sky-500 text-white border-sky-500' : '' }}">
                            {{ $angkatan }}
                        </a>
                    @endforeach
                </div>

                <!-- Kolom kanan: Tombol sort -->
                <div class="flex flex-wrap justify-center md:justify-end gap-2">
                    <a href="{{ route('Keuangan.simpanan.index', array_merge(request()->except('sort'), ['sort' => 'terbanyak'])) }}"
                        class="px-4 py-2 border rounded-md text-sky-400 border-sky-400 hover:bg-sky-100 hover:text-sky-600 transition duration-200
                    {{ request('sort') === 'terbanyak' ? 'bg-sky-500 text-white border-sky-500' : '' }}">
                        Jumlah Terbanyak
                    </a>

                    <a href="{{ route('Keuangan.simpanan.index', array_merge(request()->except('sort'), ['sort' => 'tersedikit'])) }}"
                        class="px-4 py-2 border rounded-md text-sky-400 border-sky-400 hover:bg-sky-100 hover:text-sky-600 transition duration-200
                    {{ request('sort') === 'tersedikit' ? 'bg-sky-500 text-white border-sky-500' : '' }}">
                        Jumlah Tersedikit
                    </a>
                </div>

            </div>
        </div>

        <div class="inline-flex justify-between w-full bg-gray-500 px-4 py-2 rounded-t-xl">
            <div class="text-white">
                Simpanan Anggota
            </div>
            @include('layout._search')
        </div>
        @if ($search)
            <div class="mt-3 text-white" style="width: 97%;">
                Menampilkan hasil pencarian untuk: <strong>"{{ $search }}"</strong>
                ({{ $simpanans->total() }} hasil ditemukan)
            </div>
        @endif
        <div class="overflow-x-auto mt-3 rounded-b-xl shadow-lg">
            <table id="dataTable" class="min-w-max text-sm text-left text-gray-300">
                <thead class="text-sm uppercase bg-black text-white">
                    <tr>
                        <th class="px-6 py-4">No. Anggota</th>
                        <th class="px-6 py-4">Nama</th>
                        {{-- Loop untuk menampilkan tahun dari 2016 hingga tahun sekarang --}}
                        @php
                            $currentYear = date('Y'); // Mengambil tahun saat ini (misal: 2025)
                            $startYear = $currentYear - 4; // 8 tahun ke belakang termasuk tahun ini (misal: 2018)
                            $displayedYears = []; // Array untuk menyimpan tahun yang ditampilkan
                            for ($i = $startYear; $i <= $currentYear; $i++) {
                                echo "<th class='px-6 py-4'>$i</th>";
                                $displayedYears[] = $i; // Tambahkan tahun ke array
                            }
                        @endphp
                        <th class="px-6 py-4">SP</th>
                        <th class="px-6 py-4">SS</th>
                        <th class="px-6 py-4">SHU</th>
                        <th class="px-6 py-4">Total</th>
                        <th class="px-6 py-4">
                            <center>Aksi</center>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    {{-- Loop untuk menampilkan data anggota --}}
                    @foreach ($simpanans as $simpanan)
                        <tr class="border-b border-gray-700 odd:bg-[#212529] even:bg-[#181b1e] hover:bg-[#2b3035] transition duration-200">
                            <td class="px-6 py-4 text-white">{{ $simpanan->no_anggota }}</td>
                            <td class="px-6 py-4 text-white">{{ $simpanan->nama }}</td>
                            {{-- Loop untuk menampilkan data simpanan per tahun --}}
                            @foreach ($displayedYears as $year)
                                <td class="px-6 py-4 text-white">Rp. {{ number_format($simpanan->$year, 0, ',', '.') }}
                                </td>
                            @endforeach
                            <td class="px-6 py-4 text-white">Rp. {{ number_format($simpanan->sp, 0, ',', '.') }}</td>
                            <td class="px-6 py-4 text-white">Rp. {{ number_format($simpanan->ss, 0, ',', '.') }}</td>
                            <td class="px-6 py-4 text-white">Rp. {{ number_format($simpanan->shu, 0, ',', '.') }}</td>
                            <td class="px-6 py-4 text-white">Rp. {{ number_format($simpanan->total, 0, ',', '.') }}</td>
                            <td class="px-6 py-4 text-center inline-flex gap-1">
                                <!-- Tombol Edit -->
                                <button type="button" onclick="openModal('modalEdit{{ $simpanan->id }}')"
                                    class="flex px-3 py-2 text-sm font-medium text-white bg-yellow-500 rounded-lg hover:cursor-pointer hover:bg-yellow-600 transition duration-200 shadow-md">
                                    <i class="bi bi-pencil-square"></i>
                                </button>
                                <!-- Tombol WhatsApp -->
                                <button type="button" onclick="openModal('modalWA{{ $simpanan->id }}')"
                                    class="flex px-3 py-2 text-sm font-medium text-white bg-green-600 rounded-lg hover:cursor-pointer hover:bg-green-700 transition duration-200 shadow-md">
                                    <i class="bi bi-whatsapp"></i>
                                </button>
                            </td>
                        </tr>
                        <!-- Modal Kirim WA -->
                        <div id="modalWA{{ $simpanan->id }}"
                            class="fixed inset-0 z-50 hidden items-center justify-center backdrop-blur-sm bg-black/60">
                            <div
                                class="bg-[#1e2227] w-full max-w-2xl rounded-xl shadow-2xl 
                                flex flex-col max-h-[90vh] p-6">
                                <div class="modal-content">
                                    <div class="flex justify-between items-center border-b-2 border-white shrink-0 pb-4">
                                        <h2 class="text-xl font-semibold text-white">Kirim WA ke {{ $simpanan->nama }}</h2>
                                        <button onclick="closeModal('modalWA{{ $simpanan->id }}')"
                                            class="text-gray-400 hover:text-white text-xl hover:cursor-pointer transition-all duration-200">&times;</button>
                                    </div>
                                    <div class="overflow-y-auto no-scrollbar px-6 py-4">
                                        <label for="nominal" class="text-gray-400 text-sm">Masukkan Nominal:</label> <br>
                                        <input type="text" id="nominal{{ $simpanan->id }}"
                                            class="w-full mt-1 px-3 py-2 bg-gray-800 text-gray-300 rounded-lg border border-gray-700"
                                            placeholder="nominal tagihan" oninput="formatNominal(this)">
                                    </div>
                                    <div class="flex justify-end gap-3 mt-6">
                                        <button type="button" onclick="closeModal('modalWA{{ $simpanan->id }}')"
                                            class="px-4 py-2 bg-gray-600 hover:cursor-pointer hover:bg-gray-700 text-white rounded-lg transition duration-200">
                                            Batal
                                        </button>

                                        <button type="button"
                                            class="px-4 py-2 bg-[#198754] hover:bg-[#146c43] text-white rounded-lg transition duration-200 hover:cursor-pointer"
                                            onclick="sendWA('{{ $simpanan->no_wa }}','{{ $simpanan->nama }}','{{ $simpanan->id }}')">
                                            Kirim
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Modal Edit -->
                        <div id="modalEdit{{ $simpanan->id }}"
                            class="fixed inset-0 z-50 hidden items-center justify-center backdrop-blur-sm bg-black/60">
                            <div
                                class="bg-[#1e2227] w-full max-w-2xl rounded-xl shadow-2xl 
                                flex flex-col max-h-[90vh] p-6">
                                <div class="flex justify-between items-center border-b-2 border-white shrink-0 pb-4">
                                    <h2 class="text-xl font-semibold text-white">Ubah simpanan
                                        {{ $simpanan->nama }}</h2>
                                    <button onclick="closeModal('modalEdit{{ $simpanan->id }}')"
                                        class="text-gray-400 hover:text-white text-xl hover:cursor-pointer transition-all duration-200">&times;</button>
                                </div>
                                <div class="overflow-y-auto no-scrollbar px-6 py-4">
                                    <form action="{{ route('Keuangan.simpanan.update', $simpanan->id) }}" method="POST"
                                        class="mt-4 space-y-3">
                                        @csrf
                                        @method('PUT')
                                        <div class="space-y-4">
                                            <!-- Modal body -->
                                            <div class="space-y-4">
                                                <label class="text-gray-400 text-sm" for="no_anggota">No Anggota</label><br>
                                                <input type="text" name="no_anggota"
                                                    class="w-full mt-1 px-3 py-2 bg-gray-800 text-gray-300 rounded-lg border border-gray-700"
                                                    placeholder="No Anggota" value="{{ $simpanan->no_anggota }}" disabled>
                                                <label class="text-gray-400 text-sm" for="nama"
                                                    class="mt-3">Nama</label><br>
                                                <input type="text" name="nama"
                                                    class="w-full mt-1 px-3 py-2 bg-gray-800 text-gray-300 rounded-lg border border-gray-700"
                                                    placeholder="Nama" value="{{ $simpanan->nama }}" disabled>
                                                <label class="text-gray-400 text-sm" for="column"
                                                    class="form-label">Pilih Kolom yang akan
                                                    diupdate:</label><br>
                                                <select
                                                    class="w-full mt-1 px-3 py-2 bg-gray-800 text-white rounded-lg border border-gray-700 hover:cursor-pointer transition-all duration-200"
                                                    class="form-select" id="column" name="column" required>
                                                    <option value="">-- Pilih Kolom --</option>
                                                    @foreach ($columns as $key => $label)
                                                        <option value="{{ $key }}"
                                                            {{ old('column') == $key ? 'selected' : '' }}>
                                                            {{ $label }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                <div class="mb-3">
                                                    <label class="text-gray-400 text-sm" for="value"
                                                        class="form-label">
                                                        Nilai Perubahan:
                                                        <small class="text-muted">(Positif untuk menambah, negatif untuk
                                                            mengurangi)</small>
                                                    </label><br>
                                                    <!-- INPUT TAMPILAN -->
                                                    <input type="text" id="value_display{{ $simpanan->id }}"
                                                        class="w-full mt-1 px-3 py-2 bg-gray-800 text-gray-300 rounded-lg border border-gray-700"
                                                        placeholder="Contoh: 1.000 atau -500"
                                                        oninput="formatNominalDisplay(this, '{{ $simpanan->id }}')"
                                                        autocomplete="off">

                                                    <!-- INPUT ASLI YANG DIKIRIM -->
                                                    <input type="hidden" name="value" id="value{{ $simpanan->id }}"
                                                        required>
                                                    @error('value')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <!-- Modal footer -->
                                            <div class="flex justify-end gap-3 mt-6">
                                                <button type="button"
                                                    onclick="closeModal('modalEdit{{ $simpanan->id }}')"
                                                    class="px-4 py-2 bg-gray-600 hover:cursor-pointer hover:bg-gray-700 text-white rounded-lg transition duration-200">
                                                    Batal
                                                </button>

                                                <button type="submit"
                                                    class="px-4 py-2 bg-[#198754] hover:bg-[#146c43] text-white rounded-lg transition duration-200 hover:cursor-pointer">
                                                    Simpan
                                                </button>
                                            </div>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                    @endforeach
                    {{-- Pesan jika tidak ada data --}}
                    @if ($simpanans->isEmpty())
                        <tr>
                            <td class="px-6 py-4 text-white" colspan="{{ 2 + ($currentYear - 2016 + 1) + 4 + 1 }}"
                                class="text-center">Tidak ada
                                data
                                simpanan anggota.</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
        <div class="w-full mt-6">
            <hr>
            <div class="mt-6 mx-4">
                <div>
                    <div>
                        {{ $simpanans->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- Batas Konten --}}
@endsection
@section('script')
    <script>
        function formatNominalDisplay(input, id) {

            let raw = input.value;

            // izinkan hanya angka & 1 tanda minus di depan
            raw = raw.replace(/[^0-9-]/g, '');

            // jika hanya "-" → simpan dulu (jangan dihapus)
            if (raw === '-') {
                input.value = '-';
                document.getElementById('value' + id).value = '-';
                return;
            }

            let isNegative = raw.startsWith('-');
            raw = raw.replace('-', '');

            if (!raw) {
                input.value = '';
                document.getElementById('value' + id).value = '';
                return;
            }

            let formatted = new Intl.NumberFormat('id-ID').format(raw);

            if (isNegative) {
                formatted = '-' + formatted;
                raw = '-' + raw;
            }

            input.value = formatted;

            // kirim angka asli
            document.getElementById('value' + id).value = raw;
        }

        function formatNominal(input) {
            let value = input.value.replace(/\D/g, ""); // hanya angka
            if (!value) {
                input.value = "";
                return;
            }
            input.value = new Intl.NumberFormat('id-ID').format(value);
        }

        function sendWA(no_wa, nama, id) {
            let nominal = document.getElementById('nominal' + id).value;
            if (!nominal) {
                alert("Nominal wajib diisi!");
                return;
            }

            // Bersihkan nomor WA → hapus 0 depan kalau ada
            if (no_wa.startsWith("0")) {
                no_wa = no_wa.substring(1);
            }
            let phone = "62" + no_wa;

            // Isi pesan
            let message = `*[INFO BIDANG KEUANGAN]*

Halo *${nama}*, sobat KOPMA UPNVY!
Kami mengingatkan kamu untuk membayar simpanan wajib per bulannya, ya. Simpanan ini berpengaruh ke modal koperasi dan menjadi dasar perhitungan SHU kamu loh.

Yuk, bantu keberlanjutan KOPMA kita dengan tetap rutin membayar.

Nominal simpanan wajib: *Rp ${nominal}*
Transfer ke rekening:
Bank BRI 138001000043562 a.n. Kopma UPN Veteran Yogyakarta

Untuk *transparansi simpanan* ada di sini:
https://bit.ly/TransparansiSimpananKOPMA2026

Jangan lupa untuk *konfirmasi pembayaran dengan format:*
NAMA LENGKAP_ANGKATAN
ke wa.me/6281476649245 (Dinda)

Kalau ada kendala dan hal yang ditanyakan, bisa chat aja ya

Terima kasih atas partisipasimu dan semangat terus jadi bagian dari KOPMA UPNVY.`;


            // Buka WhatsApp
            let url = `https://wa.me/${phone}?text=${encodeURIComponent(message)}`;
            window.open(url, '_blank');

            // Tutup modal setelah klik kirim
            let modal = document.getElementById('waModal' + id);
            let modalInstance = bootstrap.Modal.getInstance(modal);
            modalInstance.hide();
        }
    </script>
@endsection
