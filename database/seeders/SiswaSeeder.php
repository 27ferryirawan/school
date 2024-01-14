<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class SiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('siswa')->insert([
            [
                'user_id' => 1,
                'kelas_id' => 1,
                'tahun_ajaran_id' => 1,
                'NISN' => 'S001',
                'nama_siswa' => 'Dimas',
                'jenis_kelamin' => 'L',
                'tanggal_lahir' => '2005-12-12',
                'agama' => 'Islam',
                'tempat_lahir' => 'Tanjungpinang',
            ],
            [
                'user_id' => 2,
                'kelas_id' => 1,
                'tahun_ajaran_id' => 1,
                'NISN' => 'S002',
                'nama_siswa' => 'Budi',
                'jenis_kelamin' => 'L',
                'tanggal_lahir' => '2005-12-13',
                'agama' => 'Kristen',
                'tempat_lahir' => 'Pekanbaru',
            ],
            [
                'user_id' => 3,
                'kelas_id' => 1,
                'tahun_ajaran_id' => 1,
                'NISN' => 'S003',
                'nama_siswa' => 'Jessicca',
                'jenis_kelamin' => 'P',
                'tanggal_lahir' => '2005-12-14',
                'agama' => 'Katolik',
                'tempat_lahir' => 'Jakarta',
            ],
            [
                'user_id' => 4,
                'kelas_id' => 1,
                'tahun_ajaran_id' => 1,
                'NISN' => 'S004',
                'nama_siswa' => 'Putri',
                'jenis_kelamin' => 'P',
                'tanggal_lahir' => '2005-12-15',
                'agama' => 'Hindu',
                'tempat_lahir' => 'Jakarta',
            ],
            [
                'user_id' => 5,
                'kelas_id' => 2,
                'tahun_ajaran_id' => 1,
                'NISN' => 'S005',
                'nama_siswa' => 'Dika',
                'jenis_kelamin' => 'l',
                'tanggal_lahir' => '2005-12-16',
                'agama' => 'Hindu',
                'tempat_lahir' => 'Jakarta',
            ],
            [
                'user_id' => 6,
                'kelas_id' => 2,
                'tahun_ajaran_id' => 1,
                'NISN' => 'S006',
                'nama_siswa' => 'Ellaine',
                'jenis_kelamin' => 'P',
                'tanggal_lahir' => '2005-12-17',
                'agama' => 'Buddha',
                'tempat_lahir' => 'Bandung',
            ],
            [
                'user_id' => 7,
                'kelas_id' => 2,
                'tahun_ajaran_id' => 1,
                'NISN' => 'S007',
                'nama_siswa' => 'Arthur',
                'jenis_kelamin' => 'L',
                'tanggal_lahir' => '2005-12-18',
                'agama' => 'Kristen',
                'tempat_lahir' => 'Bali',
            ],
            [
                'user_id' => 8,
                'kelas_id' => 2,
                'tahun_ajaran_id' => 1,
                'NISN' => 'S009',
                'nama_siswa' => 'William',
                'jenis_kelamin' => 'L',
                'tanggal_lahir' => '2005-12-19',
                'agama' => 'Islam',
                'tempat_lahir' => 'Depok',
            ]
        ]);
    }
}
