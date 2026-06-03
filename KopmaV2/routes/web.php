<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KeuanganController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\PSDAController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DiklatController;
use App\Http\Controllers\PTController;
use App\Http\Controllers\user\MainController as UserMainController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArsipController;


Route::get('/1', function () {
    return view('welcome');
});

// ================================================AKSES UMUM=================================================
Route::resource('/', MainController::class);
Route::resource('/presensi-diklat', DiklatController::class);
Route::post('/presensi-diklat/update', [DiklatController::class, 'update'])->name('diklat.update');
Route::post('/presensi-diklat/cek', [DiklatController::class, 'cek'])->name('diklat.cek');
Route::get('/diklat/success', function () {
    return view('public.diklat_success');
})->name('diklat.success');
Route::get('/lupa-password', function () {
    return view('public.panduan');
});
//Pendaftaran TUTUP
//Route::get('/pendaftaran', function () {return view('public/dclose');})->name('PSDA.form'); 
//Pendaftaran BUKA
Route::get('/pendaftaran', [PSDAController::class, 'form'])->name('PSDA.form');
Route::post('/pendaftaran', [PSDAController::class, 'daftar'])->name('PSDA.daftar');
Route::get('/success', function () {
    return view('admin.PSDA.pendaftaran.success');
})->name('PSDA.success');
Route::get('/login', function () {
    return view('public/login');
});
Route::get('/u2', function () {
    return view('admin.usaha.laporan-usaha');
});


//Pengumuman TUTUP
//Route::get('/pengumuman', function () {return view('public/uclose');})->name('pengumuman'); 
//Pengumuman BUKA
Route::get('/pengumuman', [PSDAController::class, 'pengumuman'])->name('pengumuman');
Route::post('/pengumuman', [PSDAController::class, 'cekNim'])->name('cek.nim');

Route::get('/hasil', [PSDAController::class, 'hasil'])->name('hasil');
Route::get('/diterima', [PSDAController::class, 'lolos'])->name('lolos');
Route::get('/diterima', [PSDAController::class, 'lolos'])->name('lolos');

Route::get('/cek-no-anggota', function () {
    return view('public.no-anggota.cek-no-anggota');
})->name('cek');
Route::post('/cek-no-anggota', [PSDAController::class, 'cekNoAnggota'])->name('cek.no');

// ===============================================Route Alert================================================
Route::get('/alert', function () {
    return response()->view('auth.alert');
})->name('login');

// ===============================================Route Login==================================================
Route::post('/login-user', [AuthController::class, 'loginUser'])->name('login.user');
Route::post('/login-admin', [AuthController::class, 'loginAdmin'])->name('login.admin');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::put('/updatepw', [UserMainController::class, 'update'])->name('user.update');

// =============================================MIDDLEWARE ADMIN==============================================
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/dashboard', [MainController::class, 'dashboard']);

    Route::get('/admin/setting', function () {return view('admin.setting');});
    // =============================================Route PSDA=================================================
    Route::prefix('PSDA')->name('PSDA.')->group(function () {
        Route::resource('/anggota', PSDAController::class)->middleware('role:psda');
        Route::get('/poin', [PSDAController::class, 'indexPoin'])->name('poin')->middleware('role:psda,keuangan');
        Route::post('/poin/tambah-poin/{id}', [PSDAController::class, 'tambahPoin'])->name('tambahPoin')->middleware('role:psda');
        Route::get('/registrant', [PSDAController::class, 'baru'])->name('baru')->middleware('role:psda');
        Route::delete('/registrant/hapus/{id}', [PSDAController::class, 'delete'])->name('delete')->middleware('role:psda');
        Route::put('/registrant/{id}', [PSDAController::class, 'terima'])->name('terima')->middleware('role:psda');
        Route::put('/registran/{id}', [PSDAController::class, 'tolak'])->name('tolak')->middleware('role:psda');
        Route::get('/rejected', [PSDAController::class, 'ditolak'])->name('ditolak')->middleware('role:psda');
        Route::delete('/rejected/delete', [PSDAController::class, 'deleteAllReject'])->name('hapusTolak')->middleware('role:psda');
        Route::get('/accepted', [PSDAController::class, 'diterima'])->name('diterima')->middleware('role:psda');
        Route::delete('/accepted/delete', [PSDAController::class, 'deleteAll'])->name('hapusSemua')->middleware('role:psda');
        Route::delete('/accepted/delete1', [PSDAController::class, 'deleteDiklat'])->name('hapusDiklat')->middleware('role:psda');
        Route::delete('/accepted/delete2', [PSDAController::class, 'deleteKeluarga'])->name('hapusKeluarga')->middleware('role:psda');
        Route::post('/accepted', [PSDAController::class, 'addLink'])->name('addLink')->middleware('role:psda');
    });

    // =============================================Route Keuangan==============================================
    Route::prefix('keuangan')->name('Keuangan.')->group(function () {
        Route::resource('/simpanan', KeuanganController::class)->middleware('role:keuangan');
        Route::get('/bukti', [KeuanganController::class, 'bukti'])->name('bukti')->middleware('role:keuangan');
    });

    // =============================================Route PT==============================================
    Route::prefix('TechDev')->name('PT.')->group(function () {
        Route::resource('/pusat-akun', PTController::class);
    });
});

// =============================================MIDDLEWARE USER==============================================
Route::middleware(['auth', 'user'])->prefix('user')->name('user.')->group(function () {
    Route::resource('/dashboard', UserMainController::class);
});

Route::middleware(['auth'])->group(function () {

    Route::get('/arsip/{bidang}', [ArsipController::class, 'index'])
        ->name('arsip.index');

    Route::post('/arsip/{bidang}', [ArsipController::class, 'store'])
        ->name('arsip.store');

});
Route::put('/arsip/{id}', [ArsipController::class, 'update'])
    ->name('arsip.update');

Route::delete('/arsip/{id}', [ArsipController::class, 'destroy'])
    ->name('arsip.destroy');