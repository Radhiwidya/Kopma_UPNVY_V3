<div class="flex justify-between items-center w-full mb-4">
    <div class="flex text-3xl font-semibold text-white">
        <i class="bi bi-person-add" style="margin-right: 10px;"></i>PENDAFTARAN
    </div>
    <div class="flex self-center">
        <a href="{{ route('PSDA.form') }}" target="_blank"><button
                class="px-2.5 py-1.5 md:px-4 md:py-2 rounded-md md:rounded-lg bg-transparent border-2 border-blue-500 text-blue-500 text-[10px] md:text-sm hover:bg-blue-500 hover:text-white hover:cursor-pointer transition-all duration-200 ">Form
                Pendaftaran</button></a>
    </div>
</div>

<hr class=" border-t border-white/50">
<!-- Konten -->
<div class=" bg-[#146841] rounded-2xl py-4 md:p-6 lg:py-6 px-4 lg:px-10 mt-6 mb-12 "> {{-- Done --}}
    <div class="inline-flex justify-between w-full bg-gray-500 px-4 py-2 rounded-t-xl">
        <div class="inline-flex gap-2">
            <div>
                <a href="{{ route('PSDA.baru') }}"
                    class="{{ request()->is('PSDA/registrant') ? 'pt-1 px-2 pb-5 bg-[#146841] text-sm text-white rounded-t-lg font-bold hover:cursor-default' : 'pt-1 px-2 pb-5 hover:bg-[#146841] hover:font-bold rounded-t-lg text-white text-sm ' }}">Pendaftar</a>
            </div>
            <div>
                <a href="{{ route('PSDA.ditolak') }}"
                    class="{{ request()->is('PSDA/rejected') ? 'pt-1 px-2 pb-5 bg-[#146841] text-sm text-white rounded-t-lg font-bold hover:cursor-default' : 'pt-1 px-2 pb-5 hover:bg-[#146841] hover:font-bold rounded-t-lg text-white text-sm ' }}">Ditolak</a>
            </div>
            <div>
                <a href="{{ route('PSDA.diterima') }}"
                    class="{{ request()->is('PSDA/accepted') ? 'pt-1 px-2 pb-5 bg-[#146841] text-sm text-white rounded-t-lg font-bold hover:cursor-default' : 'pt-1 px-2 pb-5 hover:bg-[#146841] hover:font-bold rounded-t-lg text-white text-sm ' }}">Diterima</a>
            </div>
        </div>
        @include('layout._search')
    </div>
    @if ($search)
        <div class="mt-3 text-white" style="width: 97%;">
            Menampilkan hasil pencarian untuk: <strong>"{{ $search }}"</strong>
            ({{ $pendaftars->total() }} hasil ditemukan)
        </div> {{-- Done --}}
    @endif
