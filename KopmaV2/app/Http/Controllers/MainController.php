<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\Pendaftar;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index(): View
    {
        return view('index');
    }
    public function dashboard(): View
    {
        $jumlahAnggota  = Anggota::count();
        $jumlahDaftar   = Pendaftar::count();
        $jumlahDiterima = Pendaftar::where('status', 'Diterima')->count();
        return view('admin.dashboard', compact('jumlahAnggota','jumlahDaftar', 'jumlahDiterima'));
    }
}