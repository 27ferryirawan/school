<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UjianSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('ujian')->insert([
            [
                'guru_id' => 1,
                'kelas_id' => 1,
                'tahun_ajaran_id' => 1,
                'mata_pelajaran_id' => 1,
                'jenis_ujian_id' => 1,
                'deskripsi' => 'Ujian Harian 1',
                'kode_ruangan' => 'VII A',
                'waktu_pengerjaan' => 30,
            ],
            [
                'guru_id' => 1,
                'kelas_id' => 1,
                'tahun_ajaran_id' => 1,
                'mata_pelajaran_id' => 2,
                'jenis_ujian_id' => 1,
                'deskripsi' => 'Ujian Harian 2',
                'kode_ruangan' => 'VII B',
                'waktu_pengerjaan' => 30,
            ],
        ]);
    }
}