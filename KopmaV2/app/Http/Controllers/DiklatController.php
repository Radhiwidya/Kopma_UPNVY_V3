<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use Illuminate\Http\Request;

class DiklatController extends Controller
{
    public function index()
    {
        return view('public.diklat');
    }
    public function update(Request $request)
    {
        $request->validate([
            'no_anggota' => 'required'
        ]);

        try {
            $anggota = Anggota::where('no_anggota', $request->no_anggota)->first();

            if (!$anggota) {
                return back()->with('error', 'Data tidak ditemukan');
            }

            $anggota->update([
                'diklat' => 'sudah'
            ]);

            return redirect()->route('diklat.success');
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan');
        }
    }
    public function cek(Request $request)
    {
        $request->validate([
            'no_anggota' => 'required'
        ]);

        $anggota = Anggota::where('no_anggota', $request->no_anggota)->first();

        if (!$anggota) {
            return back()->with('error', 'No anggota tidak ditemukan');
        }

        return back()->with('anggota', $anggota);
    }
}