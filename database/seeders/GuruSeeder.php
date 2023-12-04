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
                'tahun_ajaran_id' => '1',
                'mata_pelajaran_id' => '1',
                'NIP' => '101',
                'nama_guru' => 'Elsa',
                'jenis_kelamin' => 'P',
                'tanggal_lahir' => '2007-12-08',
                'agama' => 'Buddha',
                'tempat_lahir' => 'Tanjungpinang',
            ],
            [
                'user_id' => '1',
                'tahun_ajaran_id' => '1',
                'mata_pelajaran_id' => '2',
                'NIP' => '102',
                'nama_guru' => 'Dimas',
                'jenis_kelamin' => 'L',
                'tanggal_lahir' => '2007-11-08',
                'agama' => 'Buddha',
                'tempat_lahir' => 'Tanjungpinang',
            ],
            [
                'user_id' => '1',
                'tahun_ajaran_id' => '1',
                'mata_pelajaran_id' => '3',
                'NIP' => '103',
                'nama_guru' => 'Ana',
                'jenis_kelamin' => 'P',
                'tanggal_lahir' => '2007-10-08',
                'agama' => 'Buddha',
                'tempat_lahir' => 'Tanjungpinang',
            ]
        ]);
    }
}
