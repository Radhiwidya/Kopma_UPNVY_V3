<?php

namespace App\Http\Controllers;

use App\Models\Pendaftar;
use App\Models\Simpanan;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KeuanganController extends Controller
{
    public function index(Request $request): View
    {
        $search = $request->get('search');
        $angkatanFilter = $request->get('filter');
        $sort = $request->get('sort');
        $simpanans = Simpanan::query()
            ->when($search, function ($query, $search) {
                return $query->where('no_anggota', 'like', "%{$search}%")
                    ->orWhere('nama', 'like', "%{$search}%");
            })
            ->when($angkatanFilter, function ($query, $angkatanFilter) {
                return $query->whereRaw("SUBSTRING_INDEX(SUBSTRING_INDEX(no_anggota, '.', 2), '.', -1) = ?", [$angkatanFilter]);
            })
            ->when($sort === 'terbanyak', function ($query) {
                return $query->orderBy('total', 'desc');
            })
            ->when($sort === 'tersedikit', function ($query) {
                return $query->orderBy('total', 'asc');
            }, function ($query) {
                return $query->orderBy('id', 'desc');
            })
            ->paginate(20)
            ->withQueryString();
        $columns = [
            '2016' => 'Tahun 2016',
            '2017' => 'Tahun 2017',
            '2018' => 'Tahun 2018',
            '2019' => 'Tahun 2019',
            '2020' => 'Tahun 2020',
            '2021' => 'Tahun 2021',
            '2022' => 'Tahun 2022',
            '2023' => 'Tahun 2023',
            '2024' => 'Tahun 2024',
            '2025' => 'Tahun 2025',
            '2026' => 'Tahun 2026',
            '2027' => 'Tahun 2027',
            '2028' => 'Tahun 2028',
            '2029' => 'Tahun 2029',
            '2030' => 'Tahun 2030',
            '2031' => 'Tahun 2031',
            '2032' => 'Tahun 2032',
            '2033' => 'Tahun 2033',
            '2034' => 'Tahun 2034',
            '2035' => 'Tahun 2035',
            'sp'    => 'Simpanan Pokok (SP)',
            'ss'    => 'Simpanan Sukarela (SS)',
            'shu'   => 'Sisa Hasil Usaha (SHU)'
        ];
        $currentYear = now()->year;
        $angkatanTahun = [];
        for ($i = 0; $i < 5; $i++) {
            $angkatanTahun[] = substr($currentYear - $i, -2);
        }

        return view('admin.keuangan.simpanan', compact(
            'simpanans',
            'search',
            'columns',
            'angkatanTahun',
            'angkatanFilter',
            'sort'
        ));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'column' => 'required',
            'value' => 'required|numeric',
        ]);

        DB::beginTransaction();

        try {
            $simpanan = Simpanan::findOrFail($id);
            $oldValue = $simpanan->{$validated['column']} ?? 0;
            $simpanan->updateColumnValue($validated['column'], $validated['value']);
            $simpanan->save();

            DB::commit();
            
            return back()->with('success', "Berhasil mengupdate kolom {$validated['column']}. Nilai berubah dari {$oldValue} menjadi {$simpanan->{$validated['column']}}. Total: {$simpanan->total}");
        } catch (\Throwable $e) {
            DB::rollBack();
            return back()->withInput()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
    public function bukti(Request $request): View
    {
        $search = $request->get('search');
        $pendaftars = Pendaftar::query()
            ->whereIn('metode', ['Transfer', 'Cash'])
            ->when($search, function ($query, $search) {
                return $query->where('nama', 'like', "%{$search}%")
                    ->orWhere('nim', 'like', "%{$search}%")
                    ->orWhere('metode', 'like', "%{$search}%");
            })
            ->orderBy('id', 'desc')
            ->paginate(20)
            ->withQueryString();
        return view('admin.keuangan.bukti', compact('pendaftars', 'search',));
    }
}