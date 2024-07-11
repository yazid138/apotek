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
            return $dataTable->render('karyawan.obat.stock');
        }

        return $dataTable->render('admin.obat.stock');
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

        try {
            Obat::create($validated);
            return to_route('admin.stock-obat')->with('success', 'Berhasil menambahkan data obat.');
        } catch (\Exception $error) {
            return redirect()->back()->withErrors(['failed' => 'Gagal menambahkan Obat.'])->withInput();
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
    public function edit($id)
    {
        $obat = Obat::findOrFail($id);
        return view('admin.obat.edit', compact('obat'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
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

        try {
            $obat = Obat::findOrFail($id);
            $obat->update($validated);
            $obat->save();
            return to_route('admin.stock-obat')->with('success', 'Berhasil mengubah data obat.');
        } catch (\Exception $error) {
            return redirect()->back()->with(['failed' => 'Gagal mengupdate Obat.'])->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $obat = Obat::findOrFail($id);
            $obat->delete();
            return response()->json(['success' => 'Obat berhasil dihapus.']);
        } catch (\Exception $error) {
            return response()->json(['error' => 'Gagal menghapus obat.'], 500);
        }
    }
}
