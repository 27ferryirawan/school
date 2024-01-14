<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UjianDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('ujian_detail')->insert([
            //1
            [
                'ujian_id' => 1,
                'jenis_soal_id' => 2,
                'soal' => 'Pengukuran merupakan kegiatan membandingkan suatu besaran yang diukur dengan alat ukur yang digunakan sebagai...',
            ],
            [
                'ujian_id' => 1,
                'jenis_soal_id' => 2,
                'soal' => 'Panjang meja 1 meter. Satuan besaran yang digunakan pada pernyataan tersebut adalah…',
            ],
            [
                'ujian_id' => 1,
                'jenis_soal_id' => 1,
                'soal' => 'Sesuatu yang dapat diukur dan dapat dinyatakan dengan angka disebut …',
            ],
            [
                'ujian_id' => 1,
                'jenis_soal_id' => 1,
                'soal' => 'Pembanding dalam suatu pengukuran disebut …',
            ],
            //2
            [
                'ujian_id' => 2,
                'jenis_soal_id' => 2,
                'soal' => 'Satuan yang digunakan untuk melakukan pengukuran dengan hasil yang tidak sama untuk orang yang berlainan disebut …',
            ],
            [
                'ujian_id' => 2,
                'jenis_soal_id' => 2,
                'soal' => 'Besaran yang satuannya telah didefinisikan terlebih dahulu disebut …',
            ],
            [
                'ujian_id' => 2,
                'jenis_soal_id' => 1,
                'soal' => 'Besaran yang dapat diukur dan memiliki satuan disebut …',
            ],
            [
                'ujian_id' => 2,
                'jenis_soal_id' => 1,
                'soal' => 'Besaran turunan adalah …',
            ],
        ]);
    }
}