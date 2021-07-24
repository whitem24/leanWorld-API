<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;


class ActivitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('activities')->insert([
            [  
                'title'=>'Multimedia',
                'description' => '',
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now()
            ],
            [  
                'title'=>'Live Sessions',
                'description' => '',
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now()
            ],
            [  
                'title'=>'Questionnaires',
                'description' => '',
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now()
            ],
            [  
                'title'=>'Certificates',
                'description' => '',
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now()
            ],
            [  
                'title'=>'Contents',
                'description' => '',
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now()
            ], 
            [  
                'title'=>'Documents',
                'description' => '',
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now()
            ], 
            
        
        ]);
    }
}
