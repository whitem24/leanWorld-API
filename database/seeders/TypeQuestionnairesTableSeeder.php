<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;


class TypeQuestionnairesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('type_questionnaires')->insert([
            [  
                'description' => 'Quizz',
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now()
            ],
            [  
                'description' => 'Exam',
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now()
            ],
            [  
                'description' => 'Assignment',
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now()
            ], 
            [  
                'description' => 'File Assignment',
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now()
            ], 
            
        
        ]);
    }
}
