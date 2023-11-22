<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class GuruSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('guru')->insert([
            [
                'user_id' => '1',
                'nama_guru' => 'Elsa',
                'mapel' => 'IPA',
                'jenis_kelamin' => 'P'
            ],
            [
                'user_id' => '1',
                'nama_guru' => 'Dimas',
                'mapel' => 'IPS',
                'jenis_kelamin' => 'L'
            ],
            [
                'user_id' => '1',
                'nama_guru' => 'Ana',
                'mapel' => 'MTK',
                'jenis_kelamin' => 'P'
            ]
        ]);
    }
}
