<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use App\Models\Siswa;
use App\Models\Spp;
use Illuminate\Http\Request;
use DataTables;

class HistoryController extends Controller
{

    public function index()
    {
        $siswa = Siswa::get();
        $spp = Spp::all();
        return view('admin.pembayaran.history', [
            "title" => "History | SPP.LuuL"
        ], compact('siswa', 'spp'));
    }

    // Function untuk menampilkan tampilan history berdasarkan nisn siswa
    public function history($nisn)
    {
        $siswa = Siswa::with(['kelas'])
            ->where('nisn', $nisn)
            ->first();
        $spp = Spp::first();
        $pembayaran = Pembayaran::with(['siswa'])
            ->where('siswa_id', $siswa->id)
            ->where('tahun_bayar', $spp->tahun)
            ->get();


        return view('admin.pembayaran.history-pembayaran', [
            "title" => "History Pembayaran | SPP.LuuL"
        ], compact('siswa', 'spp', 'pembayaran'));
    }

    // Function tombol cari history
    public function cari(Request $request)
    {
        // menangkap data pencarian
        $cari = $request->nisn;

        // mengambil data dari table pegawai sesuai pencarian data
        $siswa = Siswa::where('nisn', 'like', "%" . $cari . "%")
            ->get();
        $spp = Spp::all();

        // mengirim data siswa ke view
        return view('admin.pembayaran.history', [
            "title" => "History | SPP.LuuL"
        ], compact('siswa', 'spp'));
    }

    // Function untuk mengambil data history berdasarkan id siswa
    public function getHistori($id, Request $request)
    {
        if ($request->ajax()) {
            $data = Pembayaran::with(['petugas', 'siswa' => function ($query) {
                $query->with('kelas');
            }])->where('siswa_id', $id)->latest()->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $actionBtn  = '<div class="row px-3"><a href="' . route('pdf.pembayaran', $row->id) . '"class="btn btn-danger btn-sm " target="_blank">
                    <i class="fas fa-print fa-fw"></i></a>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }
}
