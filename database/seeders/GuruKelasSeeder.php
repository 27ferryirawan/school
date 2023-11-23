<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class GuruKelasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('guru_kelas')->insert([
            [
                'guru_id' => 1,
                'kelas_id' => 1,
                'tahun_ajaran_id' => 1,
                'wali_kelas' => 1,
                'mata_pelajaran_id' => 1
            ],
            [
                'guru_id' => 2,
                'kelas_id' => 1,
                'tahun_ajaran_id' => 1,
                'wali_kelas' => 0,
                'mata_pelajaran_id' => 2
            ],
            [
                'guru_id' => 3,
                'kelas_id' => 1,
                'tahun_ajaran_id' => 1,
                'wali_kelas' => 0,
                'mata_pelajaran_id' => 3
            ]
        ]);
    }
}
