<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class JenisSoalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('jenis_soal')->insert([
            [
                'jenis_soal' => 'Essay'
            ],
            [
                'jenis_soal' => 'Pilihan Ganda'
            ],
        ]);
    }
}
