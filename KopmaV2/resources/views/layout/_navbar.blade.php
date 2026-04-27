
<nav class="fixed inline-flex left-0 top-0 w-full bg-[#198750] z-50">
    <div class=" flex gap-3 px-3 lg:px-6 py-3 w-full items-center">
        <div id="toggle-sidebar" class="toggle-sidebar text-2xl hover:cursor-pointer text-white hover:text-white/50">
            <i class="fas fa-bars"></i>
        </div>
        <div>
            <a href="">
                <img src="{{ asset('img/Logo.png') }}" class="w-[200px]" alt="">
            </a>
        </div>
        <div class="ml-auto relative">
            @auth
            <div class=" inline-flex items-center">
                <div class="text-white/60">
                    <span class=" font-normal">
                        {{ Auth::user()->username }}
                    </span>
                </div>
            </div>
            @endauth
        </div>
    </div>
</nav>
<div id="overlay" class="fixed inset-0 bg-black/40 backdrop-blur-sm z-30 hidden lg:hidden"></div>