<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UjianJawabanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('ujian_jawaban')->insert([
            //1
            [
                'ujian_id' => 1,
                'siswa_id' => 1,
                'finish_date' => '2024-01-21 08:50:00',
                'nilai' => 100,
            ],
            [
                'ujian_id' => 1,
                'siswa_id' => 2,
                'finish_date' => '2024-01-21 08:51:00',
                'nilai' => 80,
            ],
            [
                'ujian_id' => 1,
                'siswa_id' => 3,
                'finish_date' => '2024-01-21 08:52:00',
                'nilai' => 90,
            ],
            //2
            [
                'ujian_id' => 2,
                'siswa_id' => 4,
                'finish_date' => '2024-01-22 09:52:00',
                'nilai' => 88,
            ],
            [
                'ujian_id' => 2,
                'siswa_id' => 5,
                'finish_date' => '2024-01-22 09:53:00',
                'nilai' => 98,
            ],
            [
                'ujian_id' => 2,
                'siswa_id' => 6,
                'finish_date' => '2024-01-22 09:54:00',
                'nilai' => 50,
            ],
        ]);
    }
}
