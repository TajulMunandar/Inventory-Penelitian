<?php

namespace App\Http\Controllers;

use App\Models\variant;
use Illuminate\Http\Request;

class VariantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $variants = variant::all();
        return view('dashboard.variant.index')->with(compact('variants'));
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
            ]);
        } catch (\Illuminate\Validation\ValidationException $exception) {
            return redirect()->route('variant.index')->with('failed', $exception->getMessage());
        }

        variant::create($validatedData);

        return redirect()->route('variant.index')->with('success', 'Variant baru berhasil ditambahkan!');
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
    public function update(Request $request,variant $variant)
    {
        try {
            $rules = [
                'name' => 'required|max:255',
            ];

            $validatedData = $this->validate($request, $rules);

            variant::where('id', $variant->id)->update($validatedData);

            return redirect()->route('variant.index')->with('success', "Data Variant $variant->name berhasil diperbarui!");
        } catch (\Illuminate\Validation\ValidationException $exception) {
            return redirect()->route('variant.index')->with('failed', 'Data gagal diperbarui! ' . $exception->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(variant $variant)
    {
        try {
            variant::destroy($variant->id);
        } catch (\Illuminate\Database\QueryException $e) {
            if ($e->getCode() == 23000) {
                //SQLSTATE[23000]: Integrity constraint violation
                return redirect()->route('variant.index')->with('failed', "Variant $variant->name tidak dapat dihapus, karena sedang digunakan pada tabel lain!");
            }
        }

        return redirect()->route('variant.index')->with('success', "Variant $variant->name berhasil dihapus!");
    }
}
