<?php

namespace App\Http\Controllers;

use App\DataTables\ObatDataTable;
use App\Models\Obat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ObatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(ObatDataTable $dataTable)
    {
        if (Auth::user()->role === 'karyawan') {
            return $dataTable->render('obat.stock');
            // return view('obat.stock', compact('obat'));
        }

        return $dataTable->render('admin.obat.stock');
        // return view('admin.obat.stock', compact('obat'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.obat.input');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'input_name' => 'required',
                'input_date' => 'required',
                'name' => 'required',
                'price' => 'required',
                'stock' => 'required',
                'expired_date' => 'required',
                'no_batch' => 'required',
                'safety_stock' => 'required',
            ]);
            Obat::create($validated);
            return to_route('admin.stock-obat')->with('success', 'Berhasil menambahkan Obat.');
        } catch (\Exception $error) {
            return redirect()->back()->with('failed', 'Gagal menambahkan Obat.');
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