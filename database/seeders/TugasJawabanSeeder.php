<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class TugasJawabanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tugas_jawaban')->insert([
            [
                'tugas_id' => 1,
                'siswa_id' => 1,
                'description' => 'Jawbaan 111',
                'file_path' => null,
                'file_name' => null,
                'submit_date' => '2023-12-17 19:00:00'
            ],
            [
                'tugas_id' => 1,
                'siswa_id' => 2,
                'description' => 'Jawban 222',
                'file_path' => null,
                'file_name' => null,
                'submit_date' => '2023-12-17 19:00:00'
            ],
            [
                'tugas_id' => 2,
                'siswa_id' => 4,
                'description' => 'Jawbaan 444',
                'file_path' => null,
                'file_name' => null,
                'submit_date' => '2023-12-17 19:00:00'
            ],
            [
                'tugas_id' => 2,
                'siswa_id' => 5,
                'description' => 'Jawban 555',
                'file_path' => null,
                'file_name' => null,
                'submit_date' => '2023-12-17 19:00:00'
            ],
            [
                'tugas_id' => 2,
                'siswa_id' => 6,
                'description' => 'Jawban 666',
                'file_path' => null,
                'file_name' => null,
                'submit_date' => '2023-12-17 19:00:00'
            ],
        ]);
    }
}
