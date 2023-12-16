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
                'tugas_id' => 12,
                'siswa_id' => 1,
                'description' => 'Hari Monyet Sedunia ini kemudian dirayakan dengan misi untuk melestarikan spesies monyet dan segala satwa yang berkaitan, termasuk primata seperti kera, tarsius dan lemur. Nah, itulah daftar perayaan yang diperingati pada tanggal 14 Desember secara nasional dan global. Semoga bermanfaat ya, detikers!',
                'file_path' => 'file/1093929252_091223-1702738123.pdf',
                'file_name' => '1093929252_091223.pdf'
            ],
        ]);
    }
}
