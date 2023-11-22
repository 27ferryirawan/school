<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class SiswaKelasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('siswa_kelas')->insert([
            [
                'siswa_id' => 1,
                'kelas_id' => 1,
                'tahun_ajaran_id' => 1,
            ],
            [
                'siswa_id' => 2,
                'kelas_id' => 2,
                'tahun_ajaran_id' => 1,
            ],
            [
                'siswa_id' => 3,
                'kelas_id' => 3,
                'tahun_ajaran_id' => 1,
            ]
        ]);
    }
}
