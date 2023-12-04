<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class SiswaNilaiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('siswa_nilai')->insert([
            [
                'siswa_id' => '1',
                'kelas_id' => '1',
                'tahun_ajaran_id' => '1',
                'mata_pelajaran_id' => '1',
                'nilai' => 80.25,
            ],
            [
                'siswa_id' => '1',
                'kelas_id' => '1',
                'tahun_ajaran_id' => '1',
                'mata_pelajaran_id' => '2',
                'nilai' => 90.20,
            ],
            // [
            //     'siswa_id' => '1',
            //     'kelas_id' => '1',
            //     'tahun_ajaran_id' => '1',
            //     'mata_pelajaran_id' => '3',
            //     'nilai' => 95.20,
            // ]
        ]);
    }
}
