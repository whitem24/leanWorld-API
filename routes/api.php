<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
// LeanWorld Routes external API

/* Route::get('/courses','CoursesController@index'); */

/* Route::get('/users','UsersController@index');

Route::get('/user/{userId}/profile','UsersController@show'); */

/* Route::get('/user/{userId}','UsersController@user'); */



/* Route::get('/courses-users/{titleId}','CoursesController@coursesUsers');

Route::get('/course/{titleId}','CoursesController@show'); */

//Internal Routes

Route::post('register', 'Internal\AuthController@register');
Route::post('login', 'Internal\AuthController@login');
Route::post('password/email', 'Internal\ForgotPasswordController@sendResetLinkEmail');
Route::post('password/reset', 'Internal\ResetPasswordController@reset');
Route::middleware('auth:api')->group(function() {

    Route::get('/actions/users','ActionsController@get_users');
    Route::post('/actions/send-emails','ActionsController@send_email');
    Route::get('/user/modality','PaymentModalityController@index');
    Route::get('/user/modality/{userId}/{courseId}','PaymentModalityController@get_user_course_modality');
    Route::post('/modality/courses','PaymentModalityController@assignModality');
    

    //Permissions Routes
    
    Route::get('/permissions','Internal\PermissionsController@index');
    Route::get('/permissions/create','Internal\PermissionsController@create');
    Route::post('/permissions','Internal\PermissionsController@store');
    Route::get('/permissions/{permissionId}/edit','Internal\PermissionsController@edit');
    Route::get('/permissions/{permissionId}','Internal\PermissionsController@show');
    Route::put('/permissions/{permissionId}','Internal\PermissionsController@update');
    Route::delete('/permissions/{permissionId}','Internal\PermissionsController@destroy');

    //Roles Routes
    
    Route::get('/roles','Internal\RolesController@index');
    Route::get('/roles/create','Internal\RolesController@create');
    Route::post('/roles','Internal\RolesController@store');
    Route::get('/roles/{permissionId}/edit','Internal\RolesController@edit');
    Route::get('/roles/{permissionId}','Internal\RolesController@show');
    Route::put('/roles/{permissionId}','Internal\RolesController@update');
    Route::delete('/roles/{permissionId}','Internal\RolesController@destroy');

    //Menus Routes
    
    Route::get('/menus','Internal\MenusController@index');
    Route::post('/menus','Internal\MenusController@store');
    Route::get('/menus/{menuId}/edit','Internal\MenusController@edit');
    Route::get('/menus/{menuId}','Internal\MenusController@show');
    Route::put('/menus/{menuId}','Internal\MenusController@update');
    Route::delete('/menus/{menuId}','Internal\MenusController@destroy');

    //Type Courses Routes
    
    Route::get('/type-courses','Internal\TypeCoursesController@index');
    Route::post('/type-courses','Internal\TypeCoursesController@store');
    Route::get('/type-courses/{typeId}/edit','Internal\TypeCoursesController@edit');
    Route::get('/type-courses/{typeId}','Internal\TypeCoursesController@show');
    Route::put('/type-courses/{typeId}','Internal\TypeCoursesController@update');
    Route::delete('/type-courses/{typeId}','Internal\TypeCoursesController@destroy');

    //Activities Routes
    
    Route::get('/activities','Internal\ActivitiesController@index');
    Route::get('/activities/create','Internal\ActivitiesController@create');
    Route::post('/activities','Internal\ActivitiesController@store');
    Route::get('/activities/{typeId}/edit','Internal\ActivitiesController@edit');
    Route::get('/activities/{typeId}','Internal\ActivitiesController@show');
    Route::put('/activities/{typeId}','Internal\ActivitiesController@update');
    Route::delete('/activities/{typeId}','Internal\ActivitiesController@destroy');

    //Type Activities Routes
    
    Route::get('/type-activities','Internal\TypeActivitiesController@index');
    Route::post('/type-activities','Internal\TypeActivitiesController@store');
    Route::get('/type-activities/{typeId}/edit','Internal\TypeActivitiesController@edit');
    Route::get('/type-activities/{typeId}','Internal\TypeActivitiesController@show');
    Route::put('/type-activities/{typeId}','Internal\TypeActivitiesController@update');
    Route::delete('/type-activities/{typeId}','Internal\TypeActivitiesController@destroy');

    //Type Documents Routes
    
    Route::get('/type-documents','Internal\TypeDocumentsController@index');
    Route::post('/type-documents','Internal\TypeDocumentsController@store');
    Route::get('/type-documents/{typeId}/edit','Internal\TypeDocumentsController@edit');
    Route::get('/type-documents/{typeId}','Internal\TypeDocumentsController@show');
    Route::put('/type-documents/{typeId}','Internal\TypeDocumentsController@update');
    Route::delete('/type-documents/{typeId}','Internal\TypeDocumentsController@destroy');

    //Type Live Sessions Routes
    
    Route::get('/type-live-sessions','Internal\TypeLiveSessionsController@index');
    Route::post('/type-live-sessions','Internal\TypeLiveSessionsController@store');
    Route::get('/type-live-sessions/{typeId}/edit','Internal\TypeLiveSessionsController@edit');
    Route::get('/type-live-sessions/{typeId}','Internal\TypeLiveSessionsController@show');
    Route::put('/type-live-sessions/{typeId}','Internal\TypeLiveSessionsController@update');
    Route::delete('/type-live-sessions/{typeId}','Internal\TypeLiveSessionsController@destroy');

    //Type Multimedia Routes
    
    Route::get('/type-multimedia','Internal\TypeMultimediaController@index');
    Route::post('/type-multimedia','Internal\TypeMultimediaController@store');
    Route::get('/type-multimedia/{typeId}/edit','Internal\TypeMultimediaController@edit');
    Route::get('/type-multimedia/{typeId}','Internal\TypeMultimediaController@show');
    Route::put('/type-multimedia/{typeId}','Internal\TypeMultimediaController@update');
    Route::delete('/type-multimedia/{typeId}','Internal\TypeMultimediaController@destroy');

    //Type Questions Routes
    
    Route::get('/type-questions','Internal\TypeQuestionsController@index');
    Route::post('/type-questions','Internal\TypeQuestionsController@store');
    Route::get('/type-questions/{typeId}/edit','Internal\TypeQuestionsController@edit');
    Route::get('/type-questions/{typeId}','Internal\TypeQuestionsController@show');
    Route::put('/type-questions/{typeId}','Internal\TypeQuestionsController@update');
    Route::delete('/type-questions/{typeId}','Internal\TypeQuestionsController@destroy');

    //Type Questionnaires Routes
    
    Route::get('/type-questionnaires','Internal\TypeQuestionnairesController@index');
    Route::post('/type-questionnaires','Internal\TypeQuestionnairesController@store');
    Route::get('/type-questionnaires/{typeId}/edit','Internal\TypeQuestionnairesController@edit');
    Route::get('/type-questionnaires/{typeId}','Internal\TypeQuestionnairesController@show');
    Route::put('/type-questionnaires/{typeId}','Internal\TypeQuestionnairesController@update');
    Route::delete('/type-questionnaires/{typeId}','Internal\TypeQuestionnairesController@destroy');

    //Course Categories Routes
    
    Route::get('/categories','Internal\CategoriesController@index');
    Route::post('/categories','Internal\CategoriesController@store');
    Route::get('/categories/{id}/edit','Internal\CategoriesController@edit');
    Route::get('/categories/{id}','Internal\CategoriesController@show');
    Route::put('/categories/{id}','Internal\CategoriesController@update');
    Route::delete('/categories/{id}','Internal\CategoriesController@destroy');

    //Route::get('user/{userId}/detail', 'Internal\UserController@show');

    //Courses Routes
    Route::get('/courses/{slug}/edit','Internal\CoursesController@edit')->name('courses.edit');
    Route::get('/courses/{user_id}/{role_id}/{paginate?}/{search?}','Internal\CoursesController@index')/* ->middleware('throttle:coursesSearch') */;
    Route::post('/courses','Internal\CoursesController@store');
    /* Route::get('/courses/{id}','Internal\CoursesController@show'); */
    Route::put('/courses/{id}','Internal\CoursesController@update');
    Route::delete('/courses/{id}','Internal\CoursesController@destroy');

    //Chapters Routes
   /*  Route::get('/chapters/{slug}/edit','Internal\ChaptersController@edit')->name('chapters.edit');
    Route::get('/chapters/{user_id}/{role_id}/{paginate?}/{search?}','Internal\ChaptersController@index')/* ->middleware('throttle:chaptersSearch') */;
    Route::post('/chapters','Internal\ChaptersController@store'); 
    /* Route::get('/chapters/{id}','Internal\ChaptersController@show'); */
    Route::put('/chapters/{id}','Internal\ChaptersController@update');
    Route::delete('/chapters/{id}','Internal\ChaptersController@destroy'); 

    
    //Activities Chapters Routes
   /*  Route::get('/chapters/{slug}/edit','Internal\ChaptersController@edit')->name('chapters.edit');
    Route::get('/chapters/{user_id}/{role_id}/{paginate?}/{search?}','Internal\ChaptersController@index')/* ->middleware('throttle:chaptersSearch') */;
    Route::post('/activities-chapter','Internal\ChapterActivityController@store'); 
    /* Route::get('/chapters/{id}','Internal\ChapterActivityController@show'); */
    Route::put('/activities-chapter/{id}','Internal\ChapterActivityController@update');
    Route::delete('/activities-chapter/{id}','Internal\ChapterActivityController@destroy'); 

    // Courses Enrollment Routes
    Route::get('/courses-list/{paginate?}/{search?}','Internal\CoursesEnrollmentController@index')/* ->middleware('throttle:coursesSearch') */;
    

});
