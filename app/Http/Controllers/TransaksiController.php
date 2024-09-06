<?php

namespace App\Http\Controllers;

use App\Models\Obat;
use App\Models\Order;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return view('data-penjualan.riwayat-transaksi');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $obat = Obat::all();
        return view('data-penjualan.input-transaksi', compact('obat'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'input_name' => 'required',
            'input_date' => 'required|date',
            'qty' => 'required|array',
            'obat' => 'required|array',
        ]);

        try {
            $orders = [];
            for ($i = 0; $i < count($request->qty); $i++) {
                $obat = Obat::find((int) $request->obat[$i]);
                $obat->stock -= (int) $request->qty[$i];
                if ($obat->stock < 0) {
                    return redirect()->back()->withErrors(['failed' => 'Stock obat tidak mencukupi.'])->withInput();
                }
                $obat->save();
                $orders[] = [
                    'obat_id' => (int) $request->obat[$i],
                    'qty' => (int) $request->qty[$i],
                ];
            }
            $transaksi = Transaksi::create([
                'input_name' => $request->input_name,
                'input_date' => $request->input_date,
            ]);
            $transaksi->orders()->createMany($orders);
            return to_route('riwayat-transaksi')->with('success', 'Gagal menambahkan transaksi.');
        } catch (\Exception $error) {
            return redirect()->back()->withErrors(['failed' => 'Gagal menambahkan transaksi.'])->withInput();
        }
    }

    public function dataTable(Request $request)
    {
        $data = Transaksi::query()
            ->selectRaw('transaksis.*')
            ->selectRaw("strftime('%Y-%m', input_date) periode")
            ->with(['orders', 'orders.obat'])
            ->where('periode', $request->has('periode') ? $request->periode :  date('Y-m'))
            ->get();
        return DataTables::of($data)
            ->addColumn('total', function ($row) {
                $total = 0;
                foreach ($row->orders as $value) {
                    if ($value->obat) {
                        $total += $value->qty * $value->obat->price;
                    }
                }
                return $total;
            })
            ->make(true);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function print(Request $request)
    {
        $transaksi = Transaksi::query()
            ->selectRaw('transaksis.*')
            ->selectRaw("strftime('%Y-%m', input_date) periode")
            ->with(['orders', 'orders.obat'])
            ->where('periode', $request->has('periode') ? $request->periode :  date('Y-m'))
            ->get();
        return view('data-penjualan.print', compact('transaksi'));
    }
}
