<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use App\Models\Siswa;
use App\Models\Spp;
use App\Models\Petugas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use PDF;

class PembayaranController extends Controller
{
    public function index($nisn)
    {
        $siswa = Siswa::with(['kelas'])
            ->where('nisn', $nisn)
            ->first();

        $spp = Spp::all();

        return view('admin.pembayaran.bayar', [
            "title" => "Transaksi | SPP.LuuL"
        ], compact('siswa', 'spp'));
    }

    // Function untuk mengirim data spp berdasarkan tahun yang diinputkan
    public function spp($tahun)
    {
        $spp = Spp::where('tahun', $tahun)
            ->first();

        return response()->json([
            'data' => $spp,
            'nominal_rupiah' => 'Rp ' . number_format($spp->nominal, 0, 2, '.'),
        ]);
    }

    // Function tombol bayar
    public function prosesBayar(Request $request, $nisn)
    {
        $request->validate([
            'jumlah_bayar' => 'required',
        ], [
            'jumlah_bayar.required' => 'Jumlah bayar tidak boleh kosong!'
        ]);

        $petugas = Petugas::where('user_id', Auth::user()->id)
            ->first();

        $pembayaran = Pembayaran::whereIn('bulan_bayar', $request->bulan_bayar)
            ->where('tahun_bayar', $request->tahun_bayar)
            ->where('siswa_id', $request->siswa_id)
            ->pluck('bulan_bayar')
            ->toArray();

        if (!$pembayaran) {
            DB::transaction(function () use ($request, $petugas) {
                foreach ($request->bulan_bayar as $bulan) {
                    Pembayaran::create([
                        'kode_pembayaran' => 'SPP' . Str::upper(Str::random(5)),
                        'petugas_id' => $petugas->id,
                        'siswa_id' => $request->siswa_id,
                        'nisn' => $request->nisn,
                        'tanggal_bayar' => Carbon::now('Asia/Jakarta'),
                        'tahun_bayar' => $request->tahun_bayar,
                        'bulan_bayar' => $bulan,
                        'jumlah_bayar' => $request->jumlah_bayar,
                    ]);
                }
            });

            return redirect('history-pembayaran/' . $request->nisn)->with('success', 'Pembayaran berhasil disimpan!');
        } else {
            return back()
                ->with('error', 'Siswa Sudah Membayar Spp di bulan yang diinput (' .
                    implode($pembayaran, ',') . ")" . ' , di Tahun : ' . $request->tahun_bayar . ' . Pembayaran Dibatalkan');
        }
    }

    // Function tombol print history pembayaran
    public function printHistoryPembayaran($id)
    {
        $data['pembayaran'] = Pembayaran::with(['petugas', 'siswa'])
            ->where('id', $id)
            ->first();

        $pdf = PDF::loadView('admin.pembayaran.preview', $data);
        return $pdf->stream('pembayaran-spp-' . $data['pembayaran']->siswa->nama_siswa . '.pdf');
    }
}
