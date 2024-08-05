<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\ObatController;
use App\Http\Controllers\PengadaanController;
use App\Http\Controllers\TransaksiController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return to_route('dashboard');
});

Auth::routes();

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::controller(TransaksiController::class)->group(function () {
        Route::get('/input-transaksi', 'create')->name('input-transaksi');
        Route::post('/create-transaksi', 'store')->name('create-transaksi');
        Route::get('/riwayat-transaksi', 'index')->name('riwayat-transaksi');
        Route::get('/riwayat-transaksi/print', 'print')->name('riwayat-transaksi.print');
    });

    Route::get('/stock-obat', [ObatController::class, 'index'])->name('stock-obat');

    Route::controller(PengadaanController::class)->group(function () {
        Route::post('/tambah-pengadaan', 'store')->name('tambah-pengadaan');
        Route::get('/rencana-pengadaan', 'index')->name('rencana-pengadaan');
        Route::get('/riwayat-pengadaan', 'riwayat')->name('riwayat-pengadaan');
        Route::get('/riwayat-pengadaan/detail', 'detail')->name('riwayat-pengadaan.detail');
    });

    Route::controller(ObatController::class)->group(function () {
        Route::get('/input-obat', 'create')->name('input-obat');
        Route::post('/input-obat', 'store')->name('input-obat.save');
        Route::get('/obat/{id}/edit', 'edit')->name('obat.edit');
        Route::put('/obat/{id}', 'update')->name('obat.update');
        Route::delete('/obat-delete/{id}', 'destroy')->name('obat.destroy');
    });

    Route::prefix('admin')->middleware('role:admin,pemilik')->group(function () {
        Route::controller(KaryawanController::class)->group(function () {
            Route::get('/karyawan', 'index')->name('admin.karyawan');
            Route::get('/karyawan/add', 'create')->name('admin.karyawan.create');
            Route::get('/karyawan/{id}', 'show')->name('admin.karyawan.show');
            Route::post('/karyawan', 'store')->name('admin.karyawan.insert');
            Route::put('/karyawan/{id}', 'update')->name('admin.karyawan.update');
            Route::delete('/karyawan/{id}', 'destroy')->name('admin.karyawan.delete');
        });
    });
});
