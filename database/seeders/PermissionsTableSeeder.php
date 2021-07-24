<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('permissions')->insert(array (
            0 =>
            array (
            	'id' => 1,
                'description'=>'Permissions',
                'parent_id' => NULL,
                'menu_id' => 3,
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now(),
            ),
            1 =>
            array (
            	'id' => 2,
                'description'=>'Roles',
                'parent_id' => Null,
                'menu_id' => 3,
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now(),
            ),
            2 =>
            array (
            	'id' => 3,
                'description'=>'Menus',
                'parent_id' => NULL,
                'menu_id' => 3,
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now(),
            ),
            3 =>
            array (
            	'id' => 4,
                'description'=>'Roles-edit',
                'parent_id' => 2,
                'menu_id' => NULL,
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now(),
            ),
            4 =>
            array (
            	'id' => 5,
                'description'=>'Permissions-create',
                'parent_id' => 1,
                'menu_id' => NULL,
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now(),
            ),
            5 =>
            array (
            	'id' => 6,
                'description'=>'Permissions-edit',
                'parent_id' => 1,
                'menu_id' => NULL,
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now(),
            ),
            6 =>
            array (
            	'id' => 7,
                'description'=>'Permissions-delete',
                'parent_id' => 1,
                'menu_id' => NULL,
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now(),
            ),
            7 =>
            array (
            	'id' => 8,
                'description'=>'Roles-create',
                'parent_id' => 2,
                'menu_id' => NULL,
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now(),
            ),
            8 =>
            array (
            	'id' => 9,
                'description'=>'Roles-delete',
                'parent_id' => 2,
                'menu_id' => NULL,
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now(),
            ),
            9 =>
            array (
            	'id' => 10,
                'description'=>'Menus-create',
                'parent_id' => 3,
                'menu_id' => NULL,
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now(),
            ),
            10 =>
            array (
            	'id' => 11,
                'description'=>'Menus-edit',
                'parent_id' => 3,
                'menu_id' => NULL,
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now(),
            ),
            11 =>
            array (
            	'id' => 12,
                'description'=>'Menus-delete',
                'parent_id' => 3,
                'menu_id' => NULL,
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now(),
            ),
            12 =>
            array (
            	'id' => 13,
                'description'=>'Permissions-show',
                'parent_id' => 1,
                'menu_id' => NULL,
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now(),
            ),
            13 =>
            array (
            	'id' => 14,
                'description'=>'Roles-show',
                'parent_id' => 2,
                'menu_id' => NULL,
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now(),
            ),
            14 =>
            array (
            	'id' => 15,
                'description'=>'Menus-show',
                'parent_id' => 3,
                'menu_id' => NULL,
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now(),
            ),
        ));
    }
}
