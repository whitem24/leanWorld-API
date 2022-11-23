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
                'description' => 'Permissions',                
                'description_en'=>'Permissions',
                'description_es'=>'Permisos',
                'url'=>'Permissions',
                'parent_id' => NULL,
                'menu_id' => 3,
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now(),
            ),
            1 =>
            array (
                'id' => 2,
                'description' => 'Roles',                
                'description_en'=>'Roles',
                'description_es'=>'Roles',
                'url'=>'Roles',
                'parent_id' => NULL,
                'menu_id' => 3,
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now(),
            ),
            2 =>
            array (
                'id' => 3,
                'description' => 'Menus',                
                'description_en'=>'Menus',
                'description_es'=>'Menús',
                'url'=>'Menus',
                'parent_id' => NULL,
                'menu_id' => 3,
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now(),
            ),
            3 =>
            array (
                'id' => 4,
                'description' => 'Type-courses',                
                'description_en'=>'Types of courses',
                'description_es'=>'Tipos de curso',
                'url'=>'Type-courses',
                'parent_id' => NULL,
                'menu_id' => 1,
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now(),
            ),
            4 =>
            array (
                'id' => 5,
                'description' => 'Activities',                
                'description_en'=>'Activities',
                'description_es'=>'Actividades',
                'url'=>'Activities',
                'parent_id' => NULL,
                'menu_id' => 1,
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now(),
            ),
            5 =>
            array (
                'id' => 6, 
                'description' => 'Type-activities',               
                'description_en'=>'Types of activities',
                'description_es'=>'Tipos de actividad',
                'url'=>'Type-activities',
                'parent_id' => NULL,
                'menu_id' => 1,
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now(),
            ),
            6 =>
            array (
                'id' => 7,
                'description' => 'Type-questions',
                'description_en'=>'Types of questions',
                'description_es'=>'Tipos de preguntas',
                'url'=>'Type-questions',
                'parent_id' => NULL,
                'menu_id' => 1,
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now(),
            ),
            7 =>
            array (
                'id' => 8,
                'description' => 'Categories',
                'description_en'=>'Categories',
                'description_es'=>'Categorías',
                'url'=>'Categories',
                'parent_id' => NULL,
                'menu_id' => 1,
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now(),
            ),
            8 =>
            array (
                'id' => 9,
                'description' => 'Courses',
                'description_en'=>'Courses',
                'description_es'=>'Cursos',
                'url'=>'Courses',
                'parent_id' => NULL,
                'menu_id' => 1,
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now(),
            ),
            9 =>
            array (
                'id' => 10,
                'description' => 'Courses-edit',
                'description_en'=>'Courses-edit',
                'description_es'=>'Courses-edit',
                'url'=>'courses/edit',
                'parent_id' => 9,
                'menu_id' => NULL,
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now(),
            ),
            10 =>
            array (
                'id' => 11,
                'description' => 'Courses-create',
                'description_en'=>'Courses-create',
                'description_es'=>'Courses-create',
                'url'=>'courses/create',
                'parent_id' => 9,
                'menu_id' => NULL,
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now(),
            ),
            11 =>
            array (
                'id' => 12,
                'description' => 'Courses-delete',
                'description_en'=>'Courses-delete',
                'description_es'=>'Courses-delete',
                'url'=>'courses/delete',
                'parent_id' => 9,
                'menu_id' => NULL,
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now(),
            ),
            12 =>
            array (
                'id' => 13,
                'description' => 'Courses-show',
                'description_en'=>'Courses-show',
                'description_es'=>'Courses-show',
                'url'=>'courses/show',
                'parent_id' => 9,
                'menu_id' => NULL,
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now(),
            ),
            13 =>
            array (
                'id' => 14,
                'description' => 'Roles-edit',
                'description_en'=>'Roles-edit',
                'description_es'=>'Roles-edit',
                'url'=>'roles/edit',
                'parent_id' => 2,
                'menu_id' => NULL,
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now(),
            ),
            14 =>
            array (
                'id' => 15,
                'description' => 'Permissions-create',
                'description_en'=>'Permissions-create',
                'description_es'=>'Permissions-create',
                'url'=>'permissions/create',
                'parent_id' => 1,
                'menu_id' => NULL,
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now(),
            ),
            15 =>
            array (
                'id' => 16,
                'description' => 'Permissions-edit',
                'description_en'=>'Permissions-edit',
                'description_es'=>'Permissions-edit',
                'url'=>'permissions/edit',
                'parent_id' => 1,
                'menu_id' => NULL,
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now(),
            ),
            16 =>
            array (
                'id' => 17,
                'description' => 'Permissions-delete',
                'description_en'=>'Permissions-delete',
                'description_es'=>'Permissions-delete',
                'url'=>'permissions/delete',
                'parent_id' => 1,
                'menu_id' => NULL,
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now(),
            ),
            17 =>
            array (
                'id' => 18,
                'description' => 'Roles-create',
                'description_en'=>'Roles-create',
                'description_es'=>'Roles-create',
                'url'=>'roles/create',
                'parent_id' => 2,
                'menu_id' => NULL,
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now(),
            ),
            18 =>
            array (
                'id' => 19,
                'description' => 'Roles-delete',
                'description_en'=>'Roles-delete',
                'description_es'=>'Roles-delete',
                'url'=>'roles/delete',
                'parent_id' => 2,
                'menu_id' => NULL,
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now(),
            ),
            19 =>
            array (
                'id' => 20,
                'description' => 'Menus-create',
                'description_en'=>'Menus-create',
                'description_es'=>'Menus-create',
                'url'=>'menus/create',
                'parent_id' => 3,
                'menu_id' => NULL,
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now(),
            ),
            20 =>
            array (
                'id' => 21,
                'description' => 'Menus-edit',
                'description_en'=>'Menus-edit',
                'description_es'=>'Menus-edit',
                'url'=>'menus/edit',
                'parent_id' => 3,
                'menu_id' => NULL,
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now(),
            ),
            21 =>
            array (
                'id' => 22,
                'description' => 'Menus-delete',
                'description_en'=>'Menus-delete',
                'description_es'=>'Menus-delete',
                'url'=>'menus/delete',
                'parent_id' => 3,
                'menu_id' => NULL,
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now(),
            ),
            22 =>
            array (
                'id' => 23,
                'description' =>'Permissions-show',
                'description_en'=>'Permissions-show',
                'description_es'=>'Permissions-show',
                'url'=>'permissions/show',
                'parent_id' => 1,
                'menu_id' => NULL,
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now(),
            ),
            23 =>
            array (
                'id' => 24,
                'description' => 'Roles-show',
                'description_en'=>'Roles-show',
                'description_es'=>'Roles-show',
                'url'=>'roles/show',
                'parent_id' => 2,
                'menu_id' => NULL,
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now(),
            ),
            24 =>
            array (
                'id' => 25,
                'description' => 'Menus-show',
                'description_en'=>'Menus-show',
                'description_es'=>'Menus-show',
                'url'=>'menus/show',
                'parent_id' => 3,
                'menu_id' => NULL,
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now(),
            ),
            25 =>
            array (
                'id' => 26,
                'description' => 'Courses-enroll',
                'description_en'=>'Available Courses',
                'description_es'=>'Cursos Disponibles',
                'url'=>'courses-enroll',
                'parent_id' => NULL,
                'menu_id' => 1,
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now(),
            ),
            26 =>
            array (
                'id' => 27,
                'description' => 'Courses-enroll-affiliate',
                'description_en'=>'View Affiliate Courses',
                'description_es'=>'Ver Cursos Afiliado',
                'url'=>'courses-enroll-affiliate',
                'parent_id' => NULL,
                'menu_id' => 1,
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now(),
            ),
            27 =>
            array (
                'id' => 28,
                'description' => 'My-courses',
                'description_en'=>'My Courses',
                'description_es'=>'Mis Cursos',
                'url'=>'my-courses',
                'parent_id' => NULL,
                'menu_id' => 1,
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now(),
            ),
            /* 26 =>
            array (
                'id' => 27,
                'description' => 'Courses-enroll-buy',
                'description_en'=>'Menus-show',
                'description_es'=>'Menus-show',
                'parent_id' => 3,
                'menu_id' => NULL,
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now(),
            ),
            24 =>
            array (
                'id' => 25,
                'description' => 'Menus-show',
                'description_en'=>'Menus-show',
                'description_es'=>'Menus-show',
                'parent_id' => 3,
                'menu_id' => NULL,
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now(),
            ),
            24 =>
            array (
                'id' => 25,
                'description' => 'Menus-show',
                'description_en'=>'Menus-show',
                'description_es'=>'Menus-show',
                'parent_id' => 3,
                'menu_id' => NULL,
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now(),
            ), */
        ));
    }
}
