<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class SiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('siswa')->insert([
            [
                'user_id' => 1,
                'NISN' => '1V',
                'nama_siswa' => 'Vellen Jeniesca',
                'jenis_kelamin' => 'L'
            ],
            [
                'user_id' => 1,
                'NISN' => '1S',
                'nama_siswa' => 'Stephanie',
                'jenis_kelamin' => 'P'
            ],
            [
                'user_id' => 1,
                'NISN' => '1B',
                'nama_siswa' => 'Budi',
                'jenis_kelamin' => 'L'
            ]
        ]);
    }
}
