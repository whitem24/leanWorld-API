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
        //
        DB::table('profiles')->insert([
            [
                'user_id'=>1,
                'username'=>'joeluisrr10',
                'profile_picture'=>'uploads/profiles/download.jfif',
                'first_name'=>'Joe',
                'last_name'=>'Rodríguez',
                'organization_name'=>'Nesher Academy',
                'location'=>'London',
                'email' => 'joeluisrr@gmail.com',
                'number'=>'6822830917',
                'birthday'=>'1996-04-01',
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now()
            ]
        
        ]);
    }
}
