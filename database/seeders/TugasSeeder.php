<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class TugasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tugas')->insert([
            [
                'guru_pembelajaran_id' => 1,
                'title' => 'Latihan Soal IPA',
                'description' => '1. Dalam melakukan sebuah eksperimen, langkah pertama yang akan dilakukan oleh seorang ilmuwan yaitu....
                a. Langkah-langkah metode ilmiah
                b. Langkah-langkah metode analisis
                c. Pelatihan keterampilan proses sains
                d. Hipotesis kemudian mempertanyakan hipotesis tersebut


                Perhatikan langkah-langkah percobaan berikut ini untuk menjawab pertanyaan no 2-4
                1. Potong kertas isap atau tisu dengan ukuran 4 x 12 cm
                2. Beri garis dengan spidol berwarna 2 cm dari ujung kertas
                3. Ambil beaker glass dan isi dengan air setinggi 1 cm
                4. Buatlah prediksi, terkait apa yang akan terjadi pada garis hitam tersebut ketika kertas dicelupkan ke dalam air
                5. Celupkan kertas dengan posisi garis berada sedikit di atas permukaan air

                2. Langkah-langkah yang dilakukan pada prosedur poin (4) pada percobaan tersebut adalah....

                a. Pengamatan
                b. Membuat inferensi
                c. Berhipotesis
                d. Mengomunikasikan


                3. Kegiatan pengamatan pada percobaan ini melibatkan panca indra...
                a. Telinga
                b. Lidah
                c. Kulit
                d. Mata


                4. Cara terbaik dalam menyampaikan hasil percobaan tersebut adalah dengan.....
                a. Membuat grafik perbandingan panjang setiap warna spidol
                b. Menampilkan kertas hasil percobaan secara langsung
                c. Membuat tabel berisi warna yang terbentuk dari setiap spidol
                d. Menceritakan langsung hasil percobaan tersebut


                5. Untuk mengukur volume pecahan genting yang bentuknya tidak beraturan, kita memerlukan....
                a. Stopwatch
                b. Mistar dan neraca
                c. Gelas ukur dan gelas berpancuran
                d. Jangka sorong dan mikrometer sekrup


                6. Tinggi badan Anto 155 cm. Berdasarkan pernyataan tersebut, yang termasuk besaran adalah .....
                a. Badan
                b. Tinggi
                c. 155
                d. cm


                7. Air garam termasuk ke dalam ....
                a. Senyawa
                b. Larutan
                c. Koloid
                d. Unsur


                8. Koloid terdiri dari .....
                a. Zat terdispersi dan zat pendispersi
                b. Zat pelarut dan zat terlarut
                c. Zat terdispersi dan zat pelarut
                d. Zat pelarut dan zat pendispersi


                9. Campuran yang paling mudah mengendap adalah .....
                a. larutan
                b. larutan ion
                c. koloid
                d. suspensi


                10. Air susu kemasan termasuk ke dalam....
                a. unsur
                b. senyawa
                c. campuran
                d. atom',
                'file_path' => null,
                'file_name' => null,
                'due_date' => '2023-12-17 20:00:00'
            ],
            [
                'guru_pembelajaran_id' => 4,
                'title' => 'Latihan Soal MTK',
                'description' => '1. Hasil dari -19 + 2 + 8 + 5 + (-9) = .....
                A. 29
                B. -13
                C. 13
                D. 10
                E. -29


                2. Urutan suhu di bawah ini yang merupakan urutan dari suhu besar ke suhu kecil adalah ....
                A. -8°C, 5°C, 2°C
                B. -28°C, 24°C, 20°C
                C. 30°C, 35°C, 20°C
                D. -3°C, -5°C, -8°C
                E. -8°C, -5°C, 2°C',
                'file_path' => null,
                'file_name' => null,
                'due_date' => '2023-12-17 21:00:00'
            ],
        ]);
    }
}
