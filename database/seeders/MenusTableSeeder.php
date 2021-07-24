<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use DB;

class MenusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('menus')->insert([
            [   
                
                'description'=>'Main Modules',
                'icon' => 'fas fa-atlas',
                'order' => '1',
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now()
            ],
            [   
                
                'description'=>'Functional Modules',
                'icon' => 'fas fa-archive',
                'order' => '2',
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now()
            ],
            [
                'description'=>'Security',
                'icon' => 'fas fa-fw fa-lock',
                'order' => '3',
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now()
            ],

        ]);
        //
    }
}
