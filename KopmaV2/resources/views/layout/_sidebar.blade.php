<div id="sidebar"
    class="pt-16 lg:w-60 w-full lg:h-screen h-auto fixed top-0 left-0 text-start bg-[#222]
    transform transition-all duration-300 ease-in-out
    sidebar-desktop-open
    -translate-y-full lg:translate-y-0 z-40">
    <a href="/dashboard">
        <button
            class="hover:bg-[#198750] hover:cursor-pointer mt-4 py-3.5 text-left px-4 transition-all text-white w-full"><i
                class="w-6 fa-solid fa-gauge"></i>
            Dashboard</button>
    </a>

    @auth
        {{-- Menu Pengembangan Teknologi --}}
        @if (Auth::user()->role === 'PT' || Auth::user()->role === 'ketua')
            <div class="sidebar-item">
                <button
                    class="menu-toggle text-base text-start w-full flex justify-between items-center text-white px-4 py-3.5 hover:bg-[#198750] hover:cursor-pointer transition-all">
                    <span><i class="w-6 fa-solid bi bi-cpu"></i> Teknologi</span>
                    <i class="fa-solid fa-chevron-down arrow transition-transform duration-300"></i>
                </button>
                <div class="submenu max-h-0 overflow-hidden -mx-2 px-2 bg-[#FFFFFF0D] transition-all duration-300 text-base">
                    @if (Auth::user()->role === 'PT')
                        <a href="{{ route('PT.pusat-akun.index') }}"
                            class="block pl-12 text-base py-3 text-white hover:bg-[#198750] transition-all"
                            style="text-decoration: none">Pusat Akun</a>
                    @endif
                    <a href="{{ route('arsip.index', 'Teknologi') }}" class="block pl-12 text-base py-3 text-white hover:bg-[#198750] transition-all"
                        style="text-decoration: none">Arsip</a>
                </div>
            </div>
        @endif

        {{-- Menu PSDA --}}
        @if (Auth::user()->role === 'psda' || Auth::user()->role === 'ketua' || Auth::user()->role === 'PT')
            <div class="sidebar-item ">
                <button
                    class="menu-toggle text-base text-start w-full flex justify-between items-center text-white px-4 py-3.5 hover:bg-[#198750] hover:cursor-pointer transition-all">
                    <span><i class="w-6 fa-solid fa-users"></i> PSDA</span>
                    <i class="fa-solid fa-chevron-down arrow transition-transform duration-300"></i>
                </button>
                <div
                    class="submenu max-h-0 overflow-hidden -mx-2 px-2 bg-[#FFFFFF0D] transition-all duration-300 text-base">
                    <a href="{{ route('PSDA.anggota.index') }}"
                        class="block pl-12 text-base py-3 text-white hover:bg-[#198750] transition-all"
                        style="text-decoration: none">Data Anggota</a>
                    <a href="{{ route('PSDA.poin') }}"
                        class="block pl-12 text-base py-3 text-white hover:bg-[#198750] transition-all"
                        style="text-decoration: none">Point Keaktifan</a>
                    <a href="{{ route('PSDA.baru') }}"
                        class="block pl-12 text-base py-3 text-white hover:bg-[#198750] transition-all"
                        style="text-decoration: none">Pendaftaran</a>
                    <a href="{{ route('arsip.index', 'PSDA') }}" class="block pl-12 text-base py-3 text-white hover:bg-[#198750] transition-all"
                        style="text-decoration: none">Arsip</a>
                </div>
            </div>
        @endif

        {{-- Menu Keuangan --}}
        @if (Auth::user()->role === 'keuangan' || Auth::user()->role === 'ketua' || Auth::user()->role === 'PT')
            <div class="sidebar-item">
                <button
                    class="menu-toggle text-base text-start w-full flex justify-between items-center text-white px-4 py-3.5 hover:bg-[#198750] hover:cursor-pointer transition-all">
                    <span><i class="w-6 fa-solid fa-dollar-sign"></i> Keuangan</span>
                    <i class="fa-solid fa-chevron-down arrow transition-transform duration-300"></i>
                </button>

                <div
                    class="submenu max-h-0 overflow-hidden -mx-2 px-2 bg-[#FFFFFF0D] transition-all duration-300 text-base">
                    <a href="{{ route('Keuangan.simpanan.index') }}"
                        class="block pl-12 text-base py-3 text-white hover:bg-[#198750] transition-all"
                        style="text-decoration: none">Simpanan</a>
                    <a href="{{ route('Keuangan.bukti') }}"
                        class="block pl-12 text-base py-3 text-white hover:bg-[#198750] transition-all"
                        style="text-decoration: none">Bukti Pendaftaran</a>
                    <a href="{{ route('PSDA.poin') }}"
                        class="block pl-12 text-base py-3 text-white hover:bg-[#198750] transition-all"
                        style="text-decoration: none">Point Keaktifan</a>
                    <a href="{{ route('arsip.index', 'Keuangan') }}" class="block pl-12 text-base py-3 text-white hover:bg-[#198750] transition-all"
                        style="text-decoration: none">Arsip</a>
                </div>
            </div>
        @endif

        {{-- Menu Usaha --}}
        @if (Auth::user()->role === 'usaha' || Auth::user()->role === 'ketua' || Auth::user()->role === 'PT')
            <div class="sidebar-item">
                <button
                    class="menu-toggle text-base text-start w-full flex justify-between items-center text-white px-4 py-3.5 hover:bg-[#198750] hover:cursor-pointer transition-all">
                    <span><i class="w-6 fa-solid fa-shop"></i> Usaha</span>
                    <i class="fa-solid fa-chevron-down arrow transition-transform duration-300"></i>
                </button>

                <div
                    class="submenu max-h-0 overflow-hidden -mx-2 px-2 bg-[#FFFFFF0D] transition-all duration-300 text-base">
                    <a href="{{ route('arsip.index', 'Usaha') }}" class="block pl-12 text-base py-3 text-white hover:bg-[#198750] transition-all"
                        style="text-decoration: none">Arsip</a>
                </div>
            </div>
        @endif

        {{-- Menu Adminhum --}}
        @if (Auth::user()->role === 'adminhum' || Auth::user()->role === 'ketua' || Auth::user()->role === 'PT')
            <div class="sidebar-item">
                <button
                    class="menu-toggle text-base text-start w-full flex justify-between items-center text-white px-4 py-3.5 hover:bg-[#198750] hover:cursor-pointer transition-all">
                    <span><i class="w-6 fa-solid fa-pen"></i> Adminhum</span>
                    <i class="fa-solid fa-chevron-down arrow transition-transform duration-300"></i>
                </button>

                <div
                    class="submenu max-h-0 overflow-hidden -mx-2 px-2 bg-[#FFFFFF0D] transition-all duration-300 text-base">
                    <a href="{{ route('arsip.index', 'Adminhum') }}" class="block pl-12 text-base py-3 text-white hover:bg-[#198750] transition-all"
                        style="text-decoration: none">Arsip</a>
                </div>
            </div>
        @endif

        {{-- Menu Pengawas --}}
        @if (Auth::user()->role === 'pengawas' || Auth::user()->role === 'ketua' || Auth::user()->role === 'PT')
            <div class="sidebar-item">
                <button
                    class="menu-toggle text-base text-start w-full flex justify-between items-center text-white px-4 py-3.5 hover:bg-[#198750] hover:cursor-pointer transition-all">
                    <span><i class="w-6 fa-solid fa-shield"></i> Pengawas</span>
                    <i class="fa-solid fa-chevron-down arrow transition-transform duration-300"></i>
                </button>

                <div
                    class="submenu max-h-0 overflow-hidden -mx-2 px-2 bg-[#FFFFFF0D] transition-all duration-300 text-base">
                    <a href="{{ route('arsip.index', 'Pengawas') }}" class="block pl-12 text-base py-3 text-white hover:bg-[#198750] transition-all"
                        style="text-decoration: none">Arsip</a>
                </div>
            </div>
        @endif

        {{-- Menu Personalia --}}
        @if (Auth::user()->role === 'personalia' || Auth::user()->role === 'ketua' || Auth::user()->role === 'PT')
            <div class="sidebar-item">
                <button
                    class="menu-toggle text-base text-start w-full flex justify-between items-center text-white px-4 py-3.5 hover:bg-[#198750] hover:cursor-pointer transition-all">
                    <span><i class="w-6 fa-solid fa-user"></i> Personalia</span>
                    <i class="fa-solid fa-chevron-down arrow transition-transform duration-300"></i>
                </button>

                <div
                    class="submenu max-h-0 overflow-hidden -mx-2 px-2 bg-[#FFFFFF0D] transition-all duration-300 text-base">
                    <a href="{{ route('arsip.index', 'Personalia') }}" class="block pl-12 text-base py-3 text-white hover:bg-[#198750] transition-all"
                        style="text-decoration: none">Arsip</a>
                </div>
            </div>
        @endif

        {{-- Menu Medkraf --}}
        @if (Auth::user()->role === 'PT' || Auth::user()->role === 'ketua' || Auth::user()->role === 'medkraf')
            <div class="sidebar-item">
                <button
                    class="menu-toggle text-base text-start w-full flex justify-between items-center text-white px-4 py-3.5 hover:bg-[#198750] hover:cursor-pointer transition-all">
                    <span><i class="w-6 fa-solid bi bi-camera-fill"></i> Medkraf</span>
                    <i class="fa-solid fa-chevron-down arrow transition-transform duration-300"></i>
                </button>

                <div
                    class="submenu max-h-0 overflow-hidden -mx-2 px-2 bg-[#FFFFFF0D] transition-all duration-300 text-base">
                    <a href="{{ route('arsip.index', 'Medkraf') }}" class="block pl-12 text-base py-3 text-white hover:bg-[#198750] transition-all"
                        style="text-decoration: none">Arsip</a>
                </div>
            </div>
        @endif
        <a href="/admin/setting" class="text-white w-96" style="text-decoration: none;">
            <div class=" hover:bg-[#198750] hover:cursor-pointer text-start px-4 py-3 w-auto transition-all">
                <i class="w-6 fas fa-gear"></i> Pengaturan
            </div>
        </a>
        <a href="#" class="text-white w-96" style="text-decoration: none;"
            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <div class=" hover:bg-[#198750] hover:cursor-pointer text-start px-4 py-3 w-auto transition-all">
                <i class="w-6 fas fa-sign-out-alt"></i> Logout
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
        </a>
    @endauth

    <hr class=" border-t border-white/50 my-4">
    <center>
        <p class=" text-xs text-white/50">
            App Version : 
            @include('layout._app-version')
        </p>
    </center>
</div>
