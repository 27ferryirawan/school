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
                'user_id' => '9',
                'tahun_ajaran_id' => '1',
                'mata_pelajaran_id' => '1',
                'kelas_id' => '1',
                'NIP' => '001',
                'nama_guru' => 'Linda',
                'jenis_kelamin' => 'P',
                'tanggal_lahir' => '1999-12-08',
                'agama' => 'Islam',
                'tempat_lahir' => 'Tanjungpinang',
            ],
            [
                'user_id' => '10',
                'tahun_ajaran_id' => '1',
                'mata_pelajaran_id' => '2',
                'kelas_id' => '2',
                'NIP' => '002',
                'nama_guru' => 'Dewi',
                'jenis_kelamin' => 'P',
                'tanggal_lahir' => '1999-11-08',
                'agama' => 'Buddha',
                'tempat_lahir' => 'Tanjungpinang',
            ],
            [
                'user_id' => '11',
                'tahun_ajaran_id' => '1',
                'mata_pelajaran_id' => '3',
                'kelas_id' => '3',
                'NIP' => '003',
                'nama_guru' => 'Nur',
                'jenis_kelamin' => 'P',
                'tanggal_lahir' => '1999-10-08',
                'agama' => 'Kristen',
                'tempat_lahir' => 'Tanjungpinang',
            ]
        ]);
    }
}
