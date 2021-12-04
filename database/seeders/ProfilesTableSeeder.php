<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ProfilesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        DB::table('profiles')->insert([
            [
                // 'name'=>'Joe Rodríguez',
                'email' => 'joeluisrr@gmail.com',
                'userid' => 1,
                'imagelink' => "default.png",
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now()
            ]
        
        ]);
    
    }
}
