<?php

use App\Http\Controllers\ObatController;
use App\Http\Controllers\TransaksiController;
use App\Models\Order;
use App\Models\Transaksi;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

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
    });

    Route::get('/stock-obat', [ObatController::class, 'index'])->name('stock-obat');

    Route::get('/riwayat-pengadaan', function () {
        return view('data-pengadaan.riwayat');
    })->name('karyawan.riwayat-pengadaan');
    Route::get('/riwayat-pengadaan/{id}', function () {
        return view('data-pengadaan.detail-riwayat');
    })->name('karyawan.riwayat-pengadaan.detail');

    Route::prefix('admin')->middleware('role:admin,pemilik')->group(function () {
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
            Route::get('/obat/{id}/edit', 'edit')->name('admin.obat.edit');
            Route::put('/obat/{id}', 'update')->name('admin.obat.update');
            Route::delete('/obat-delete/{id}', 'destroy')->name('admin.obat.destroy');
        });
    });

    Route::middleware('role:karyawan')->group(function () {
        Route::get('/rencana-pengadaan', function () {
            return view('data-pengadaan.rencana');
        })->name('karyawan.rencana-pengadaan');
    });
});
