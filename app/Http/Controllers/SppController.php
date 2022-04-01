<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Spp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SppController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $spp = Spp::filter(request(['find']))->get();
        return view('admin.spp.spp', [
            "title" => "Spp | SPP.LuuL"
        ], compact('spp'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    // Function tombol tambah data
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'tahun' => ['required', 'unique:spp'],
            'nominal' => ['required', 'numeric'],
        ], [
            'tahun.unique' => 'Tahun ' . $request->tahun . ' sudah ada!',
            'tahun.required' => 'Tahun SPP tidak boleh kosong!',
            'nominal.numeric' => 'Nominal SPP harus angka!',
            'nominal.required' => 'Nominal SPP tidak boleh kosong!',
        ]);

        if ($validator->fails()) {
            return back()->withErrors(['msg' => $validator->errors()->all()]);
        }

        if ($validator->passes()) {
            Spp::create($request->all());
            return back()->with(['success' => 'Data berhasil ditambah!']);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Spp  $spp
     * @return \Illuminate\Http\Response
     */

    // Function tombol edit data
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nominal' => ['required', 'numeric']
        ], [
            'nominal.numeric' => 'Nominal SPP harus angka!',
            'nominal.required' => 'Nominal SPP tidak boleh kosong!',
        ]);

        if ($validator->fails()) {
            return back()->withErrors(['msg' => $validator->errors()->all()]);
        }

        if ($validator->passes()) {
            Spp::findOrFail($id)->update($request->all());
            return back()->with(['success' => 'Data berhasil diubah!']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Spp  $spp
     * @return \Illuminate\Http\Response
     */

    // Function tombol hapus data
    public function destroy($id)
    {
        Spp::findOrFail($id)->delete();
        return back()->with(['success' => 'Data berhasil dihapus!']);
    }
}
