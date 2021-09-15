<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class RolesPermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles_has_permissions')->insert([
            [
                'permission_id'=>'1',
                'role_id' => '1',
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now()
            ],
            [
                'permission_id'=>'2',
                'role_id'=>'1',
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now()
            ],
            [
                'permission_id'=>'3',
                'role_id'=>'1',
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now()
            ],
            [
                'permission_id'=>'14',
                'role_id'=>'1',
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now()
            ],
            [
                'permission_id'=>'11',
                'role_id'=>'5',
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now()
            ],
            [
                'permission_id'=>'11',
                'role_id'=>'1',
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now()
            ],
            [
                'permission_id'=>'11',
                'role_id'=>'3',
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now()
            ],
            
            [
                'permission_id'=>'9',
                'role_id'=>'3',
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now()
            ],
            
            [
                'permission_id'=>'10',
                'role_id'=>'3',
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now()
            ],
            
            [
                'permission_id'=>'12',
                'role_id'=>'3',
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now()
            ],
            
            [
                'permission_id'=>'13',
                'role_id'=>'3',
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now()
            ],
        ]);
    }
}
