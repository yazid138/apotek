<?php

use App\Http\Controllers\ObatController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware('auth')->group(function () {
    Route::prefix('admin')->middleware('role:admin,pemilik')->group(function () {
        Route::get('/dashboard', function () {
            return view('dashboard');
        })->name('admin.dashboard');
        Route::get('/input-transaksi', function () {
            return view('admin.data-penjualan.input-transaksi');
        })->name('admin.input-transaksi');
        Route::get('/riwayat-transaksi', function () {
            return view('admin.data-penjualan.riwayat-transaksi');
        })->name('admin.riwayat-transaksi');
        Route::get('/rencana-pengadaan', function () {
            return view('admin.data-pengadaan.rencana');
        })->name('admin.rencana-pengadaan');
        Route::get('/riwayat-pengadaan', function () {
            return view('admin.data-pengadaan.riwayat');
        })->name('admin.riwayat-pengadaan');
        Route::get('/riwayat-pengadaan/{id}', function () {
            return view('admin.data-pengadaan.detail-riwayat');
        })->name('admin.riwayat-pengadaan.detail');

        Route::controller(ObatController::class)->group(function () {
            Route::get('/input-obat', 'create')->name('admin.input-obat');
            Route::post('/input-obat', 'store')->name('admin.input-obat.save');
            Route::get('/stock-obat', 'index')->name('admin.stock-obat');
            Route::get('/obat/{id}/edit', 'edit')->name('admin.obat.edit');
            Route::put('/obat/{id}', 'update')->name('admin.obat.update');
            Route::delete('/obat-delete/{id}', 'destroy')->name('admin.obat.destroy');
            
        });
    });

    Route::middleware('role:karyawan')->group(function () {
        Route::get('/dashboard', function () {
            return view('dashboard');
        })->name('karyawan.dashboard');
        Route::get('/input-transaksi', function () {
            return view('data-penjualan.input-transaksi', ['role' => 'karyawan']);
        })->name('karyawan.input-transaksi');
        Route::get('/riwayat-transaksi', function () {
            return view('data-penjualan.riwayat-transaksi', ['role' => 'karyawan']);
        })->name('karyawan.riwayat-transaksi');
        Route::get('/rencana-pengadaan', function () {
            return view('data-pengadaan.rencana', ['role' => 'karyawan']);
        })->name('karyawan.rencana-pengadaan');
        Route::get('/riwayat-pengadaan', function () {
            return view('data-pengadaan.riwayat', ['role' => 'karyawan']);
        })->name('karyawan.riwayat-pengadaan');
        Route::get('/riwayat-pengadaan/{id}', function () {
            return view('data-pengadaan.detail-riwayat', ['role' => 'karyawan']);
        })->name('karyawan.riwayat-pengadaan.detail');
        Route::get('/stock-obat', [ObatController::class, 'index'])->name('karyawan.stock-obat');
    });
});
