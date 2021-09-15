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
                'title'=>'Video',
                'description' => '',
                'type_activity_id' => 1,
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now()
            ],
            [  
                'title'=>'E-book',
                'description' => '',
                'type_activity_id' => 1,
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now()
            ],
            [  
                'title'=>'Youtube',
                'description' => '',
                'type_activity_id' => 1,
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now()
            ],
            [  
                'title'=>'SoundCloud',
                'description' => '',
                'type_activity_id' => 1,
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now()
            ],
            [  
                'title'=>'Audio',
                'description' => '',
                'type_activity_id' => 1,
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now()
            ], 
            [  
                'title'=>'PDF',
                'description' => '',
                'type_activity_id' => 2,
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now()
            ], 
            [  
                'title'=>'TXT',
                'description' => '',
                'type_activity_id' => 2,
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now()
            ],
            [  
                'title'=>'WORD',
                'description' => '',
                'type_activity_id' => 2,
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now()
            ],
            [  
                'title'=>'Zoom Meeting',
                'description' => '',
                'type_activity_id' => 4,
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now()
            ],
            [  
                'title'=>'Zoom Webinar',
                'description' => '',
                'type_activity_id' => 4,
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now()
            ],
            [  
                'title'=>'Webex Meeting',
                'description' => '',
                'type_activity_id' => 4,
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now()
            ], 
            [  
                'title'=>'Quizz',
                'description' => '',
                'type_activity_id' => 3,
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now()
            ], 
            [  
                'title'=>'Exam',
                'description' => '',
                'type_activity_id' => 3,
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now()
            ],
            [  
                'title'=>'Assignment',
                'description' => '',
                'type_activity_id' => 3,
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now()
            ],
            [  
                'title'=>'File Assignment',
                'description' => '',
                'type_activity_id' => 3,
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now()
            ],
            [  
                'title'=>'Certificate',
                'description' => '',
                'type_activity_id' => 5,
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now()
            ],
            [  
                'title'=>'Certificate of completion',
                'description' => '',
                'type_activity_id' => 5,
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now()
            ], 
            
        
        ]);
    }
}
