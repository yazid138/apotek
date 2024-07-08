<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('admin')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('admin.dashboard');
    Route::get('/input-transaksi', function () {
        return view('admin.data-penjualan.input-transaksi');
    })->name('admin.input-transaksi');
    Route::get('/riwayat-transaksi', function () {
        return view('admin.data-penjualan.riwayat-transaksi');
    })->name('admin.riwayat-transaksi');
    Route::get('/input-obat', function () {
        return view('admin.obat.input');
    })->name('admin.input-obat');
    Route::get('/stock-obat', function () {
        return view('admin.obat.stock');
    })->name('admin.stock-obat');
    Route::get('/rencana-pengadaan', function () {
        return view('admin.data-pengadaan.rencana');
    })->name('admin.rencana-pengadaan');
    Route::get('/riwayat-pengadaan', function () {
        return view('admin.data-pengadaan.riwayat');
    })->name('admin.riwayat-pengadaan');
    Route::get('/riwayat-pengadaan/{id}', function () {
        return view('admin.data-pengadaan.detail-riwayat');
    })->name('admin.riwayat-pengadaan.detail');
});

Route::get('/dashboard', function () {
    return view('dashboard', ['role' => 'karyawan']);
})->name('karyawan.dashboard');
Route::get('/input-transaksi', function () {
    return view('data-penjualan.input-transaksi', ['role' => 'karyawan']);
})->name('karyawan.input-transaksi');
Route::get('/riwayat-transaksi', function () {
    return view('data-penjualan.riwayat-transaksi', ['role' => 'karyawan']);
})->name('karyawan.riwayat-transaksi');
Route::get('/input-obat', function () {
    return view('obat.input', ['role' => 'karyawan']);
})->name('karyawan.input-obat');
Route::get('/stock-obat', function () {
    return view('obat.stock', ['role' => 'karyawan']);
})->name('karyawan.stock-obat');
Route::get('/rencana-pengadaan', function () {
    return view('data-pengadaan.rencana', ['role' => 'karyawan']);
})->name('karyawan.rencana-pengadaan');
Route::get('/riwayat-pengadaan', function () {
    return view('data-pengadaan.riwayat', ['role' => 'karyawan']);
})->name('karyawan.riwayat-pengadaan');
Route::get('/riwayat-pengadaan/{id}', function () {
    return view('data-pengadaan.detail-riwayat', ['role' => 'karyawan']);
})->name('karyawan.riwayat-pengadaan.detail');
