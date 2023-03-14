<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PaymentTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   //payment_type 1 = QRIS, 2 = E-Money, 3 = Kartu Kredit, 4 = Virtual Acc, 5 = Transfer Bank
        DB::table('payment_type')->insert([
            [
                'payment_type_name' => 'QRIS'
            ],
            [
                'payment_type_name' => 'E-Money'
            ],
            [
                'payment_type_name' => 'Kartu Kredit'
            ],
            [
                'payment_type_name' => 'Virtual Account'
            ],
            [
                'payment_type_name' => 'Transfer Bank'
            ],
        ]);
    }
}
