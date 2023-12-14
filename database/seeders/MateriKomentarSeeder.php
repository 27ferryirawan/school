<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class MateriKomentarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('materi_komentar')->insert([
            [
                'materi_id' => 1,
                'guru_siswa_id' => 1,
                'role' => 'SISWA',
                'description' => 'Hari Monyet Sedunia ini kemudian dirayakan dengan misi untuk melestarikan spesies monyet dan segala satwa yang berkaitan, termasuk primata seperti kera, tarsius dan lemur. Nah, itulah daftar perayaan yang diperingati pada tanggal 14 Desember secara nasional dan global. Semoga bermanfaat ya, detikers!',
                'created_at' => '2023-12-14 20:00:00',
            ],
            [
                'materi_id' => 1,
                'guru_siswa_id' => 1,
                'role' => 'SISWA',
                'description' => 'Hari Monyet Sedunia ini kemudian dirayakan ',
                'created_at' => '2023-12-14 20:00:01',
            ],
            [
                'materi_id' => 1,
                'guru_siswa_id' => 4,
                'role' => 'SISWA',
                'description' => 'Hari Monyet Sedunia',
                'created_at' => '2023-12-14 20:00:02',
            ]
        ]);
    }
}
