<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    @vite('resources/css/app.css')
    <title>@yield('judul')</title>
    <link rel="icon" href="{{ asset('img/Icon.png') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="{{ asset('css/style1.css') }}">
</head>
<style>
    * {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .submenu.open {
        max-height: 500px;
    }

    .rotate {
        transform: rotate(180deg);
    }

    /* Hilangkan scrollbar tapi tetap bisa scroll */
    .no-scrollbar::-webkit-scrollbar {
        display: none;
    }

    .no-scrollbar {
        -ms-overflow-style: none;
        /* IE & Edge */
        scrollbar-width: none;
        /* Firefox */
    }
    @media (min-width: 1024px) {
        .sidebar-desktop-open {
            transform: translateX(0);
        }

        .sidebar-desktop-close {
            transform: translateX(-100%);
        }
        .content-open {
            margin-left: 16rem; /* ml-64 */
            margin-right: 1rem; /* mr-4 */
        }

        .content-close {
            margin-left: 1rem;
            margin-right: 1rem;
        }
    }
</style>

<body class="bg-black">
    @include('layout._navbar')
    @include('layout._sidebar')
    <div id="main-content"
    class="mt-20 transition-all duration-300 ease-in-out
    mx-4 lg:ml-64 lg:mr-4">    
    <div class="pt-4"></div>

        @if (session('success') || session('error'))
            <div id="alert-box"
                class="fixed top-20 right-6 z-50 px-6 py-3 rounded-xl shadow-2xl text-white
                {{ session('success') ? 'bg-green-700' : 'bg-red-600' }}
                transform transition-all duration-500 ease-in-out opacity-0 translate-y-[-20px]">

                <div class="flex items-center gap-3">
                    <span class=" font-normal">
                        {{ session('success') ?? session('error') }}
                    </span>
                    <button onclick="closeAlert()" class="text-white/80 hover:text-white text-lg leading-none hover:cursor-pointer transition">
                        &times;
                    </button>
                </div>
            </div>
        @endif

        @yield('content')
    </div>

    {{-- JS Search Loading --}}
    <script>
        document.addEventListener("DOMContentLoaded", function() {

            const searchInput = document.getElementById("searchInput");
            const searchSpinner = document.getElementById("searchSpinner");
            const searchIcon = document.getElementById("searchIcon");
            let debounceTimer;

            searchInput.addEventListener("input", function() {

                clearTimeout(debounceTimer);

                debounceTimer = setTimeout(() => {

                    const query = searchInput.value.trim();

                    searchSpinner.classList.remove("hidden");
                    searchIcon.classList.add("hidden");

                    const url = new URL(window.location.href);
                    url.searchParams.set("search", query);

                    window.location.href = url.toString();

                }, 1000);
            });

        });
    </script>

    {{-- JS Open Modal --}}
    <script>
        function openModal(id) {
            let modal = document.getElementById(id);
            if (modal) {
                modal.classList.remove('hidden');
                modal.classList.add('flex');
            }
        }

        function closeModal(id) {
            let modal = document.getElementById(id);
            if (modal) {
                modal.classList.add('hidden');
                modal.classList.remove('flex');
            }
        }

        window.addEventListener('click', function(e) {
            if (e.target.classList.contains('backdrop-blur-sm')) {
                e.target.classList.add('hidden');
                e.target.classList.remove('flex');
            }
        });
    </script>

    {{-- JS Alert --}}
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const alertBox = document.getElementById("alert-box");

            if (alertBox) {
                setTimeout(() => {
                    alertBox.classList.remove("opacity-0", "translate-y-[-20px]");
                    alertBox.classList.add("opacity-100", "translate-y-0");
                }, 100);

                setTimeout(() => {
                    closeAlert();
                }, 3000);
            }
        });

        function closeAlert() {
            const alertBox = document.getElementById("alert-box");
            if (alertBox) {
                alertBox.classList.remove("opacity-100", "translate-y-0");
                alertBox.classList.add("opacity-0", "translate-y-[-20px]");
                setTimeout(() => {
                    alertBox.remove();
                }, 500);
            }
        }
    </script>

    {{-- JS Dropdown Sidebar --}}
    <script>
        document.addEventListener("DOMContentLoaded", function() {

            const toggles = document.querySelectorAll(".menu-toggle");

            toggles.forEach((btn) => {
                btn.addEventListener("click", function() {

                    const item = btn.closest(".sidebar-item");
                    const submenu = item.querySelector(".submenu");
                    const arrow = item.querySelector(".arrow");

                    // Tutup semua menu lain (accordion)
                    document.querySelectorAll(".submenu").forEach(el => {
                        if (el !== submenu) el.classList.remove("open");
                    });

                    document.querySelectorAll(".arrow").forEach(el => {
                        if (el !== arrow) el.classList.remove("rotate");
                    });

                    // Toggle menu sekarang
                    submenu.classList.toggle("open");
                    arrow.classList.toggle("rotate");
                });
            });

            // Auto open menu sesuai halaman aktif
            const current = window.location.pathname;

            document.querySelectorAll(".submenu a").forEach(link => {
                if (link.getAttribute("href") === current) {
                    const submenu = link.closest(".submenu");
                    const arrow = submenu.parentElement.querySelector(".arrow");

                    submenu.classList.add("open");
                    arrow.classList.add("rotate");
                }
            });

        });
    </script>

    {{-- JS Side Bar --}}
    <script>
        const toggleBtn = document.getElementById("toggle-sidebar");
        const sidebar = document.getElementById("sidebar");
        const overlay = document.getElementById("overlay");
        const content = document.getElementById("main-content");
    
        let isOpen = true;
    
        function isMobile() {
            return window.innerWidth < 1024;
        }
    
        function openSidebar() {
            if (isMobile()) {
                // MOBILE → sidebar turun
                sidebar.classList.remove("-translate-y-full");
                sidebar.classList.add("translate-y-0");
                overlay.classList.remove("hidden");
    
                // KONTEN tetap mx-4
                content.classList.remove("content-open");
                content.classList.add("content-close");
    
            } else {
                // DESKTOP → sidebar buka
                sidebar.classList.remove("sidebar-desktop-close");
                sidebar.classList.add("sidebar-desktop-open");
    
                content.classList.remove("content-close");
                content.classList.add("content-open");
            }
            isOpen = true;
        }
    
        function closeSidebar() {
            if (isMobile()) {
                // MOBILE → sidebar naik
                sidebar.classList.remove("translate-y-0");
                sidebar.classList.add("-translate-y-full");
                overlay.classList.add("hidden");
    
                // KONTEN tetap mx-4
                content.classList.remove("content-open");
                content.classList.add("content-close");
    
            } else {
                // DESKTOP → sidebar tutup
                sidebar.classList.remove("sidebar-desktop-open");
                sidebar.classList.add("sidebar-desktop-close");
    
                content.classList.remove("content-open");
                content.classList.add("content-close");
            }
            isOpen = false;
        }
    
        toggleBtn.addEventListener("click", () => {
            isOpen ? closeSidebar() : openSidebar();
        });
    
        overlay.addEventListener("click", closeSidebar);
    
        window.addEventListener("resize", () => {
            if (!isMobile()) {
                overlay.classList.add("hidden");
    
                sidebar.classList.remove("-translate-y-full", "translate-y-0");
                sidebar.classList.remove("sidebar-desktop-close");
                sidebar.classList.add("sidebar-desktop-open");
    
                content.classList.remove("content-close");
                content.classList.add("content-open");
    
                isOpen = true;
            } else {
                sidebar.classList.remove("sidebar-desktop-open", "sidebar-desktop-close");
                sidebar.classList.add("-translate-y-full");
    
                // MOBILE selalu mx-4
                content.classList.remove("content-open");
                content.classList.add("content-close");
    
                isOpen = false;
            }
        });
    </script>
    @yield('script')
</body>

</html>
