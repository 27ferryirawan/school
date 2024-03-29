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
                'nama_kelas' => 'VII A',
                'tingkat_kelas' => 7
            ],
            [
                'nama_kelas' => 'VII B',
                'tingkat_kelas' => 7
            ],
            [
                'nama_kelas' => 'VII C',
                'tingkat_kelas' => 7
            ],

            //8
            [
                'nama_kelas' => 'VIII A',
                'tingkat_kelas' => 8
            ],
            [
                'nama_kelas' => 'VIII B',
                'tingkat_kelas' => 8
            ],
            [
                'nama_kelas' => 'VIII C',
                'tingkat_kelas' => 8
            ],

            //9
            [
                'nama_kelas' => 'IX A',
                'tingkat_kelas' => 9
            ],
            [
                'nama_kelas' => 'IX B',
                'tingkat_kelas' => 9
            ],
            [
                'nama_kelas' => 'IX C',
                'tingkat_kelas' => 9
            ],
        ]);
    }
}
