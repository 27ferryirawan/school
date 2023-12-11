<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UjianDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('ujian_detail')->insert([
            [
                'ujian_id' => 1,
                'jenis_soal_id' => 1,
                'nomor' => 1,
                'soal' => '1 adalah',
            ],
            [
                'ujian_id' => 1,
                'jenis_soal_id' => 1,
                'nomor' => 2,
                'soal' => '2 adalah',
            ],
        ]);
    }
}