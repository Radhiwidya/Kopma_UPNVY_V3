<div class="card-header text-white bg-secondary">
    <div class="row">
        <div class="col">
            <a href="/u1" class="select1">Lap<span class="input">oran</span> Tahunan</a>
            <a href="/u2" class="select2">Lap<span class="input">oran</span> Usaha</a>
            <a href="" class="select2">Update Harga</a>
        </div>
        <div class="col input-group input" style="height:100%;">
            <input type="text" id="searchInput" placeholder="Cari Data..." value=""
                style="border:none; border-radius:5px 0px 0px 5px;">
            <div class="input-group-text">
                <div id="searchSpinner" class="spinner-border spinner-border-sm d-none" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
                <i id="searchIcon" class="fas fa-search"></i>
            </div>
            {{-- @if ($search)
                <a href="{{ url()->previous() }}">
                    <button class="reset-search">
                        <i class="fas fa-times"></i> Reset
                    </button>
                </a>
            @endif --}}
        </div>
    </div>
</div>

{{-- @if ($search)
    <div class="mt-3" style="width: 97%;">
        Menampilkan hasil pencarian untuk: <strong>"{{ $search }}"</strong>
        ({{ $pendaftars->total() }} hasil ditemukan)
    </div>
@endif --}}
