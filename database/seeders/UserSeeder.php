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
            'name' => 'kasir',
            'email' => 'kasir@gmail.com',
            'password' => Hash::make('kasir'), 
            'role' => 'KASIR'
        ]);

        DB::table('users')->insert([
            'name' => 'manajer',
            'email' => 'manajer@gmail.com',
            'password' => Hash::make('manajer'), 
            'role' => 'MANAJER'
        ]);

        DB::table('users')->insert([
            'name' => 'customer',
            'email' => 'customer@gmail.com',
            'password' => Hash::make('customer'), 
            'role' => 'CUSTOMER'
        ]);
    }
}
