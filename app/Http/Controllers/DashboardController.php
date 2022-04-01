<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Kelas;
use App\Models\User;
use App\Models\Siswa;
use App\Models\Pembayaran;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $siswa_laki_laki = Siswa::where('jenis_kelamin', 'Laki-laki')->count();
        $siswa_perempuan = Siswa::where('jenis_kelamin', 'Perempuan')->count();
        $kelas_1 = Kelas::where('nama_kelas', 'like', '%' . 'X ' . '%')->count();
        $kelas_2 = Kelas::where('nama_kelas', 'like', '%' . 'Xi' . '%')->count();
        $kelas_3 = Kelas::where('nama_kelas', 'like', '%' . 'Xii' . '%')->count();
        $rpl = Kelas::where('nama_kelas', 'like', '%' . 'rpl' . '%')->count();
        $mm = Kelas::where('nama_kelas', 'like', '%' . 'mm' . '%')->count();
        $tkj = Kelas::where('nama_kelas', 'like', '%' . 'tkj' . '%')->count();
        $tahun = Carbon::now()->format('Y');

        return view('admin.dashboard', [
            'total_dibayar_jan' => Pembayaran::where([['bulan_bayar', 'Januari'], ['tahun_bayar', $tahun]])->count(),
            'total_dibayar_feb' => Pembayaran::where([['bulan_bayar', 'Februari'], ['tahun_bayar', $tahun]])->count(),
            'total_dibayar_mar' => Pembayaran::where([['bulan_bayar', 'Maret'], ['tahun_bayar', $tahun]])->count(),
            'total_dibayar_apr' => Pembayaran::where([['bulan_bayar', 'April'], ['tahun_bayar', $tahun]])->count(),
            'total_dibayar_mei' => Pembayaran::where([['bulan_bayar', 'Mei'], ['tahun_bayar', $tahun]])->count(),
            'total_dibayar_jun' => Pembayaran::where([['bulan_bayar', 'Juni'], ['tahun_bayar', $tahun]])->count(),
            'total_dibayar_jul' => Pembayaran::where([['bulan_bayar', 'Juli'], ['tahun_bayar', $tahun]])->count(),
            'total_dibayar_agu' => Pembayaran::where([['bulan_bayar', 'Agustus'], ['tahun_bayar', $tahun]])->count(),
            'total_dibayar_sep' => Pembayaran::where([['bulan_bayar', 'September'], ['tahun_bayar', $tahun]])->count(),
            'total_dibayar_okt' => Pembayaran::where([['bulan_bayar', 'Oktober'], ['tahun_bayar', $tahun]])->count(),
            'total_dibayar_nov' => Pembayaran::where([['bulan_bayar', 'November'], ['tahun_bayar', $tahun]])->count(),
            'total_dibayar_des' => Pembayaran::where([['bulan_bayar', 'Desember'], ['tahun_bayar', $tahun]])->count(),
            'total_siswa' => User::where('role', 'siswa')->count(),
            'total_kelas' => Kelas::count(),
            'total_admin' => User::where('role', 'admin')->count(),
            'total_petugas' => User::where('role', 'petugas')->count(),
            'siswa_laki_laki' => $siswa_laki_laki,
            'siswa_perempuan' => $siswa_perempuan,
            "kelas_1" => $kelas_1,
            "kelas_2" => $kelas_2,
            "kelas_3" => $kelas_3,
            "rpl" => $rpl,
            "mm" => $mm,
            "tkj" => $tkj,
            "title" => "Dashboard | SPP.LuuL"
        ]);
    }
}
