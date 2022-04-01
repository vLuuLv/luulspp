<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use App\Models\Siswa;
use App\Models\Spp;
use App\Models\Kelas;
use Illuminate\Http\Request;
use DataTables;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $kelas =  Kelas::all();
        $siswa = Siswa::filter(request(['find']))->get();
        return view('admin.siswa.siswa', [
            "title" => "Siswa | SPP.LuuL"
        ], compact('siswa', 'kelas'));
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
            'nama_siswa' => 'required',
            'username' => 'required|unique:users',
            'nisn' => 'required|unique:siswa',
            'nis' => 'required|unique:siswa',
            'alamat' => 'required',
            'no_telepon' => 'required',
        ], [
            'nama_siswa.required' => 'Nama siswa tidak boleh kosong!',
            'username.required' => 'Username siswa tidak boleh kosong!',
            'nisn.required' => 'NISN siswa tidak boleh kosong!',
            'nis.required' => 'NIS siswa tidak boleh kosong!',
            'alamat.required' => 'Alamat siswa tidak boleh kosong!',
            'no_telepon.required' => 'Nomor telepon siswa tidak boleh kosong!',
            'nisn.unique' => 'NISN siswa sudah ada!',
            'nis.unique' => 'NIS siswa sudah ada!',
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
                    'role' => 'siswa'
                ]);

                Siswa::create([
                    'user_id' => $user->id,
                    'kode_siswa' => 'SS' . Str::upper(Str::random(5)),
                    'nisn' => $request->nisn,
                    'nis' => $request->nis,
                    'nama_siswa' => $request->nama_siswa,
                    'jenis_kelamin' => $request->jenis_kelamin,
                    'alamat' => $request->alamat,
                    'no_telepon' => $request->no_telepon,
                    'kelas_id' => $request->kelas_id,
                ]);
            });


            return back()->with(['success' => 'Data berhasil ditambah!']);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Siswa  $siswa
     * @return \Illuminate\Http\Response
     */

    // Function tombol edit data
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nama_siswa' => 'required',
            'alamat' => 'required',
            'no_telepon' => 'required',
        ], [
            'nama_siswa.required' => 'Nama siswa tidak boleh kosong!',
            'alamat.required' => 'Alamat siswa tidak boleh kosong!',
            'no_telepon.required' => 'Nomor telepon siswa tidak boleh kosong!',
        ]);

        if ($validator->fails()) {
            return back()->withErrors(['msg' => $validator->errors()->all()]);
        }

        if ($validator->passes()) {
            Siswa::findOrFail($id)->update([
                'nama_siswa' => $request->nama_siswa,
                'jenis_kelamin' => $request->jenis_kelamin,
                'alamat' => $request->alamat,
                'no_telepon' => $request->no_telepon,
                'kelas_id' => $request->kelas_id,
            ]);

            return back()->with(['success' => 'Data berhasil diubah!']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Siswa  $siswa
     * @return \Illuminate\Http\Response
     */

    // Function tombol hapus data
    public function destroy($id)
    {
        $siswa = Siswa::findOrFail($id);
        User::findOrFail($siswa->user_id)->delete();
        $siswa->delete();
        return back()->with(['success' => 'Data berhasil dihapus!']);
    }

    public function history()
    {
        $siswa = Siswa::with(['kelas'])
            ->where('user_id', Auth::user()->id)
            ->first();
        $spp = Spp::first();
        $pembayaran = Pembayaran::with(['siswa'])
            ->where('siswa_id', $siswa->id)
            ->where('tahun_bayar', $spp->tahun)
            ->get();


        return view('siswa.histori', [
            "title" => "History | SPP.LuuL"
        ], compact('siswa', 'spp', 'pembayaran'));
    }

    // Function untuk mengirimkan data history berdasarkan id siswa
    public function getHistori($id, Request $request)
    {
        if ($request->ajax()) {
            $data = Pembayaran::with(['petugas', 'siswa' => function ($query) {
                $query->with('kelas');
            }])->where('siswa_id', $id)->latest()->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->make(true);
        }
    }
}
