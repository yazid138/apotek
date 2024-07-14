<?php

use App\Http\Controllers\ObatController;
use App\Http\Controllers\PengadaanController;
use App\Http\Controllers\TransaksiController;
use App\Models\Order;
use App\Models\Transaksi;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return to_route('dashboard');
});

Auth::routes();

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        $totalKeuntungan = DB::table('orders')
            ->join('obats', 'obats.id', '=', 'orders.obat_id')
            ->selectRaw('SUM(orders.qty*obats.price) total')
            ->first();
        $jumlahTransaksi = Transaksi::count();
        $transaksiTerakhir = Transaksi::latest()->first();
        $dataTransaksi = Order::where('transaksi_id', $transaksiTerakhir->id)->with(['obat', 'transaksi'])->get();
        return view('dashboard', compact('totalKeuntungan', 'dataTransaksi', 'jumlahTransaksi'));
    })->name('dashboard');

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

    Route::prefix('admin')->middleware('role:admin,pemilik')->group(function () {
        Route::controller(ObatController::class)->group(function () {
            Route::get('/input-obat', 'create')->name('admin.input-obat');
            Route::post('/input-obat', 'store')->name('admin.input-obat.save');
            Route::get('/obat/{id}/edit', 'edit')->name('admin.obat.edit');
            Route::put('/obat/{id}', 'update')->name('admin.obat.update');
            Route::delete('/obat-delete/{id}', 'destroy')->name('admin.obat.destroy');
        });
    });
});
