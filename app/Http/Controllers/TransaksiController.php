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
            $transaksi = Transaksi::create([
                'input_name' => $request->input_name,
                'input_date' => $request->input_date,
            ]);
            $orders = [];
            for ($i = 0; $i < count($request->qty); $i++) {
                $obat = Obat::find((int) $request->obat[$i]);
                $obat->stock -= (int) $request->qty[$i];
                $obat->save();
                $orders[] = [
                    'obat_id' => (int) $request->obat[$i],
                    'qty' => (int) $request->qty[$i],
                ];
            }
            $transaksi->orders()->createMany($orders);
            return to_route('riwayat-transaksi')->with('success', 'Gagal menambahkan transaksi.');
        } catch (\Exception $error) {
            return redirect()->back()->withErrors(['failed' => 'Gagal menambahkan transaksi.'])->withInput();
        }
    }

    public function dataTable(Request $request)
    {
        $startDate = $request->startDate;
        $endDate = $request->endDate;
        $data = Order::query()
            ->with(['obat', 'transaksi'])
            ->whereHas('transaksi', function ($query) use ($startDate, $endDate) {
                $query
                    ->where('input_date', '>=', $startDate)
                    ->where('input_date', '<=', $endDate);
            })
            ->get();
        return DataTables::of($data)
            ->addColumn('total', function ($row) {
                return $row->obat ? $row->qty * $row->obat->price : 0;
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
        $request->validate([
            'startDate' => 'required',
            'endDate' => 'required',
        ]);
        $order = Order::with(['obat', 'transaksi'])
            ->whereHas('transaksi', function ($query) use ($request) {
                $query
                    ->where('input_date', '>=', $request->startDate)
                    ->where('input_date', '<=', $request->endDate);
            })->get();
        return view('data-penjualan.print', compact('order'));
    }
}
