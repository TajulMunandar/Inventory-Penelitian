<?php

namespace App\Http\Controllers;

use App\Models\aset;
use App\Models\Barang;
use App\Models\Ruangan;
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Http\Request;

class AsetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $asets = aset::all();
        $barangs = Barang::all();
        if (isset($search)) {
            $ruangs = Ruangan::orderBy('created_at', 'desc')->where('name', 'like', '%' . $search . '%')->get();
        } else {
            $ruangs = Ruangan::orderBy('created_at', 'desc')->paginate(9);
        }

        return view('dashboard.aset.index')->with(compact('asets', 'barangs', 'ruangs', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

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
                'idBarang' => 'required',
                'idRuangan' => 'required',
            ]);
        } catch (\Illuminate\Validation\ValidationException $exception) {
            return redirect()->route('ruang.show', [$request->idRuangan])->with('failed', $exception->getMessage());
        }

        aset::create($validatedData);

        return redirect()->route('ruang.show', [$request->idRuangan])->with('success', 'Asset baru berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
    public function update(Request $request, aset $aset)
    {
        try {
            $rules = [
                'idBarang' => 'required',
                'idRuangan' => 'required',
            ];

            $validatedData = $this->validate($request, $rules);

            aset::where('id', $aset->id)->update($validatedData);

            return redirect()->route('ruang.show', [$request->idRuangan])->with('success', "Data Aset " . $aset->Barang->name . " berhasil diperbarui!");
        } catch (\Illuminate\Validation\ValidationException $exception) {
            return redirect()->route('ruang.show', [$request->idRuangan])->with('failed', 'Data gagal diperbarui! ' . $exception->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(aset $aset)
    {
        try {
            aset::destroy($aset->id);
        } catch (\Illuminate\Database\QueryException $e) {
            if ($e->getCode() == 23000) {
                //SQLSTATE[23000]: Integrity constraint violation
                return redirect()->route('ruang.show', [$aset->idRuangan])->with('failed', "Aset " . $aset->Barang->name . " tidak dapat dihapus, karena sedang digunakan pada tabel lain!");
            }
        }

        return redirect()->route('ruang.show', [$aset->idRuangan])->with('success', "Aset " . $aset->Barang->name . " berhasil dihapus!");
    }

    public function generatePDF(Ruangan $ruangan)
    {
        $asets = aset::where('idRuangan', $ruangan->id)->get();
        $total = aset::where('idRuangan', $ruangan->id)->count();
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isRemoteEnabled', true);

        $pdf = new Dompdf();

        $htmlContent = view('dashboard.template.aset', compact('asets', 'total'))->render();
        $pdf->loadHtml($htmlContent);
        $pdf->setPaper('A4', 'landscape');

        $pdf->render();

        return $pdf->stream('Aset.pdf');
    }

}
