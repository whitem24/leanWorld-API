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
                
                'description'=>'Main Options',
                'description_en'=>'Main Options',
                'description_es'=>'Opciones Principales',
                'icon' => 'fas fa-atlas',
                'order' => '1',
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now()
            ],
            [   
                
                'description'=>'Functional Modules',
                'description_en'=>'Functional Modules',
                'description_es'=>'Módulos Funcionales',
                'icon' => 'fas fa-archive',
                'order' => '2',
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now()
            ],
            [
                'description'=>'Security',
                'description_en'=>'Security',
                'description_es'=>'Seguridad',
                'icon' => 'fas fa-fw fa-lock',
                'order' => '3',
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now()
            ],

        ]);
        //
    }
}
