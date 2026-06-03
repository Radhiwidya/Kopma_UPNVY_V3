<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Arsip;

class ArsipController extends Controller
{
   public function index(Request $request, $bidang)
{
    $search = $request->search;

    $arsips = Arsip::where('bidang', strtoupper($bidang))

        ->when($search, function ($query) use ($search) {

            $query->where('judul', 'like', '%' . $search . '%');

        })

        ->latest()

        ->get();

    return view('arsip.index', compact(
        'arsips',
        'bidang',
        'search'
    ));
}

    public function store(Request $request, $bidang)
{
    $request->validate([
        'judul' => 'required',
        'link' => 'required',
        'status' => 'required'
    ]);

    $jumlah = Arsip::count() + 1;

    Arsip::create([
        'nomor_arsip' => 'ARS-' . str_pad($jumlah, 4, '0', STR_PAD_LEFT),
        'judul' => $request->judul,
        'bidang' => strtoupper($bidang),
        'status' => $request->status,
        'link' => $request->link
    ]);

    return back();
}
    public function update(Request $request, $id)
{
    $arsip = Arsip::findOrFail($id);

    $arsip->judul = $request->judul;
    $arsip->status = $request->status;
    $arsip->link = $request->link;

    $arsip->save();

    return back()->with('success', 'Arsip berhasil diperbarui');
}




public function destroy($id)
{
    $arsip = Arsip::findOrFail($id);

    $arsip->delete();

    return back()->with('success', 'Arsip berhasil dihapus');
}
}