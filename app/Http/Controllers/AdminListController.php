<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Petugas;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AdminListController extends Controller
{
    public function index()
    {
        $admin_list = User::filter(request(['admin']))->with('petugas')->where('role', 'admin')->get();
        return view('admin.admin-list.admin-list', [
            "title" => "Admin | SPP.LuuL"
        ], compact('admin_list'));
    }

    // Function tombol tambah data
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|unique:users',
            'nama_petugas' => 'required',
        ], [
            'username.unique' => 'Username ' . $request->username . ' sudah ada!',
            'username.required' => 'Username admin tidak boleh kosong!',
            'nama_petugas.required' => 'Nama petugas keahlian tidak boleh kosong!',
        ]);

        if ($validator->fails()) {
            return back()->withErrors(['msg' => $validator->errors()->all()]);
        }

        if ($validator->passes()) {
            DB::transaction(function () use ($request) {
                $user = User::create([
                    'username' => Str::lower($request->username),
                    'password' => Hash::make('luulspp2022'),
                    'role' => 'admin'
                ]);

                Petugas::create([
                    'user_id' => $user->id,
                    'kode_petugas' => 'PTGL' . Str::upper(Str::random(5)),
                    'nama_petugas' => $request->nama_petugas,
                ]);
            });

            return back()->with(['success' => 'Data berhasil ditambah!']);
        }
    }

    // Function tombol edit data
    public function update($id, Request $request)
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
            Petugas::where('user_id', $id)->update([
                'nama_petugas' => $request->nama_petugas,
            ]);

            return back()->with(['success' => 'Data berhasil diubah!']);
        }
    }

    // Function tombol menghapus data
    public function destroy($id)
    {
        Petugas::where('user_id', $id)->delete();
        User::findOrFail($id)->delete();
        return back()->with(['success' => 'Data berhasil dihapus!']);
    }
}
