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
                'name' => 'kasir',
                'username' => 'kasir',
                'email' => 'kasir@gmail.com',
                'password' => Hash::make('kasir'), 
                'role' => 'KASIR'
            ],
            [
                'name' => 'manajer',
                'username' => 'manajer',
                'email' => 'manajer@gmail.com',
                'password' => Hash::make('manajer'), 
                'role' => 'MANAJER'
            ],
            [
                'name' => 'customer',
                'username' => 'customer',
                'email' => 'customer@gmail.com',
                'password' => Hash::make('customer'), 
                'role' => 'CUSTOMER'
            ]
        ]);
    }
}
