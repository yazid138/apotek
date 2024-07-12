<?php

namespace App\Http\Controllers;

use App\DataTables\TransaksiDataTable;
use App\Models\Obat;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(TransaksiDataTable $dataTable)
    {
        return $dataTable->render('data-penjualan.riwayat-transaksi');
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
}
