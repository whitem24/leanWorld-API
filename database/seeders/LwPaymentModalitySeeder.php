<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class LwPaymentModalitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('lw_payment_modalities')->insert([
            [
                'description'=>'75% Instructor - 25% Nesher',
                'company_percent' => 25,
                'instructor_percent' => 75,
                'affiliate_percent' => null,
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now()
            ],
            [
                'description'=>'25% Instructor - 75% Nesher',
                'company_percent' => 75,
                'instructor_percent' => 25,
                'affiliate_percent' => null,
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now()
            ],
            [
                'description'=>'50% Instructor - 50% Nesher',
                'company_percent' => 50,
                'instructor_percent' => 50,
                'affiliate_percent' => null,
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now()
            ],
            [
                'description'=>'35% Nesher - 35% Instructor - 30% Afiliado',
                'company_percent' => 35,
                'instructor_percent' => 35,
                'affiliate_percent' => 30,
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now()
            ]
        
        ]);
    }
}
