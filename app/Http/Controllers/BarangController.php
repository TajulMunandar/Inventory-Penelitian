<?php

namespace App\Http\Controllers;

use App\Models\DetailPeminjaman;
use App\Models\Kategori;
use App\Models\Barang;
use App\Models\variant;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $barangs = Barang::all();

        $variants = variant::all();
        // dd($barangs);

        return view('dashboard.barang.index', [
            'title' => 'Data Barang',
            'variants' => $variants,
        ])->with(compact('barangs'));
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
            $validatedData = $request->validate([
                'name' => 'required',
                'idVariant' => 'required',
                'spesifikasi' => 'required',
                'kode_barang' => 'required|max:255|unique:barangs',
                'tahun' => 'nullable',
                'isMove' => 'required',
            ]);
        } catch (\Illuminate\Validation\ValidationException $exception) {
            return redirect()->route('barang.index')->with('failed', $exception->getMessage());
        }

        Barang::create($validatedData);

        return redirect()->route('barang.index')->with('success', 'Barang baru berhasil ditambahkan!');
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
    public function update(Request $request, Barang $barang)
    {
        try {
            $rules = [
                'name' => 'required',
                'idVariant' => 'required',
                'spesifikasi' => 'required',
                'kode_barang' => 'required|max:255',
                'tahun' => 'nullable',
                'isMove' => 'required',
            ];

            $validatedData = $request->validate($rules);

            $barang->update($validatedData);

            return redirect()->route('barang.index')->with('success', "Data barang $barang->deskripsi_barang berhasil diperbarui!");
        } catch (\Illuminate\Validation\ValidationException $exception) {
            return redirect()->route('barang.index')->with('failed', 'Data gagal diperbarui! ' . $exception->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Barang $barang)
    {
        try {
            Barang::destroy($barang->id);
        } catch (\Illuminate\Database\QueryException $e) {
            if ($e->getCode() == 23000) {
                //SQLSTATE[23000]: Integrity constraint violation
                return redirect()->route('barang.index')->with('failed', "Barang $barang->deskripsi_barang tidak dapat dihapus, karena sedang digunakan pada tabel lain!");
            }
        }

        return redirect()->route('barang.index')->with('success', "Barang $barang->deskripsi_barang berhasil dihapus!");
    }
}
