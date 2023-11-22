<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class TahunAjaranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tahun_ajaran')->insert([
            [
                'tahun_ajaran' => '2022/2023',
            ],
            [
                'tahun_ajaran' => '2023/2024',
            ],
        ]);
    }
}
