<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;

class KelasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $kelas =  Kelas::filter(request(['find']))->get();
        return view('admin.kelas.kelas', [
            "title" => "Kelas | SPP.LuuL"
        ], compact('kelas'));
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
            'nama_kelas' => 'required|unique:kelas',
            'kompetensi_keahlian' => 'required',
        ], [
            'nama_kelas.unique' => 'Kelas ' . $request->nama_kelas . ' sudah ada!',
            'nama_kelas.required' => 'nama kelas tidak boleh kosong!',
            'kompetensi_keahlian.required' => 'kompetensi keahlian tidak boleh kosong!',
        ]);

        if ($validator->fails()) {
            return back()->withErrors(['msg' => $validator->errors()->all()]);
        }

        if ($validator->passes()) {
            Kelas::create($request->all());

            return back()->with(['success' => 'Data berhasil ditambah!']);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Kelas  $kelas
     * @return \Illuminate\Http\Response
     */

    // Function tombol edit data
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nama_kelas' => 'required',
            'kompetensi_keahlian' => 'required',
        ], [
            'nama_kelas.required' => 'nama kelas tidak boleh kosong!',
            'kompetensi_keahlian.required' => 'kompetensi keahlian tidak boleh kosong!',
        ]);

        if ($validator->fails()) {
            return back()->withErrors(['msg' => $validator->errors()->all()]);
        }

        if ($validator->passes()) {
            Kelas::findOrFail($id)->update($request->all());

            return back()->with(['success' => 'Data berhasil diubah!']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kelas  $kelas
     * @return \Illuminate\Http\Response
     */

    // Function tombol hapus data
    public function destroy($id)
    {
        Kelas::findOrFail($id)->delete();

        return back()->with(['success' => 'Data berhasil dihapus!']);
    }
}
