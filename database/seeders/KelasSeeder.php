<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class KelasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('kelas')->insert([
            [
                'nama_kelas' => 'VII A'
            ],
            [
                'nama_kelas' => 'VII B'
            ],
            [
                'nama_kelas' => 'VII C'
            ]
        ]);
    }
}
