<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Petugas;
use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\Spp;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // seed permission

        // seed spp
        Spp::create([
            'tahun' => '2020',
            'nominal' => 165000,
        ]);

        Spp::create([
            'tahun' => '2021',
            'nominal' => 170000,
        ]);

        Spp::create([
            'tahun' => '2022',
            'nominal' => 175000,
        ]);

        // seed kelas
        $kelas1 = Kelas::create([
            'nama_kelas' => 'X RPL 1',
            'kompetensi_keahlian' => 'Rekayasa Perangkat Lunak',
        ]);

        $kelas2 = Kelas::create([
            'nama_kelas' => 'XI RPL 2',
            'kompetensi_keahlian' => 'Rekayasa Perangkat Lunak',
        ]);

        $kelas3 = Kelas::create([
            'nama_kelas' => 'X MM',
            'kompetensi_keahlian' => 'Multimedia',
        ]);

        $kelas4 = Kelas::create([
            'nama_kelas' => 'X TKJ',
            'kompetensi_keahlian' => 'Teknik Komputer dan Jaringan',
        ]);

        $user1 = User::create([
            'username' => 'admin123',
            'password' => Hash::make('luulspp2022'),
            'role' => 'admin',
        ]);

        $petugas1 = Petugas::create([
            'user_id' => $user1->id,
            'kode_petugas' => 'PTG' . Str::upper(Str::random(5)),
            'nama_petugas' => 'Administrator',
            'jenis_kelamin' => 'Laki-laki',
        ]);

        $user2 = User::create([
            'username' => 'elaina123',
            'password' => Hash::make('luulspp2022'),
            'role' => 'petugas',
        ]);

        $petugas2 = Petugas::create([
            'user_id' => $user2->id,
            'kode_petugas' => 'PTG' . Str::upper(Str::random(5)),
            'nama_petugas' => 'Elaina',
            'jenis_kelamin' => 'Perempuan',
        ]);

        $user3 = User::create([
            'username' => 'diva123',
            'password' => Hash::make('luulspp2022'),
            'role' => 'siswa',
        ]);


        Siswa::create([
            'user_id' => $user3->id,
            'kode_siswa' => 'SS' . Str::upper(Str::random(5)),
            'nisn' => '08909978',
            'nis' => '08909955',
            'nama_siswa' => 'Diva',
            'jenis_kelamin' => 'Perempuan',
            'alamat' => 'Metal Float',
            'no_telepon' => '08599876098',
            'kelas_id' => $kelas1->id,
        ]);

        $user4 = User::create([
            'username' => 'yuu123',
            'password' => Hash::make('luulspp2022'),
            'role' => 'siswa',
        ]);

        Siswa::create([
            'user_id' => $user4->id,
            'kode_siswa' => 'SS' . Str::upper(Str::random(5)),
            'nisn' => '08909096',
            'nis' => '08909842',
            'nama_siswa' => 'Yuu',
            'jenis_kelamin' => 'Perempuan',
            'alamat' => 'Panda II',
            'no_telepon' => '085168875357',
            'kelas_id' => $kelas2->id,
        ]);
    }
}
