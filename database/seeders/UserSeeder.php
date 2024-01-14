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
                'name' => 'Dimas',
                'username' => 'dimas',
                'email' => 'dimas@gmail.com',
                'password' => Hash::make('dimas'), 
                'role' => 'SISWA'
            ],
            [
                'name' => 'Budi',
                'username' => 'budi',
                'email' => 'budi@gmail.com',
                'password' => Hash::make('budi'), 
                'role' => 'SISWA'
            ],
            [
                'name' => 'Jessicca',
                'username' => 'jessica',
                'email' => 'jessica@gmail.com',
                'password' => Hash::make('jessica'), 
                'role' => 'SISWA'
            ],
            [
                'name' => 'Putri',
                'username' => 'putri',
                'email' => 'putri@gmail.com',
                'password' => Hash::make('putri'), 
                'role' => 'SISWA'
            ],
            [
                'name' => 'Dika',
                'username' => 'dika',
                'email' => 'dika@gmail.com',
                'password' => Hash::make('dika'), 
                'role' => 'SISWA'
            ],
            [
                'name' => 'Ellaine',
                'username' => 'ellaine',
                'email' => 'ellaine@gmail.com',
                'password' => Hash::make('ellaine'), 
                'role' => 'SISWA'
            ],
            [
                'name' => 'Arthur',
                'username' => 'arthur',
                'email' => 'arthur@gmail.com',
                'password' => Hash::make('arthur'), 
                'role' => 'SISWA'
            ],
            [
                'name' => 'William',
                'username' => 'william',
                'email' => 'william@gmail.com',
                'password' => Hash::make('william'), 
                'role' => 'SISWA'
            ],
            [
                'name' => 'Linda',
                'username' => 'linda',
                'email' => 'linda@gmail.com',
                'password' => Hash::make('linda'), 
                'role' => 'GURU'
            ],
            [
                'name' => 'Dewi',
                'username' => 'dewi',
                'email' => 'dewi@gmail.com',
                'password' => Hash::make('dewi'), 
                'role' => 'GURU'
            ],
            [
                'name' => 'Nur',
                'username' => 'nur',
                'email' => 'nur@gmail.com',
                'password' => Hash::make('nur'), 
                'role' => 'GURU'
            ],
            [
                'name' => 'Admin',
                'username' => 'admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('admin'), 
                'role' => 'ADMIN'
            ],
        ]);
    }
}
