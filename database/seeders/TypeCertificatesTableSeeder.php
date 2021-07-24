<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class TypeCertificatesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('type_certificates')->insert([
            [
                'description'=>'Certificate',
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now()
            ],
            [
                'description'=>'Certificate of completion',
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now()
            ]
        
        ]);
    }
}
