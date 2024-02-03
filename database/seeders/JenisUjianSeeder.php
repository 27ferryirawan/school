<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class JenisUjianSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('jenis_ujian')->insert([
            // [
            //     'jenis_ujian' => 'Ujian Harian'
            // ],
            [
                'jenis_ujian' => 'Ujian Tengah Semester'
            ],
            [
                'jenis_ujian' => 'Ujian Akhir Semester'
            ],
        ]);
    }
}
