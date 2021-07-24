<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
   
        $this->call([
          UsersTableSeeder::class,
          MenusTableSeeder::class,
          PermissionsTableSeeder::class,
          RolesTableSeeder::class,
          RolesPermissionsTableSeeder::class,
          UsersRolesTableSeeder::Class,
          LwPaymentModalitySeeder::class,
          ActivitiesTableSeeder::class,
          CategoriesTableSeeder::class,
          DiscountsTableSeeder::class,
          TypeCoursesTableSeeder::class,
          TypeCertificatesTableSeeder::class,
          TypeDocumentsTableSeeder::class,
          TypeLiveSessionsTableSeeder::class,
          TypeMultimediaTableSeeder::class,
          TypeQuestionnairesTableSeeder::class,
          TypeQuestionsTableSeeder::class,
          TypeActivitiesTableSeeder::Class,
          

        ]);
    }
}
