@extends('layout.master')
@section('judul')
    Setting
@endsection
@section('content')
    <h3 class=" text-3xl font-semibold mb-4 text-white"><i class="fa-solid fa-gear" style="margin-right: 10px;"></i>PENGATURAN
    </h3>
    <hr class=" border-t border-white/50">
            <div class="overflow-y-auto no-scrollbar px-4 w-full">
                <form action="{{ route('user.update') }}" method="POST" class="mt-4 space-y-3">
                    @csrf
                    @method('PUT')
                    <div class="space-y-4 w-full lg:w-1/3">
                        <div class="mb-3">
                            <label for="username" class="text-white text-sm">Username</label>
                            <br>
                            <input type="text" name="username"
                                class="w-full mt-1 px-3 py-2 bg-gray-700 text-gray-300 rounded-lg border border-gray-700"
                                placeholder="Username" value="{{ Auth::user()->username }}">
                        </div>
                        <div class="mb-3">
                            <label for="password" class="text-white text-sm">Password baru</label>
                            <br>
                            <input type="password" name="password"
                                class="w-full mt-1 px-3 py-2 bg-gray-700 text-gray-300 rounded-lg border border-gray-700"
                                placeholder="Password baru">
                        </div>

                        <div class="flex gap-3 mt-6">
                            <button type="submit"
                                class="px-4 py-2 bg-yellow-500 hover:bg-yellow-600 text-white rounded-lg transition duration-200 hover:cursor-pointer">
                                Update
                            </button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
@endsection
