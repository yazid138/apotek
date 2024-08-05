<?php

namespace App\Http\Controllers;

use App\DataTables\KaryawanDataTable;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class KaryawanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(KaryawanDataTable $dataTable)
    {
        return $dataTable->render('admin.karyawan.list');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.karyawan.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'username' => 'required|unique:users,username',
            'password' => 'required',
            'role' => 'required',
        ]);

        try {
            $validated['password'] = Hash::make($validated['password']);
            User::create($validated);
            return to_route('admin.karyawan')->with('success', 'Berhasil menambahkan data karyawan.');
        } catch (\throwable $e) {
            return redirect()->back()->withErrors(['failed' => 'Gagal menambahkan Karyawan.'])->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::find($id);
        if ($user->role === 'admin' || $user->role === 'pemilik') {
            return \abort(403);
        }

        return view('admin.karyawan.edit', compact('user'));
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
        $validated = $request->validate([
            'name' => 'required',
            'username' => 'required|unique:users,username,' . $id,
            'role' => 'required',
        ]);

        try {
            $user = User::find($id);
            $user->update($validated);
            return to_route('admin.karyawan')->with('success', 'Berhasil mengubah data karyawan.');
        } catch (\throwable $e) {
            return redirect()->back()->withErrors(['failed' => 'Gagal mengubah Karyawan.'])->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $user = User::findOrFail($id);
            $user->delete();
            return response()->json(['success' => 'User berhasil dihapus.']);
        } catch (\Exception $error) {
            return response()->json(['error' => 'Gagal menghapus User.'], 500);
        }
    }
}
