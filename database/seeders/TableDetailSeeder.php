<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TableDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   //status 0 = available, 1 = on reserve, 2 = guest in 
        // DB::table('table_detail')->insert([
        //     [
        //         'id' => 'out1',
        //         'table_name' => 'out 1',
        //         'price' => 15000,
        //         'status' => 0,
        //         'created_by' => 2,
        //         'updated_by' => 2,
        //         'created_at' => '2023-09-07 00:00:00',
        //         'updated_at' => '2023-09-07 00:00:00'
        //     ],
        //     [
        //         'id' => 'out2',
        //         'table_name' => 'out 2',
        //         'price' => 15000,
        //         'status' => 0,
        //         'created_by' => 2,
        //         'updated_by' => 2,
        //         'created_at' => '2023-09-07 00:00:00',
        //         'updated_at' => '2023-09-07 00:00:00'
        //     ],
        //     [
        //         'id' => 'out3',
        //         'table_name' => 'out 3',
        //         'price' => 15000,
        //         'status' => 0,
        //         'created_by' => 2,
        //         'updated_by' => 2,
        //         'created_at' => '2023-09-07 00:00:00',
        //         'updated_at' => '2023-09-07 00:00:00'
        //     ],
        //     [
        //         'id' => 'out4',
        //         'table_name' => 'out 4',
        //         'price' => 15000,
        //         'status' => 0,
        //         'created_by' => 2,
        //         'updated_by' => 2,
        //         'created_at' => '2023-09-07 00:00:00',
        //         'updated_at' => '2023-09-07 00:00:00'
        //     ],
        //     [
        //         'id' => 'out5',
        //         'table_name' => 'out 5',
        //         'price' => 15000,
        //         'status' => 0,
        //         'created_by' => 2,
        //         'updated_by' => 2,
        //         'created_at' => '2023-09-07 00:00:00',
        //         'updated_at' => '2023-09-07 00:00:00'
        //     ],
        //     [
        //         'id' => 'out6',
        //         'table_name' => 'out 6',
        //         'price' => 15000,
        //         'status' => 0,
        //         'created_by' => 2,
        //         'updated_by' => 2,
        //         'created_at' => '2023-09-07 00:00:00',
        //         'updated_at' => '2023-09-07 00:00:00'
        //     ],
        //     [
        //         'id' => 'out7',
        //         'table_name' => 'out 7',
        //         'price' => 15000,
        //         'status' => 0,
        //         'created_by' => 2,
        //         'updated_by' => 2,
        //         'created_at' => '2023-09-07 00:00:00',
        //         'updated_at' => '2023-09-07 00:00:00'
        //     ],
        //     [
        //         'id' => 'out8',
        //         'table_name' => 'out 8',
        //         'price' => 15000,
        //         'status' => 0,
        //         'created_by' => 2,
        //         'updated_by' => 2,
        //         'created_at' => '2023-09-07 00:00:00',
        //         'updated_at' => '2023-09-07 00:00:00'
        //     ],
        //     [
        //         'id' => 'out9',
        //         'table_name' => 'out 9',
        //         'price' => 15000,
        //         'status' => 0,
        //         'created_by' => 2,
        //         'updated_by' => 2,
        //         'created_at' => '2023-09-07 00:00:00',
        //         'updated_at' => '2023-09-07 00:00:00'
        //     ],
        //     [
        //         'id' => 'out10',
        //         'table_name' => 'out 10',
        //         'price' => 15000,
        //         'status' => 1,
        //         'created_by' => 2,
        //         'updated_by' => 2,
        //         'created_at' => '2023-09-07 00:00:00',
        //         'updated_at' => '2023-09-07 00:00:00'
        //     ],
        //     [
        //         'id' => 'out11',
        //         'table_name' => 'out 11',
        //         'price' => 15000,
        //         'status' => 0,
        //         'created_by' => 2,
        //         'updated_by' => 2,
        //         'created_at' => '2023-09-07 00:00:00',
        //         'updated_at' => '2023-09-07 00:00:00'
        //     ],
        //     [
        //         'id' => 'out12',
        //         'table_name' => 'out 12',
        //         'price' => 15000,
        //         'status' => 0,
        //         'created_by' => 2,
        //         'updated_by' => 2,
        //         'created_at' => '2023-09-07 00:00:00',
        //         'updated_at' => '2023-09-07 00:00:00'
        //     ],
        //     [
        //         'id' => 'long1',
        //         'table_name' => 'long 1',
        //         'price' => 15000,
        //         'status' => 2,
        //         'created_by' => 2,
        //         'updated_by' => 2,
        //         'created_at' => '2023-09-07 00:00:00',
        //         'updated_at' => '2023-09-07 00:00:00'
        //     ],
        //     [
        //         'id' => 'long2',
        //         'table_name' => 'long 2',
        //         'price' => 15000,
        //         'status' => 0,
        //         'created_by' => 2,
        //         'updated_by' => 2,
        //         'created_at' => '2023-09-07 00:00:00',
        //         'updated_at' => '2023-09-07 00:00:00'
        //     ],
        //     [
        //         'id' => 'long3',
        //         'table_name' => 'long 3',
        //         'price' => 15000,
        //         'status' => 0,
        //         'created_by' => 2,
        //         'updated_by' => 2,
        //         'created_at' => '2023-09-07 00:00:00',
        //         'updated_at' => '2023-09-07 00:00:00'
        //     ],
        //     [
        //         'id' => 'long4',
        //         'table_name' => 'long 4',
        //         'price' => 15000,
        //         'status' => 0,
        //         'created_by' => 2,
        //         'updated_by' => 2,
        //         'created_at' => '2023-09-07 00:00:00',
        //         'updated_at' => '2023-09-07 00:00:00'
        //     ],
        //     [
        //         'id' => 'sofa1',
        //         'table_name' => 'sofa 1',
        //         'price' => 15000,
        //         'status' => 0,
        //         'created_by' => 2,
        //         'updated_by' => 2,
        //         'created_at' => '2023-09-07 00:00:00',
        //         'updated_at' => '2023-09-07 00:00:00'
        //     ],
        //     [
        //         'id' => 'sofa2',
        //         'table_name' => 'sofa 2',
        //         'price' => 15000,
        //         'status' => 0,
        //         'created_by' => 2,
        //         'updated_by' => 2,
        //         'created_at' => '2023-09-07 00:00:00',
        //         'updated_at' => '2023-09-07 00:00:00'
        //     ],
        //     [
        //         'id' => 'in1',
        //         'table_name' => 'in 1',
        //         'price' => 15000,
        //         'status' => 0,
        //         'created_by' => 2,
        //         'updated_by' => 2,
        //         'created_at' => '2023-09-07 00:00:00',
        //         'updated_at' => '2023-09-07 00:00:00'
        //     ],
        //     [
        //         'id' => 'in2',
        //         'table_name' => 'in 2',
        //         'price' => 15000,
        //         'status' => 0,
        //         'created_by' => 2,
        //         'updated_by' => 2,
        //         'created_at' => '2023-09-07 00:00:00',
        //         'updated_at' => '2023-09-07 00:00:00'
        //     ],
        //     [
        //         'id' => 'in3',
        //         'table_name' => 'in 3',
        //         'price' => 15000,
        //         'status' => 0,
        //         'created_by' => 2,
        //         'updated_by' => 2,
        //         'created_at' => '2023-09-07 00:00:00',
        //         'updated_at' => '2023-09-07 00:00:00'
        //     ],
        //     [
        //         'id' => 'in4',
        //         'table_name' => 'in 4',
        //         'price' => 15000,
        //         'status' => 1,
        //         'created_by' => 2,
        //         'updated_by' => 2,
        //         'created_at' => '2023-09-07 00:00:00',
        //         'updated_at' => '2023-09-07 00:00:00'
        //     ],
        //     [
        //         'id' => 'in5',
        //         'table_name' => 'in 5',
        //         'price' => 15000,
        //         'status' => 2,
        //         'created_by' => 2,
        //         'updated_by' => 2,
        //         'created_at' => '2023-09-07 00:00:00',
        //         'updated_at' => '2023-09-07 00:00:00'
        //     ],
        //     [
        //         'id' => 'in6',
        //         'table_name' => 'in 6',
        //         'price' => 15000,
        //         'status' => 0,
        //         'created_by' => 2,
        //         'updated_by' => 2,
        //         'created_at' => '2023-09-07 00:00:00',
        //         'updated_at' => '2023-09-07 00:00:00'
        //     ],
        // ]);
    }
}
