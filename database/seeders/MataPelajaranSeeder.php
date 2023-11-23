<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class MataPelajaranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('mata_pelajaran')->insert([
            [
                'mata_pelajaran' => 'IPA',
            ],
            [
                'mata_pelajaran' => 'MTK',
            ],
            [
                'mata_pelajaran' => 'IPS',
            ]
        ]);
    }
}
