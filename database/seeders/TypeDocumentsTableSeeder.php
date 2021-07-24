<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class TypeDocumentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('type_documents')->insert([
            [  
                'description' => 'PDF',
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now()
            ],
            [  
                'description' => 'TXT',
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now()
            ],
            [  
                'description' => 'WORD',
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now()
            ], 
            
        
        ]);
    }
}
