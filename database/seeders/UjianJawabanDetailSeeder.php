<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UjianJawabanDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('ujian_jawaban_detail')->insert([
            //1
            [
                'ujian_jawaban_id' => 1,
                'jenis_soal_id' => 2,
                'ujian_detail_id' => 1,
                'ujian_detail_pilgan_id' => null,
                'jawaban_deskripsi' => null,
            ],
            [
                'ujian_jawaban_id' => 1,
                'jenis_soal_id' => 2,
                'ujian_detail_id' => 2,
                'ujian_detail_pilgan_id' => 6,
                'jawaban_deskripsi' => null,
            ],
            [
                'ujian_jawaban_id' => 1,
                'jenis_soal_id' => 1,
                'ujian_detail_id' => 3,
                'ujian_detail_pilgan_id' => null,
                'jawaban_deskripsi' => null,
            ],
            [
                'ujian_jawaban_id' => 1,
                'jenis_soal_id' => 1,
                'ujian_detail_id' => 4,
                'ujian_detail_pilgan_id' => null,
                'jawaban_deskripsi' => 'Satuan',
            ],

            //2
            [
                'ujian_jawaban_id' => 2,
                'jenis_soal_id' => 2,
                'ujian_detail_id' => 1,
                'ujian_detail_pilgan_id' => 1,
                'jawaban_deskripsi' => null,
            ],
            [
                'ujian_jawaban_id' => 2,
                'jenis_soal_id' => 2,
                'ujian_detail_id' => 2,
                'ujian_detail_pilgan_id' => 7,
                'jawaban_deskripsi' => null,
            ],
            [
                'ujian_jawaban_id' => 2,
                'jenis_soal_id' => 1,
                'ujian_detail_id' => 3,
                'ujian_detail_pilgan_id' => null,
                'jawaban_deskripsi' => 'Besaran',
            ],
            [
                'ujian_jawaban_id' => 2,
                'jenis_soal_id' => 1,
                'ujian_detail_id' => 4,
                'ujian_detail_pilgan_id' => null,
                'jawaban_deskripsi' => 'Satuan',
            ],

            //3
            [
                'ujian_jawaban_id' => 3,
                'jenis_soal_id' => 2,
                'ujian_detail_id' => 1,
                'ujian_detail_pilgan_id' => 2,
                'jawaban_deskripsi' => null,
            ],
            [
                'ujian_jawaban_id' => 3,
                'jenis_soal_id' => 2,
                'ujian_detail_id' => 2,
                'ujian_detail_pilgan_id' => 7,
                'jawaban_deskripsi' => null,
            ],
            [
                'ujian_jawaban_id' => 3,
                'jenis_soal_id' => 1,
                'ujian_detail_id' => 3,
                'ujian_detail_pilgan_id' => null,
                'jawaban_deskripsi' => 'Nilai',
            ],
            [
                'ujian_jawaban_id' => 3,
                'jenis_soal_id' => 1,
                'ujian_detail_id' => 4,
                'ujian_detail_pilgan_id' => null,
                'jawaban_deskripsi' => 'Skalar',
            ],

            //4
            [
                'ujian_jawaban_id' => 4,
                'jenis_soal_id' => 2,
                'ujian_detail_id' => 5,
                'ujian_detail_pilgan_id' => 12,
                'jawaban_deskripsi' => null,
            ],
            [
                'ujian_jawaban_id' => 4,
                'jenis_soal_id' => 2,
                'ujian_detail_id' => 6,
                'ujian_detail_pilgan_id' => 15,
                'jawaban_deskripsi' => null,
            ],
            [
                'ujian_jawaban_id' => 4,
                'jenis_soal_id' => 1,
                'ujian_detail_id' => 7,
                'ujian_detail_pilgan_id' => null,
                'jawaban_deskripsi' => 'Nilai',
            ],
            [
                'ujian_jawaban_id' => 4,
                'jenis_soal_id' => 1,
                'ujian_detail_id' => 8,
                'ujian_detail_pilgan_id' => null,
                'jawaban_deskripsi' => 'Skalar',
            ],

            //5
            [
                'ujian_jawaban_id' => 5,
                'jenis_soal_id' => 2,
                'ujian_detail_id' => 5,
                'ujian_detail_pilgan_id' => 12,
                'jawaban_deskripsi' => null,
            ],
            [
                'ujian_jawaban_id' => 5,
                'jenis_soal_id' => 2,
                'ujian_detail_id' => 6,
                'ujian_detail_pilgan_id' => 13,
                'jawaban_deskripsi' => null,
            ],
            [
                'ujian_jawaban_id' => 5,
                'jenis_soal_id' => 1,
                'ujian_detail_id' => 7,
                'ujian_detail_pilgan_id' => null,
                'jawaban_deskripsi' => 'Besaran Fisik',
            ],
            [
                'ujian_jawaban_id' => 5,
                'jenis_soal_id' => 1,
                'ujian_detail_id' => 8,
                'ujian_detail_pilgan_id' => null,
                'jawaban_deskripsi' => 'Besaran yang satuannya diperoleh dari besaran pokok',
            ],

            //6
            [
                'ujian_jawaban_id' => 6,
                'jenis_soal_id' => 2,
                'ujian_detail_id' => 5,
                'ujian_detail_pilgan_id' => 11,
                'jawaban_deskripsi' => null,
            ],
            [
                'ujian_jawaban_id' => 6,
                'jenis_soal_id' => 2,
                'ujian_detail_id' => 6,
                'ujian_detail_pilgan_id' => 14,
                'jawaban_deskripsi' => null,
            ],
            [
                'ujian_jawaban_id' => 6,
                'jenis_soal_id' => 1,
                'ujian_detail_id' => 7,
                'ujian_detail_pilgan_id' => null,
                'jawaban_deskripsi' => 'Besaran',
            ],
            [
                'ujian_jawaban_id' => 6,
                'jenis_soal_id' => 1,
                'ujian_detail_id' => 8,
                'ujian_detail_pilgan_id' => null,
                'jawaban_deskripsi' => 'Besaran yang',
            ],
        ]);
    }
}
