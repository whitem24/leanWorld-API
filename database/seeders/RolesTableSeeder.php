<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert(array (
            0 =>
            array (            	
                'description'=>'Super-admin',
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now(),
            ),
            1 =>
            array (            	
                'description'=>'Admin',
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now(),
            ),
            2 =>
            array (            	
                'description'=>'Instructor',
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now(),
            ),
            3 =>
            array (            	
                'description'=>'Learner',
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now(),
            ),
            4 =>
            array (            	
                'description'=>'Guest',
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now(),
            )  
        ));
    }
}
