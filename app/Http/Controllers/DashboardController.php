<?php

namespace App\Http\Controllers;

use App\Models\Obat;
use App\Models\Order;
use App\Models\Transaksi;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        if ($user->role === 'karyawan') {
            return $this->karyawanDashboard();
        } else if ($user->role === 'apoteker') {
            return $this->apotekerDashboard();
        }

        return $this->adminDashboard();
    }

    public function adminDashboard()
    {
        $totalKeuntungan = DB::table('orders')
            ->join('obats', 'obats.id', '=', 'orders.obat_id')
            ->selectRaw('SUM(orders.qty*obats.price) total')
            ->first();
        $jumlahTransaksi = Transaksi::count();
        $transaksiTerakhir = Transaksi::latest()->first();
        $dataTransaksi = Order::where('transaksi_id', $transaksiTerakhir->id ?? 0)->with(['obat', 'transaksi'])->get();
        return view('admin.dashboard', compact('totalKeuntungan', 'dataTransaksi', 'jumlahTransaksi'));
    }

    public function karyawanDashboard()
    {
        $obats = Obat::query()->limit(10)->get();
        return view('karyawan.dashboard', compact('obats'));
    }

    public function apotekerDashboard()
    {
        $obats = Obat::query()->where(DB::raw('stock - safety_stock'), '<=', 50)->limit(10)->get();
        return view('apoteker.dashboard', compact('obats'));
    }
}
