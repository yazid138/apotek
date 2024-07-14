<?php

namespace App\Http\Controllers;

use App\Models\Obat;
use App\Models\Pengadaan;
use Illuminate\Http\Request;

class PengadaanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pengadaan = Pengadaan::whereMonth('created_at', date('m'))->with('obat')->get();
        return view('data-pengadaan.rencana', compact('pengadaan'));
    }

    public function riwayat()
    {
        $pengadaan = Pengadaan::select('input_date')->groupBy('input_date')->get();
        return view('data-pengadaan.riwayat', compact('pengadaan'));
    }

    public function detail(Request $request)
    {
        if (!isset($request->date)) {
            return to_route('riwayat-pengadaan');
        }

        $pengadaan = Pengadaan::where('input_date', date('Y-m-d', strtotime($request->date)))->with('obat')->get();
        return view('data-pengadaan.detail-riwayat', compact('pengadaan'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $obat = Obat::find($request->obatId);
            $obat->pengadaan()->create([
                'jumlah' => $request->jumlah,
                'satuan' => $request->satuan,
                'input_date' => date('Y-m-d'),
            ]);
            return response()->json([
                'message' => 'Pengadaan berhasil ditambahkan',
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Pengadaan gagal ditambahkan',
            ], 400);
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
