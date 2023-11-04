<?php

namespace App\Http\Controllers;

use App\Models\aset;
use App\Models\Barang;
use App\Models\Ruangan;
use App\Models\Unit;
use Illuminate\Http\Request;

class RuangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ruangs = Ruangan::all();
        $units = Unit::all();
        return view('dashboard.ruang.index')->with(compact('ruangs', 'units'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'name' => 'required|max:255',
                'id_unit' => 'required',
            ]);
        } catch (\Illuminate\Validation\ValidationException $exception) {
            return redirect()->route('ruang.index')->with('failed', $exception->getMessage());
        }

        Ruangan::create($validatedData);

        return redirect()->route('ruang.index')->with('success', 'Ruang baru berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Ruangan $Ruang)
    {
        $barangs = Barang::all();
        $asets = aset::where('idRuangan', $Ruang->id)->get();
        $aset2 = aset::all();
        return view('dashboard.aset.detail.index')->with(compact('barangs', 'asets', 'Ruang', 'aset2'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Ruangan $ruang)
    {
        try {
            $rules = [
                'name' => 'required|max:255',
                'id_unit' => 'required',
            ];

            $validatedData = $this->validate($request, $rules);

            Ruangan::where('id', $ruang->id)->update($validatedData);

            return redirect()->route('ruang.index')->with('success', "Data Ruang $ruang->name berhasil diperbarui!");
        } catch (\Illuminate\Validation\ValidationException $exception) {
            return redirect()->route('ruang.index')->with('failed', 'Data gagal diperbarui! ' . $exception->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ruangan $ruang)
    {
        try {
            Ruangan::destroy($ruang->id);
        } catch (\Illuminate\Database\QueryException $e) {
            if ($e->getCode() == 23000) {
                //SQLSTATE[23000]: Integrity constraint violation
                return redirect()->route('ruang.index')->with('failed', "Ruang $ruang->name tidak dapat dihapus, karena sedang digunakan pada tabel lain!");
            }
        }

        return redirect()->route('ruang.index')->with('success', "Ruang $ruang->name berhasil dihapus!");
    }
}
