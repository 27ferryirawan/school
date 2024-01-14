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
                'guru_pembelajaran_id' => 1,
                'jenis_ujian_id' => 1,
                'deskripsi' => 'Ujian Harian 1',
                'kode_ruangan' => 'VII A',
                'waktu_pengerjaan' => 30,
                'tanggal_ujian' => '2024-01-21 07:00:00',
            ],
            [
                'guru_pembelajaran_id' => 5,
                'jenis_ujian_id' => 2,
                'deskripsi' => 'Ujian Tengah Semester 1',
                'kode_ruangan' => 'VII B',
                'waktu_pengerjaan' => 50,
                'tanggal_ujian' => '2024-01-22 07:00:00',
            ],
        ]);
    }
}