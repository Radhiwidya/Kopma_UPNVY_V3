<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\Link;
use App\Models\Pendaftar;
use App\Models\Poin;
use App\Models\Simpanan;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\RedirectResponse;

class PSDAController extends Controller
{
    // ===================================Data Anggota========================================
    public function index(Request $request): View
    {
        $search = $request->get('search');
        $anggotas = Anggota::query()
            ->when($search, function ($query, $search) {
                return $query->where('no_anggota', 'like', "%{$search}%")
                    ->orWhere('nama', 'like', "%{$search}%")
                    ->orWhere('nim', 'like', "%{$search}%")
                    ->orWhere('no_wa', 'like', "%{$search}%")
                    ->orWhere('ttl', 'like', "%{$search}%")
                    ->orWhere('alamat', 'like', "%{$search}%")
                    ->orWhere('kelamin', 'like', "%{$search}%")
                    ->orWhere('agama', 'like', "%{$search}%")
                    ->orWhere('fakultas', 'like', "%{$search}%")
                    ->orWhere('jurusan', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            })
            ->orderBy('id', 'desc')
            ->paginate(20)
            ->withQueryString();
        return view('admin.PSDA.anggota', compact('anggotas', 'search'));
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'nama'      => 'required',
            'nim'       => 'required',
            'no_wa'     => 'required',
            'ttl'       => 'required',
            'alamat'    => 'required',
            'kelamin'   => 'required',
            'agama'     => 'required',
            'fakultas'  => 'required',
            'jurusan'   => 'required',
            'email'     => 'required',
        ]);

        $no_anggota = $this->buatAnggota($request->only([
            'nama',
            'nim',
            'no_wa',
            'ttl',
            'alamat',
            'kelamin',
            'agama',
            'fakultas',
            'jurusan',
            'email'
        ]));

