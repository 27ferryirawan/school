<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UjianDetailPilganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('ujian_detail_pilgan')->insert([
            //1
            [
                'ujian_detail_id' => 1,
                'no_jawaban' => 1,
                'jawaban' => 'Besaran turunan',
                'is_jawaban' => 0,
            ],
            [
                'ujian_detail_id' => 1,
                'no_jawaban' => 2,
                'jawaban' => 'Besaran Pokok',
                'is_jawaban' => 1,
            ],
            [
                'ujian_detail_id' => 1,
                'no_jawaban' => 3,
                'jawaban' => 'Satuan',
                'is_jawaban' => 0,
            ],
            [
                'ujian_detail_id' => 1,
                'no_jawaban' => 4,
                'jawaban' => 'Besaran Scalar',
                'is_jawaban' => 0,
            ],

            //2
            [
                'ujian_detail_id' => 2,
                'no_jawaban' => 1,
                'jawaban' => 'Panjang',
                'is_jawaban' => 0,
            ],
            [
                'ujian_detail_id' => 2,
                'no_jawaban' => 2,
                'jawaban' => 'Meter',
                'is_jawaban' => 1,
            ],
            [
                'ujian_detail_id' => 2,
                'no_jawaban' => 3,
                'jawaban' => 'Meja',
                'is_jawaban' => 0,
            ],
            [
                'ujian_detail_id' => 2,
                'no_jawaban' => 4,
                'jawaban' => '1 Meter',
                'is_jawaban' => 0,
            ],

            //5
            [
                'ujian_detail_id' => 5,
                'no_jawaban' => 1,
                'jawaban' => 'Satuan Baku',
                'is_jawaban' => 0,
            ],
            [
                'ujian_detail_id' => 5,
                'no_jawaban' => 2,
                'jawaban' => 'Satuan International',
                'is_jawaban' => 0,
            ],
            [
                'ujian_detail_id' => 5,
                'no_jawaban' => 3,
                'jawaban' => 'Satuan Tidak Baku',
                'is_jawaban' => 1,
            ],
            [
                'ujian_detail_id' => 5,
                'no_jawaban' => 4,
                'jawaban' => 'Besaran Pokok',
                'is_jawaban' => 0,
            ],

            //6
            [
                'ujian_detail_id' => 6,
                'no_jawaban' => 1,
                'jawaban' => 'Besaran turunan',
                'is_jawaban' => 0,
            ],
            [
                'ujian_detail_id' => 6,
                'no_jawaban' => 2,
                'jawaban' => 'Besaran skalar',
                'is_jawaban' => 0,
            ],
            [
                'ujian_detail_id' => 6,
                'no_jawaban' => 3,
                'jawaban' => 'Besaran vektor',
                'is_jawaban' => 0,
            ],
            [
                'ujian_detail_id' => 6,
                'no_jawaban' => 4,
                'jawaban' => 'Besaran Pokok',
                'is_jawaban' => 1,
            ],
        ]);
    }
}
