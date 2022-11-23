<?php

namespace Database\Seeders;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

use Illuminate\Database\Seeder;

class PaymentMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('payment_methods')->insert([
            [
                'description'=>'Paypal',
                'description_en'=>'Paypal',
                'fee' => '5',
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now()
            ],
            [
                'description'=>'Zelle',
                'description_en'=>'Paypal',
                'fee' => null,
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now()
            ],
            [
                'description'=>'Transferencia bancaria',
                'description_en'=>'Bank tranfer',
                'fee' => null,
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now()
            ],
            [
                'description'=>'Tarjeta de crédito',
                'description_en'=>'Credit Card',
                'fee' => null,
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now()
            ],
            [
                'description'=>'Pago móvil',
                'description_en'=>'Pago móvil',
                'fee' => null,
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now()
            ],
            [
                'description'=>'Binance',
                'description_en'=>'Binance',
                'fee' => null,
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now()
            ],
        ]);
    }
}
