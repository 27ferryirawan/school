<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call([
             UserSeeder::class,
             TahunAjaranSeeder::class,
             KelasSeeder::class,
             MataPelajaranSeeder::class,
             SiswaSeeder::class,
             GuruSeeder::class,
             SiswaNilaiSeeder::class,
             GuruPembelajaranSeeder::class,
             JenisUjianSeeder::class,
             JenisSoalSeeder::class,
             UjianSeeder::class,
             UjianDetailSeeder::class,
             MateriKomentarSeeder::class
             UjianDetailPilganSeeder::class,
        ]);
    }
}
