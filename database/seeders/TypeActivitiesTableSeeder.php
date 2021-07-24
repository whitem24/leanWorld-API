<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;


class TypeActivitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('type_activities')->insert([
            [
                'activity_id'=>'1',
                'activiteable_type'=>'Multimedia',
                'activiteable_id'=>'1',
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now()
            ],
            [
                'activity_id'=>'2',
                'activiteable_type'=>'Documents',
                'activiteable_id'=>'1',
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now()
            ],
            [
                'activity_id'=>'3',
                'activiteable_type'=>'Questionnaires',
                'activiteable_id'=>'1',
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now()
            ],
            [
                'activity_id'=>'4',
                'activiteable_type'=>'Live Sessions',
                'activiteable_id'=>'1',
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now()
            ],
            [
                'activity_id'=>'5',
                'activiteable_type'=>'Certificates',
                'activiteable_id'=>'1',
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now()
            ],
            [
                'activity_id'=>'6',
                'activiteable_type'=>'Questions',
                'activiteable_id'=>'1',
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now()
            ],
        
        ]);
    }
}