        return redirect()->back()->with('success', 'Anggota berhasil ditambahkan dengan No. Anggota: ' . $no_anggota);
    }

    private function buatAnggota(array $data): string
    {
        $no_anggota = $this->generateNoAnggota($data['nim']);
        $anggota = new Anggota();
        $anggota->no_anggota = $no_anggota;
        $anggota->nama       = $data['nama'];
        $anggota->nim        = $data['nim'];
        $anggota->no_wa      = $data['no_wa'] ?? null;
        $anggota->ttl        = $data['ttl'] ?? null;
        $anggota->alamat     = $data['alamat'] ?? null;
        $anggota->kelamin    = $data['kelamin'] ?? null;
        $anggota->agama      = $data['agama'] ?? null;
        $anggota->fakultas   = $data['fakultas'] ?? null;
        $anggota->jurusan    = $data['jurusan'] ?? null;
        $anggota->email      = $data['email'] ?? null;
        $anggota->save();

        // Ini untuk tambah ke table lain
        Poin::create([
            'no_anggota' => $no_anggota,
            'nama' => $data['nama'],
        ]);
        Simpanan::create([
            'no_anggota' => $no_anggota,
            'nama' => $data['nama'],
        ]);

        User::create([
            'no_anggota' => $no_anggota,
            'name'       => $data['nama'],
            'username'   => $no_anggota,
            'password'   => Hash::make($data['nim']),
            'user_type'  => 'user',
            'role'       => 'user',
        ]);

        return $no_anggota;
    }


    // ==========================================No Anggota Otomatis========================================
    private function generateNoAnggota($nim): string
    {
        // Ambil tanggal sekarang
        $now = now();
        // Ambil 2 digit tahun terakhir dari tahun sekarang
        $tahun = $now->format('y');
        // Ambil 2 digit bulan
        $bulan = $now->format('m');
        // Hitung urutan input berdasarkan jumlah anggota di bulan dan tahun yang sama saja
        $urutan = Anggota::whereYear('created_at', $now->year)
            ->whereMonth('created_at', $now->month)
            ->count() + 1;
        // Format urutan menjadi 3 digit dengan leading zero
        $urutanFormatted = str_pad($urutan, 3, '0', STR_PAD_LEFT);
        // Ambil angkatan dari digit ke-4 dan ke-5 NIM
        $angkatan = substr($nim, 3, 2);
        // Gabungkan semua komponen: [urutan].[angkatan].[bulan].[tahun]
        $no_anggota = "{$urutanFormatted}.{$angkatan}.{$bulan}.{$tahun}";
        return $no_anggota;
    }

    // ===========================Edit & Update Anggota========================================
    public function update(Request $request, $id): RedirectResponse
    {
        $validated = $request->validate([
            'no_anggota'    => 'nullable|string',
            'nama'          => 'nullable|string',
            'nim'           => 'nullable|string',
            'no_wa'         => 'nullable|string',
            'ttl'           => 'nullable|string',
            'alamat'        => 'nullable|string',
            'kelamin'       => 'nullable|string',
            'agama'         => 'nullable|string',
            'fakultas'      => 'nullable|string',
            'jurusan'       => 'nullable|string',
            'email'         => 'nullable|email',
        ]);

        DB::transaction(function () use ($validated, $id) {

            $anggota = Anggota::findOrFail($id);
            $noAnggotaLama = $anggota->no_anggota;
            $noAnggotaBaru = $validated['no_anggota'] ?? $noAnggotaLama;

            // Update tabel anggota
            $anggota->update($validated);

            // Kalau no anggota berubah → update tabel relasi
            if ($noAnggotaLama !== $noAnggotaBaru) {

                Simpanan::where('no_anggota', $noAnggotaLama)
                    ->update(['no_anggota' => $noAnggotaBaru]);

                Poin::where('no_anggota', $noAnggotaLama)
                    ->update(['no_anggota' => $noAnggotaBaru]);

                User::where('username', $noAnggotaLama)
                    ->update(['username' => $noAnggotaBaru]);
            }
        });

        return redirect()->back()->with('success', 'Data anggota berhasil diperbarui.');
    }

    //==========================================Delete Anggota====================================
    public function destroy($no_anggota): RedirectResponse
    {
        Anggota::where('no_anggota', $no_anggota)->delete();
        Poin::where('no_anggota', $no_anggota)->delete();
        Simpanan::where('no_anggota', $no_anggota)->delete();
        User::where('no_anggota', $no_anggota)->delete();
        return redirect()->back()->with('success', 'Data berhasil dihapus');
    }

    // ===================================Point==================================================
    public function indexPoin(Request $request): View
    {
        $search     = $request->get('search');
        $poins      = Poin::query()
            ->when($search, function ($query, $search) {
                return $query->where('no_anggota', 'like', "%{$search}%")
                    ->orWhere('nama', 'like', "%{$search}%");
                // Tambahkan kolom lain sesuai kebutuhan
            })
            ->orderBy('id', 'desc')
            ->paginate(20)
            ->withQueryString();
        return view('admin.PSDA.poin', compact('poins', 'search'));
    }

    public function tambahPoin(Request $request, $id): RedirectResponse
    {
        $request->validate([
            'poin' => 'required|in:1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12'
        ]);

        try {
            $poin = Poin::findOrFail($id);
            // Tambahkan point berdasarkan opsi
            $addedPoints = $poin->addPoints($request->poin);
            $message = "Point berhasil ditambahkan untuk {$poin->nama} (No. Anggota: {$poin->no_anggota}). " .
                "Point ditambah: +{$addedPoints}. Total point sekarang: {$poin->point}";
            return redirect()->back()->with('success', $message);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    // ===========================================Pendaftaran=================================================
    public function baru(Request $request): View
    {
        $search = $request->get('search');
        $pendaftars = Pendaftar::query()
            ->where('status', 'Menunggu Konfirmasi')
            ->when($search, function ($query, $search) {
                return $query->where('nama', 'like', "%{$search}%")
                    ->orWhere('nim', 'like', "%{$search}%")
                    ->orWhere('no_wa', 'like', "%{$search}%")
                    ->orWhere('ttl', 'like', "%{$search}%")
                    ->orWhere('alamat', 'like', "%{$search}%")
                    ->orWhere('kelamin', 'like', "%{$search}%")
                    ->orWhere('agama', 'like', "%{$search}%")
                    ->orWhere('fakultas', 'like', "%{$search}%")
                    ->orWhere('jurusan', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            })
            ->orderBy('id', 'desc')
            ->paginate(20)
            ->withQueryString();
        return view('admin.PSDA.pendaftaran.baru', compact('pendaftars', 'search'));
    }

    public function diterima(Request $request): View
    {
        $search = $request->get('search');
        $pendaftars = Pendaftar::query()
            ->where('status', 'Diterima')
            ->when($search, function ($query, $search) {
                return $query->where('nama', 'like', "%{$search}%")
                    ->orWhere('nim', 'like', "%{$search}%")
                    ->orWhere('no_wa', 'like', "%{$search}%")
                    ->orWhere('ttl', 'like', "%{$search}%")
                    ->orWhere('alamat', 'like', "%{$search}%")
                    ->orWhere('kelamin', 'like', "%{$search}%")
                    ->orWhere('agama', 'like', "%{$search}%")
                    ->orWhere('fakultas', 'like', "%{$search}%")
                    ->orWhere('jurusan', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            })
            ->orderBy('id', 'desc')
            ->paginate(20)
            ->withQueryString();
        $keluarga   = Link::where('jenis_link', 'Keluarga')->get();
        $diklat     = Link::where('jenis_link', 'Diklat')->get();
        return view('admin.PSDA.pendaftaran.terima', compact('pendaftars', 'search', 'keluarga', 'diklat'));
    }

    public function ditolak(Request $request): View
    {
        $search = $request->get('search');
        $pendaftars = Pendaftar::query()
            ->where('status', 'Ditolak')
            ->when($search, function ($query, $search) {
                return $query->where('nama', 'like', "%{$search}%")
                    ->orWhere('nim', 'like', "%{$search}%")
                    ->orWhere('no_wa', 'like', "%{$search}%")
                    ->orWhere('ttl', 'like', "%{$search}%")
                    ->orWhere('alamat', 'like', "%{$search}%")
                    ->orWhere('kelamin', 'like', "%{$search}%")
                    ->orWhere('agama', 'like', "%{$search}%")
                    ->orWhere('fakultas', 'like', "%{$search}%")
                    ->orWhere('jurusan', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            })
            ->orderBy('id', 'desc')
            ->paginate(20)
            ->withQueryString();
        return view('admin.PSDA.pendaftaran.tolak', compact('pendaftars', 'search',));
    }

    public function terima(Request $request, $id)
    {
        $pendaftar = Pendaftar::findOrFail($id);
        $pendaftar->status = $request->status;
        $pendaftar->save();

        $dataAnggota = [
            'nama'      => $pendaftar->nama,
            'nim'       => $pendaftar->nim,
            'no_wa'     => $pendaftar->no_wa,
            'ttl'       => $pendaftar->ttl,
            'alamat'    => $pendaftar->alamat,
            'kelamin'   => $pendaftar->kelamin,
            'agama'     => $pendaftar->agama,
            'fakultas'  => $pendaftar->fakultas,
            'jurusan'   => $pendaftar->jurusan,
            'email'     => $pendaftar->email,
        ];

        $nama = $pendaftar->nama;
        $no_anggota = $this->buatAnggota($dataAnggota);

        return back()->with('success', 'Berhasil menambah ' . $nama . ' menjadi anggota dengan no anggota: ' . $no_anggota);
    }

    public function tolak(Request $request, $id): RedirectResponse
    {
        $pendaftar = Pendaftar::findOrFail($id);
        $pendaftar->status = $request->status;
        $pendaftar->save();
        $nama = $pendaftar->nama;

        return back()->with('success', $nama . ' berhasil ditolak menjadi anggota kopma');
    }
    public function delete($id)
    {
        $pendaftar = Pendaftar::find($id);
        $pendaftar->delete();
        return redirect()->back()->with('success', 'Data berhasil dihapus.');
    }
    public function deleteAll(): RedirectResponse
    {
        Pendaftar::where('status', 'Diterima')->delete();
        return redirect()->back()->with('success', 'Data anggota diterima berhasil dihapus');
    }
    public function deleteAllReject(): RedirectResponse
    {
        Pendaftar::where('status', 'Ditolak')->delete();
        return redirect()->back()->with('success', 'Data anggota ditolak berhasil dihapus');
    }
    public function deleteDiklat(): RedirectResponse
    {
        Link::where('jenis_link', 'Diklat')->delete();
        return redirect()->back()->with('success', 'Link grup berhasil dihapus');
    }
    public function deleteKeluarga(): RedirectResponse
    {
        Link::where('jenis_link', 'Keluarga')->delete();
        return redirect()->back()->with('success', 'Link grup berhasil dihapus');
    }

    public function form(): View
    {
        return view('admin.PSDA.pendaftaran.form');
    }
    public function daftar(Request $request): RedirectResponse
    {
        $request->validate([
            'nama'      => 'required|string|max:255',
            'nim'       => 'required|string|max:20',
            'no_wa'     => 'required|string|max:20',
            'ttl'       => 'required|string|max:100',
            'alamat'    => 'required|string|max:255',
            'kelamin'   => 'required|string',
            'agama'     => 'required|string',
            'fakultas'  => 'required|string|max:100',
            'jurusan'   => 'required|string|max:100',
            'email'     => 'required|email|max:255',
            'metode'    => 'required|string',
            'status'    => 'nullable|string',
            'bukti'     => 'nullable|image|mimes:jpeg,png,jpg,pdf,jpeg',
        ]);

        $path = null;

        if ($request->hasFile('bukti')) {

            $file = $request->file('bukti');

            // Format nama dan nim menjadi nama file
            $namaSlug = preg_replace('/[^a-zA-Z0-9]/', '_', strtolower($request->nama));
            $nimSlug  = preg_replace('/[^a-zA-Z0-9]/', '_', strtolower($request->nim));
            $extension = $file->getClientOriginalExtension();

            $filename = $namaSlug . '_' . $nimSlug . '.' . $extension;

            // Tentukan folder tujuan langsung ke public/img/bukti
            $destinationPath = base_path('../public_html/img/bukti');

            // Pastikan folder ada
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

            // Pindahkan file
            $file->move($destinationPath, $filename);

            // Simpan path relatif untuk database
            $path = 'img/bukti/' . $filename;
        }


        $daftar = new Pendaftar();
        $daftar->nama      = $request->nama;
        $daftar->nim       = $request->nim;
        $daftar->no_wa     = $request->no_wa;
        $daftar->ttl       = $request->ttl;
        $daftar->alamat    = $request->alamat;
        $daftar->kelamin   = $request->kelamin;
        $daftar->agama     = $request->agama;
        $daftar->fakultas  = $request->fakultas;
        $daftar->jurusan   = $request->jurusan;
        $daftar->email     = $request->email;
        $daftar->metode    = $request->metode;
        $daftar->status    = $request->status;
        $daftar->bukti     = $path;
        $daftar->save();

        return redirect()->route('PSDA.success');
    }
    public function addLink(Request $request): RedirectResponse
    {
        $request->validate([
            'link'          => 'required',
            'jenis_link'    => 'required',
        ]);
        $link = new Link();
        $link->link         = $request->link;
        $link->jenis_link   = $request->jenis_link;
        $link->save();
        return redirect()->back()->with('success', 'Link grup berhasil ditambahkan');
    }

    // ===================================Pengumuman======================================================
    public function pengumuman(): View
    {
        return view('public/pengumuman');
    }

    public function cekNim(Request $request)
    {
        $request->validate([
            'nim' => 'required'
        ]);

        $nim = $request->nim;
        $pendaftar = Pendaftar::where('nim', $nim)->first();

        if (!$pendaftar) {
            return redirect()->back()->with('error', 'NIM ' . $nim . ' salah atau tidak ditemukan.');
        }
        $nama = $pendaftar->nama ?? 'Nama tidak tersedia';

        if ($pendaftar->status === 'Menunggu Konfirmasi') {
            return redirect()->route('hasil')->with('pesan', '<b>Mohon maaf calon anggota atas nama <span style="color:red;">' . $nama . ' </span>masih dalam proses seleksi.</b><br>
            <p>Mohon bersabar. Cek Pengumuman secara berkala!</p> ');
        }

        if ($pendaftar->status === 'Ditolak') {
            return redirect()->route('hasil')->with('pesan', '<b>Mohon maaf <span style="color:red;">' . $nama . ' </span>belum diterima menjadi anggota KOPMA UPNVY tahun ' . date('Y') . '.</b><br>
            <p>Jangan bersedih! masih ada kesempatan di lain waktu!</p> ');
        }

        if ($pendaftar->status === 'Diterima') {
            $anggota = Anggota::where('nim', $request->nim)->first();
            return redirect()->route('lolos')->with([
                'pesan' => $nama,
                'no_anggota' => $anggota ? $anggota->no_anggota : 'Nomor anggota belum tersedia.'
            ]);
        }

        return redirect()->back()->with('error', 'Status tidak dikenali.');
    }

    public function cekNoAnggota(Request $request)
    {
        // Validasi input
        $request->validate([
            'nim' => 'required'
        ]);

        // Ambil NIM dari input
        $nim = $request->nim;

        // Cari data anggota berdasarkan NIM
        $anggota = Anggota::where('nim', $nim)->first();

        // Jika NIM tidak ditemukan
        if (!$anggota) {
            return redirect()->back()->with('error', 'NIM ' . $nim . ' tidak ditemukan.');
        }

        // Jika NIM ditemukan, cek apakah no_anggota tersedia
        if (!empty($anggota->no_anggota)) {
            return view('public.no-anggota.hasil')->with([
                'nama' => $anggota->nama,
                'no_anggota' => $anggota->no_anggota ?? "Nama tidak tersedia"
            ]);
        }

        // Jika NIM ditemukan tetapi belum memiliki nomor anggota
        return redirect()->back()->with('error', 'Nomor anggota untuk NIM ' . $nim . ' belum tersedia.');
    }

    public function hasil()
    {
        if (!session()->has('pesan')) {
            return redirect()->route('pengumuman')->with('error', 'Anda belum memasukkan NIM.');
        }
        $pesan = session('pesan');
        return view('public/hasil', compact('pesan'));
    }

    public function lolos()
    {
        if (!session()->has('pesan') || !session()->has('no_anggota')) {
            return redirect()->route('pengumuman')->with('error', 'Anda belum memasukkan NIM.');
        }

        $LinkAnggota    = Link::where('jenis_link', 'Keluarga')->value('link');
        $LinkDiklat     = Link::where('jenis_link', 'Diklat')->value('link');
        $pesan          = session('pesan');
        $no_anggota     = session('no_anggota');
        return view('public/diterima', compact('LinkAnggota', 'LinkDiklat', 'pesan', 'no_anggota'));
    }
}