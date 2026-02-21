<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Mahasiswa;
use App\Models\User;
use App\Models\BidangKeahlian;
use App\Models\Kelas;

class MahasiswaSeeder extends Seeder
{
    public function run(): void
    {
        // Ambil user mahasiswa
        $userAis = User::where('email', 'novi@kampus.test')->firstOrFail();
        $userAse = User::where('email', 'ari@kampus.test')->firstOrFail();
        $userOaa = User::where('email', 'esa@kampus.test')->firstOrFail();

        // Ambil bidang keahlian
        $ais = BidangKeahlian::where('kode_program_studi', '002')->firstOrFail();
        $ase = BidangKeahlian::where('kode_program_studi', '004')->firstOrFail();
        $oaa = BidangKeahlian::where('kode_program_studi', '007')->firstOrFail();

        // Ambil kelas
        $kelasAis = Kelas::where('nama_kelas', 'AIS-12')->firstOrFail();
        $kelasAse = Kelas::where('nama_kelas', 'ASE-10')->firstOrFail();
        $kelasOaa = Kelas::where('nama_kelas', 'OAA-13A')->firstOrFail();

        $data = [
            [
                'id_user' => $userAis->id_user,
                'nipd' => '2407810030002',
                'nama_mhs' => 'Novi Irnawati',
                'alamat' => 'Jl. Teknologi No. 1',
                'domisili' => 'Bandung',
                'tempat_lahir' => 'Bandung',
                'tgl_lahir' => '2005-01-10',
                'angkatan' => '2025',
                'periode' => '2025/2026',
                'email' => 'ase@student.test',
                'agama' => 'Islam',
                'no_tlp' => '081234567890',
                'foto' => null,
                'status' => 'Aktif',
                'id_program_studi' => $ais->id_program_studi,
                'id_kelas' => $kelasAis->id_kelas,
            ],
            [
                'id_user' => $userAse->id_user,
                'nipd' => '2407810040005',
                'nama_mhs' => 'ari',
                'alamat' => 'Jl. Coding No. 2',
                'domisili' => 'Jakarta',
                'tempat_lahir' => 'Jakarta',
                'tgl_lahir' => '2005-02-12',
                'angkatan' => '2025',
                'periode' => '2025/2026',
                'email' => 'rpl@student.test',
                'agama' => 'Islam',
                'no_tlp' => '081234567891',
                'foto' => null,
                'status' => 'Aktif',
                'id_program_studi' => $ase->id_program_studi,
                'id_kelas' => $kelasAse->id_kelas,
            ],
            [
                'id_user' => $userOaa->id_user,
                'nipd' => '2407810070044',
                'nama_mhs' => 'Esa Nabila Cahyani',
                'alamat' => 'Jl. Administrasi No. 3',
                'domisili' => 'Surabaya',
                'tempat_lahir' => 'Surabaya',
                'tgl_lahir' => '2005-03-15',
                'angkatan' => '2025',
                'periode' => '2025/2026',
                'email' => 'oad@student.test',
                'agama' => 'Islam',
                'no_tlp' => '081234567892',
                'foto' => null,
                'status' => 'Aktif',
                'id_program_studi' => $oaa->id_program_studi,
                'id_kelas' => $kelasOaa->id_kelas,
            ],
        ];

        foreach ($data as $mhs) {
            Mahasiswa::create($mhs);
        }
    }
}
