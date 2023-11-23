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
                'NISN' => '1V',
                'nama_siswa' => 'Vellen Jeniesca',
                'jenis_kelamin' => 'L',
                'tanggal_lahir' => '2007-11-08',
                'agama' => 'Buddha',
                'tempat_lahir' => 'Tanjungpinang',
            ],
            [
                'user_id' => 1,
                'NISN' => '1S',
                'nama_siswa' => 'Stephanie',
                'jenis_kelamin' => 'P',
                'tanggal_lahir' => '2007-11-09',
                'agama' => 'Kristen',
                'tempat_lahir' => 'Pekanbaru',
            ],
            [
                'user_id' => 1,
                'NISN' => '1B',
                'nama_siswa' => 'Budi',
                'jenis_kelamin' => 'L',
                'tanggal_lahir' => '2007-11-10',
                'agama' => 'Katolik',
                'tempat_lahir' => 'Jakarta',
            ]
        ]);
    }
}
