<?php

namespace App\Http\Controllers;

use App\Models\Obat;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

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
        $keuntunganPerMinggu = DB::table('transaksis')
            ->selectRaw("strftime('%Y', transaksis.input_date) year")
            ->selectRaw("strftime('%m', transaksis.input_date) month")
            ->selectRaw("strftime('%Y-%W', transaksis.input_date) weekOfYear")
            ->selectRaw("(strftime('%W', transaksis.input_date) - strftime('%W', date(transaksis.input_date, 'start of month')) + 1) week")
            ->selectRaw("SUM(orders.qty * obats.price) weekly_revenue")
            ->join('orders', 'transaksis.id', '=', 'orders.transaksi_id')
            ->join('obats', function ($join) {
                $join->on('orders.obat_id', '=', 'obats.id');
                $join->on('obats.deleted_at', 'IS', DB::raw('NULL'));
            })
            ->where('year', date('Y'))
            ->where('month', date('m'))
            ->groupBy('weekOfYear')
            ->orderBy('weekOfYear')
            ->get();
        $totalKeuntungan = DB::table('transaksis')
            ->selectRaw("strftime('%Y', transaksis.input_date) year")
            ->selectRaw("strftime('%m', transaksis.input_date) month")
            ->selectRaw("SUM(orders.qty * obats.price) total")
            ->join('orders', 'transaksis.id', '=', 'orders.transaksi_id')
            ->join('obats', function ($join) {
                $join->on('orders.obat_id', '=', 'obats.id');
                $join->on('obats.deleted_at', 'IS', DB::raw('NULL'));
            })
            ->where('year', date('Y'))
            ->where('month', date('m'))
            ->first();
        $jumlahTransaksi = DB::table('transaksis')
            ->selectRaw("strftime('%Y', transaksis.input_date) year")
            ->selectRaw("strftime('%m', transaksis.input_date) month")
            ->selectRaw("COUNT(id) jumlah")
            ->where('year', date('Y'))
            ->where('month', date('m'))
            ->first();
        return view('admin.dashboard', compact('totalKeuntungan', 'jumlahTransaksi', 'keuntunganPerMinggu'));
    }

    public function dataDashboard(Request $request)
    {
        $keuntunganPerMinggu = DB::table('transaksis')
            ->selectRaw("strftime('%Y-%m', transaksis.input_date) periode")
            ->selectRaw("strftime('%Y-%W', transaksis.input_date) weekOfYear")
            ->selectRaw("(strftime('%W', transaksis.input_date) - strftime('%W', date(transaksis.input_date, 'start of month')) + 1) week")
            ->selectRaw("SUM(orders.qty * obats.price) weekly_revenue")
            ->join('orders', 'transaksis.id', '=', 'orders.transaksi_id')
            ->join('obats', function ($join) {
                $join->on('orders.obat_id', '=', 'obats.id');
                $join->on('obats.deleted_at', 'IS', DB::raw('NULL'));
            })
            ->where('periode', $request->has('periode') ? $request->periode :  date('Y-m'))
            ->groupBy('weekOfYear')
            ->orderBy('wweekOfYeareek')
            ->get();
        $totalKeuntungan = DB::table('transaksis')
            ->selectRaw("strftime('%Y-%m', transaksis.input_date) periode")
            ->selectRaw("SUM(orders.qty * obats.price) total")
            ->join('orders', 'transaksis.id', '=', 'orders.transaksi_id')
            ->join('obats', function ($join) {
                $join->on('orders.obat_id', '=', 'obats.id');
                $join->on('obats.deleted_at', 'IS', DB::raw('NULL'));
            })
            ->where('periode', $request->has('periode') ? $request->periode :  date('Y-m'))
            ->first();
        $jumlahTransaksi = DB::table('transaksis')
            ->selectRaw("strftime('%Y-%m', transaksis.input_date) periode")
            ->selectRaw("COUNT(id) jumlah")
            ->where('periode', $request->has('periode') ? $request->periode :  date('Y-m'))
            ->first();
        return response()->json([
            'keuntunganPerMinggu' => $keuntunganPerMinggu,
            'totalKeuntungan' => $totalKeuntungan,
            'jumlahTransaksi' => $jumlahTransaksi,
        ]);
    }

    public function karyawanDashboard()
    {
        $obats = Obat::select(DB::raw('count(orders.obat_id) jumlah_transaksi, obats.*'))
            ->join('orders', 'orders.obat_id', '=', 'obats.id')
            ->where('stock', '>', 1)
            ->groupBy('orders.obat_id')
            ->orderBy('orders.created_at', 'DESC')
            ->limit(10)
            ->get();
        return view('karyawan.dashboard', compact('obats'));
    }

    public function apotekerDashboard()
    {
        $obats = Obat::query()->where(DB::raw('stock - safety_stock'), '<=', 50)->limit(10)->get();
        return view('apoteker.dashboard', compact('obats'));
    }
}
