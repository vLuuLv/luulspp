<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Petugas;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class PetugasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $petugas = Petugas::filter(request(['find']))->get();
        return view('admin.petugas.petugas', [
            "title" => "Petugas | SPP.LuuL"
        ], compact('petugas'));
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
            'username' => 'required|unique:users',
            'nama_petugas' => 'required',
        ], [
            'username.required' => 'Username petugas tidak boleh kosong!',
            'nama_petugas.required' => 'Nama petugas tidak boleh kosong!',
            'username.unique' => 'Username sudah ada!',
        ]);

        if ($validator->fails()) {
            return back()->withErrors(['msg' => $validator->errors()->all()]);
        }

        if ($validator->passes()) {
            DB::transaction(function () use ($request) {
                $user = User::create([
                    'username' => Str::lower($request->username),
                    'password' => Hash::make('luulspp2022'),
                    'role' => 'petugas'
                ]);

                Petugas::create([
                    'user_id' => $user->id,
                    'kode_petugas' => 'PTG' . Str::upper(Str::random(5)),
                    'nama_petugas' => $request->nama_petugas,
                    'jenis_kelamin' => $request->jenis_kelamin,
                ]);
            });

            return back()->with(['success' => 'Data berhasil ditambah!']);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Petugas  $petugas
     * @return \Illuminate\Http\Response
     */

    // Function tombol edit data
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nama_petugas' => 'required',
        ], [
            'nama_petugas.required' => 'Nama petugas tidak boleh kosong!',
        ]);

        if ($validator->fails()) {
            return back()->withErrors(['msg' => $validator->errors()->all()]);
        }

        if ($validator->passes()) {
            Petugas::findOrFail($id)->update($request->all());

            return back()->with(['success' => 'Data berhasil diubah!']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Petugas  $petugas
     * @return \Illuminate\Http\Response
     */

    // Function tombol hapus data
    public function destroy($id)
    {
        DB::transaction(function () use ($id) {
            $petugas = Petugas::findOrFail($id);
            User::findOrFail($petugas->user_id)->delete();
            $petugas->delete();
        });

        return back()->with(['success' => 'Data berhasil dihapus!']);
    }
}
