<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'name' => 'siswa',
                'username' => 'siswa',
                'email' => 'siswa@gmail.com',
                'password' => Hash::make('siswa'), 
                'role' => 'SISWA'
            ],
            [
                'name' => 'guru',
                'username' => 'guru',
                'email' => 'guru@gmail.com',
                'password' => Hash::make('guru'), 
                'role' => 'GURU'
            ],
            [
                'name' => 'admin',
                'username' => 'admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('admin'), 
                'role' => 'ADMIN'
            ],
            [
                'name' => 'siswa1',
                'username' => 'siswa1',
                'email' => 'siswa1@gmail.com',
                'password' => Hash::make('siswa1'), 
                'role' => 'SISWA'
            ],
        ]);
    }
}
