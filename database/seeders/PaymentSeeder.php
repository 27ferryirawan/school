<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   //payment_type_id 1 = QRIS, 2 = E-Money, 3 = Kartu Kredit, 4 = Virtual Acc, 5 = Transfer Bank
        DB::table('payment')->insert([
            [
                'payment_name' => 'QRIS',
                'payment_type_id' => 1,
                'is_available' => 1,
                'is_connected' => 0,
                'balance' => 0,
                'logo_path' => asset('images/payment/qris.svg')
            ],
            [
                'payment_name' => 'GoPay',
                'payment_type_id' => 2,
                'is_available' => 0,
                'is_connected' => 0,
                'balance' => 150000,
                'logo_path' => asset('images/payment/gopay.svg')
            ],
            [
                'payment_name' => 'Ovo',
                'payment_type_id' => 2,
                'is_available' => 0,
                'is_connected' => 0,
                'balance' => 0,
                'logo_path' => asset('images/payment/ovo.svg')
            ],
            [
                'payment_name' => 'Kartu Kredit',
                'payment_type_id' => 3,
                'is_available' => 0,
                'is_connected' => 0,
                'balance' => 0,
                'logo_path' => asset('images/payment/kartu_kredit.svg')
            ],
            [
                'payment_name' => 'Virtual Account BCA',
                'payment_type_id' => 4,
                'is_available' => 0,
                'is_connected' => 0,
                'balance' => 0,
                'logo_path' => asset('images/payment/bca.svg')
            ],
            [
                'payment_name' => 'Virtual Account Mandiri',
                'payment_type_id' => 4,
                'is_available' => 0,
                'is_connected' => 0,
                'balance' => 0,
                'logo_path' => asset('images/payment/mandiri.svg')
            ],
            [
                'payment_name' => 'Bank BCA',
                'payment_type_id' => 5,
                'is_available' => 0,
                'is_connected' => 0,
                'balance' => 0,
                'logo_path' => asset('images/payment/bca.svg')
            ],
        ]);
    }
}
