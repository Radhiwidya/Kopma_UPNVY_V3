<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('img/Icon.png') }}">
    @vite('resources/css/app.css')
    <title>KOPMA UPNVY</title>
</head>

<body>
    <!--Navbar-->
    <nav class=" inline-flex absolute top-0 w-full bg-[#198750] z-50">
        <div class=" flex justify-between px-3 lg:px-28 py-3 w-full items-center">
            <div>
                <a href="">
                    <img src="{{ asset('img/Logo.png') }}" class="w-[200px]" alt="">
                </a>
            </div>
            {{-- Desktop Mode --}}
            <div class="hidden md:block">
                <ul class="flex gap-1 text-white font-normal text-base">
                    <li><a href="/pendaftaran" class="py-2 px-3 text-white/70 hover:text-white rounded-lg hover:bg-white/10 transition">Pendaftaran</a>
                    </li>
                    <li><a href="/pengumuman" class="py-2 px-3 text-white/70 hover:text-white rounded-lg hover:bg-white/10 transition">Pengumuman</a>
                    </li>
                    <li><a href="/cek-no-anggota" class="py-2 px-3 text-white/70 hover:text-white rounded-lg hover:bg-white/10 transition">Cek No.
                            Anggota</a></li>
                    <li><span>|</span></li>
                    <li><a href="/login"
                            class="font-bold py-2 px-3 rounded-lg hover:text-white/70 transition">Login</a></li>
                </ul>
            </div>

            <!-- Icon Mobile Mode -->
            <button id="menuBtn" class="md:hidden text-white">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
        </div>

        <!-- Dropdown Mobile Mode -->
        <div id="mobileMenu"
            class="md:hidden absolute top-full left-0 w-full bg-[#198750] overflow-hidden max-h-0 opacity-0 -translate-y-3 transition-all duration-300 ease-in-out">

            <ul class="flex flex-col text-white text-base py-2">
                <li><a href="/pendaftaran" class="block w-full py-3 px-4 hover:bg-white/10">Pendaftaran</a></li>
                <li><a href="/pengumuman" class="block w-full py-3 px-4 hover:bg-white/10">Pengumuman</a></li>
                <li><a href="/cek-no-anggota" class="block w-full py-3 px-4 hover:bg-white/10">Cek No. Anggota</a></li>
                <li><a href="/login" class="block w-full py-3 px-4 font-bold hover:bg-white/10">Login</a></li>
            </ul>
        </div>
    </nav>
    <!--Batas Navbar-->
    <!-- Konten -->
    <div class=" flex h-[100vh] bg-[#7BB277] items-center">
        <center>
            <video src="{{ asset('img/bg.mp4') }}" class=" w-10/12 md:w-1/2" alt="Kopma" autoplay muted loop></video>
        </center>
    </div>
    <!-- Batas Konten -->


    {{-- JavaScript --}}
    <script>
        const btn = document.getElementById("menuBtn");
        const menu = document.getElementById("mobileMenu");

        let open = false;

        btn.addEventListener("click", (e) => {
            e.stopPropagation();
            open = !open;

            if (open) {
                menu.style.maxHeight = menu.scrollHeight + "px";
                menu.classList.remove("opacity-0", "-translate-y-3");
                menu.classList.add("opacity-100", "translate-y-0");
            } else {
                menu.style.maxHeight = "0px";
                menu.classList.add("opacity-0", "-translate-y-3");
                menu.classList.remove("opacity-100", "translate-y-0");
            }
        });

        document.addEventListener("click", (e) => {
            if (!menu.contains(e.target) && !btn.contains(e.target)) {
                open = false;
                menu.style.maxHeight = "0px";
                menu.classList.add("opacity-0", "-translate-y-3");
                menu.classList.remove("opacity-100", "translate-y-0");
            }
        });
    </script>

</body>
<footer class="absolute bottom-0 w-full bg-[#198750] text-center text-white text-xs font-bold">
    <div class="py-6">
        <p>Hak Cipta &copy; {{ date('Y') }} Kopma UPN "Veteran" Yogyakata. <span class=" hidden md:inline">All
                rights reserved.</span></p>
    </div>
</footer>

</html>
