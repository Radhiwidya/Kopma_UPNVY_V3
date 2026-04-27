    <div
        class="flex w-36 items-center md:w-56 bg-white rounded-md overflow-hidden border border-gray-200 focus-within:ring-1 focus-within:ring-black transition">
        <input type="text" id="searchInput" placeholder="Cari Data..." value="{{ $search }}"
            class="flex-1 py-0.5 px-2 md:py-1 text-sm text-gray-700 placeholder-gray-400 focus:outline-none">
        <div id="searchSpinner" class="hidden mr-2">
            <svg class="animate-spin h-5 w-5 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none"
                viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                    stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8z">
                </path>
            </svg>
        </div>
        <div class="pr-2 text-gray-500">
            <i id="searchIcon" class="fas fa-search"></i>
        </div>
    </div>