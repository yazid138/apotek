<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
});
Route::get('/input-transaksi', function () {
    return view('data-penjualan/input-transaksi');
});
Route::get('/riwayat-transaksi', function () {
    return view('data-penjualan/riwayat-transaksi');
});
Route::get('/input-obat', function () {
    return view('obat/input');
});
Route::get('/stock-obat', function () {
    return view('obat/stock');
});
Route::get('/rencana-pengadaan', function () {
    return view('data-pengadaan/rencana');
});
Route::get('/riwayat-pengadaan', function () {
    return view('data-pengadaan/riwayat');
});
Route::get('/riwayat-pengadaan/{id}', function () {
    return view('data-pengadaan/detail-riwayat');
});
