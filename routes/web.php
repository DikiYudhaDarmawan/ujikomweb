<?php

use App\Http\Controllers\AcaraController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\DataSiswaController;
use App\Http\Controllers\EkskulController;
use App\Http\Controllers\EvaluasiController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PembinaController;
use App\Http\Controllers\PengumumanController;
use App\Http\Controllers\PresensiController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\SiswaEkskulController;
use App\Http\Controllers\TahunAjaranController;
use App\Http\Controllers\UserController;use Illuminate\Support\Facades\Route;

Route::get('/', fn() => view('auth.login'));
Auth::routes();

Route::middleware(['auth'])->group(function () {

    // Admin
    Route::prefix('admin')->middleware('role:admin')->group(function () {
        Route::get('/', fn() => view('admin.index'));
        Route::get('/home', [AdminDashboardController::class, 'index'])->name('admin.dashboard');

        Route::resource('ekskul', EkskulController::class);
        Route::resource('user', UserController::class);
        Route::resource('tahunAjaran', TahunAjaranController::class);
        Route::get('/siswa-ekskul', [SiswaEkskulController::class, 'index'])->name('siswaekskul.index');
        Route::post('/siswa-ekskul/tambah/{ekskul_id}/{siswa_id}', [SiswaEkskulController::class, 'store'])->name('siswaekskul.store');
        Route::delete('siswaekskul/{ekskul_id}/{siswa_id}', [SiswaEkskulController::class, 'destroy'])->name('siswaekskul.destroy');

        Route::get('/siswa-ekskul/get/{ekskul_id}', [SiswaEkskulController::class, 'getByEkskul'])->name('siswaekskul.getByEkskul');

        Route::post('/tahun-ajaran/update-status', [TahunAjaranController::class, 'updateStatus'])->name('tahunAjaran.updateStatus');
        Route::post('/user/update-status', [UserController::class, 'updateStatus'])->name('user.updateStatus');
    });
    // Pembina
    Route::prefix('pembina')->middleware('role:pembina')->group(function () {
        // Route::get('/', fn() => view('pembina.index'));
        Route::get('/home', [PembinaController::class, 'index'])->name('pembina.dashboard');

        Route::resource('acara', AcaraController::class);
        Route::resource('pengumuman', PengumumanController::class);
        Route::resource('datasiswa', DataSiswaController::class);
        Route::resource('evaluasi', EvaluasiController::class);
        Route::get('presensi/{acara}/create', [PresensiController::class, 'show'])->name('presensi.create');
        Route::post('presensi/{acara}', [PresensiController::class, 'store'])->name('presensi.store');
        Route::get('presensi/{acara}/rekap', [PresensiController::class, 'rekap'])->name('presensi.rekap');
        Route::get('presensi/{acara}/edit', [PresensiController::class, 'edit'])->name('presensi.edit');
        Route::put('presensi/{acara}', [PresensiController::class, 'update'])->name('presensi.update');
        Route::put('/presensi/{acara}', [PresensiController::class, 'update'])->name('presensi.update');
        Route::get('/presensi/{acara}/export-pdf', [PresensiController::class, 'exportPdf'])->name('presensi.export.pdf');

    });
    Route::get('/api/siswa-terdaftar/{ekskul_id}', [SiswaEkskulController::class, 'getSiswaTerdaftar']);

    // Siswa
    Route::prefix('siswa')->middleware('role:siswa')->group(function () {
        Route::get('/', fn() => view('index'));
        Route::get('/home', [SiswaController::class, 'index'])->name('siswa.index');

        Route::post('/daftar', [EkskulController::class, 'daftar'])->name('daftar');

        Route::get('/ekskulku', [SiswaController::class, 'ekskulku'])->name('siswa.ekskulku');
        Route::get('/ekskul/{id}', [SiswaController::class, 'show'])->name('siswa.show');
        Route::get('/ekskul/{id}/pengumuman', [SiswaController::class, 'pengumuman'])->name('siswa.pengumuman');
        Route::get('/nilai/{id}', [SiswaController::class, 'nilai'])->name('siswa.nilai');
    });

});

Route::get('/home', [HomeController::class, 'index'])->name('home');