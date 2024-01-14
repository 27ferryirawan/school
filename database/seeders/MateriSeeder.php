<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class MateriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('materi')->insert([
            [
                'guru_pembelajaran_id' => 1,
                'title' => 'Bab 1: Besaran dan Pengukuran',
                'description' => '- Besaran adalah sesuatu yang dapat diukur dan dinyatakan dengan angka, sedangkan satuan adalah besaran pembanding yang digunakan dalam pengukuran.
                - Besaran pokok terdiri dari panjang, massa, waktu, suhu, kuat arus, jumlah zat, dan intensitas cahaya. Dari besaran pokok tersebut dapat diturunkan besaran turunan seperti luas, volume, kecepatan, gaya, dan sebagainya.
                - Alat-alat yang digunakan untuk pengukuran besaran panjang antara lain mistar, rol meter, jangka sorong, dan mikrometer sekrup.
                - Alat untuk mengukur besaran massa disebut timbangan atau neraca. Terdapat bermacam-macam jenis timbangan atau neraca sesuai kegunaannya.
                - Alat pengukuran waktu adalah jam dan stopwatch. Stopwatch digunakan dalam pengukuran waktu yang membutuhkan ketelitian seperti mencatat waktu dalam perlombaan olahraga lari, renang, balap mobil, dan sebagainya.
                - Suhu adalah besaran untuk menyatakan tingkat panas dinginnya suatu keadaan. Alat pengukuran suhu adalah termometer.
                - Ada empat skala satuan suhu, yaitu Celcius, Fahrenheit, Reamur, dan Kelvin dengan konversi sebagai berikut:
                    1. t °C = 5 / 9 (t °F – 32) atau t °F = 9 / 5 t °C + 32
                    2. t °C = 5 / 4 t °R atau t °R = 4 / 5 t °C
                    3. t °C = t K – 273 atau t K = t °C + 273',
                'file_path' => null,
                'file_name' => null,
            ],
            [
                'guru_pembelajaran_id' => 1,
                'title' => 'Bab 2: Klasifikasi Zat',
                'description' => '- Semua zat kimia merupakan asam, basa dan garam.
                - Asam memiliki sifat antara lain rasanya masam, menghantarkan arus listrik, jika dilarutkan dalam air akan melepaskan ion hidrogen, mengubah lakmus biru menjadi merah dan korosif terhadap logam.
                - Basa memiliki sifat licin jika terkena kulit, menghantarkan arus listrik, jika dilarutkan dalam air akan melepaskan ion hidroksida, mengubah lakmus merah menjadi biru dan menetralkan asam.
                - Garam bersifat menghantarkan arus listrik (dalam bentuk lelehan) dan tidak mengubah warna kertas lakmus merah maupun biru.
                - Untuk mengidentifikasi asam, basa, dan garam digunakan indikator alami (ekstrak kulit manggis, kubis ungu dan bunga sepatu) dan indikator buatan (kertas lakmus, indikator universal, dan pH meter).
                - Tingkat keasaman dinyatakan dengan angka 1 – 14. Larutan bersifat asam jika pH kurang dari 7, larutan netral memiliki pH 7 dan larutan basa memiliki pH lebih dari 7.
                - Jenis zat kimia yang utama dibedakan menjadi unsur, senyawa, dan campuran.
                - Unsur merupakan zat tunggal yang tidak dapat diuraikan lagi menjadi zat lain yang lebih sederhana melalui reaksi kimia sederhana.
                - Nama unsur dapat dinyatakan dengan lambang unsur. Lambang unsur yang kita gunakan sekarang ini menurut usulan Berzelius.
                - Senyawa merupakan zat yang tersusun atas dua unsur atau lebih yang bergabung secara kimia dengan perbandingan massa tertentu. Rumus kimia dari senyawa dinyatakan dengan Ax By , di mana A dan B menyatakan lambang unsur penyusun sedangkan x dan y menyatakan jumlah relatif atom A dan B dalam senyawa.
                - Campuran merupakan materi yang tersusun atas dua jenis zat atau lebih dengan perbandingan tidak tetap. Campuran dibedakan atas campuran homogen (larutan) dan campuran heterogen (suspensi dan koloid).',
                'file_path' => null,
                'file_name' => null,
            ],
            [
                'guru_pembelajaran_id' => 4,
                'title' => 'Bab 1 Bilangan',
                'description' => '1. Membandingkan Bilangan Bulat
                Untuk membandingkan bilangan bulat positif yang sangat besar atau bilangan bulat negatif yang sangat kecil, kalian bisa dengan mengamati angka-angka penyusunnya. Bilangan tersusun atas angka 0, 1, 2, 3, 4, 5, 6, 7, 8, dan 9.
                2. Pengurangan Bilangan Bulat
                Mia mempunya 3 boneka di rumahnya. Ketika ulang tahun, Mia mendapatkan hadiah sebanyak 4 boneka lagi. Berapakah boneka yang dimiliki Mia sekarang?',
                'file_path' => null,
                'file_name' => null,
            ],
            [
                'guru_pembelajaran_id' => 4,
                'title' => 'Bab 2 Himpunan',
                'description' => '1. Konsep Himpunan
                Suatu himpunan dapat dinyatakan dengan menyebutkan semua anggotanya yang dituliskan dalam kurung kurawal. Manakala banyak anggotanya sangat banyak, cara mendaftarkan ini biasanya dimodifikasi, yaitu diberi tanda tiga titik (“…”) dengan pengertian “dan seterusnya mengikuti pola”.
                2. Sifat-sifat Himpunan',
                'file_path' => null,
                'file_name' => null,
            ]
        ]);
    }
}
