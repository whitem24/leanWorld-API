<?php

namespace App\Http\Controllers\Internal;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Validator;
use DB;
use App\Models\Type_course;
use App\Models\Course;
use App\Models\User_role_course;
use App\Models\Role_has_user;
use App\Models\Category;
use App\Models\Activity;
use App\Models\User;
use Illuminate\Support\Str;

class CoursesEnrollmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($paginate=null,$search=null) 
    {   
        //User_roles_courses
    /*     $role_user = Role_has_user::where('user_id', $user_id)->where('role_id', $role)->first();
        $ids = User_role_course::where('user_role_id',$role_user->id)->pluck('course_id')->toArray(); */
        $courses = Course::with('chapters','categories','roles_has_users','chapters.activities')
        ->when($search, function  ($q) use ($search) { 
            return $q->where(DB::raw('lower(title)'), 'like', '%' . strtolower(trim($search)) . '%');
        })/* 
        ->whereIn('id', $ids) */
        ->orderBy('created_at')
        ->where('published', 1)
        ->paginate($paginate);
       /*  return response()->json($courses, 200); */
        /* foreach($courses as $c => $course){
           $chapters_count[$c] = $course->chapters->count();
           $categories_count[$c] = $course->categories->count();
           $course->may_delete = 1;
           $result = array();
           foreach($course->roles_has_users as $r => $role_user_id){
            if($role_user_id->role_id == 4 || $role_user_id->role_id == 2)  
            {
                $result[$r] = 0;
            }

                         

            }
            if(in_array(0, $result)){
                $course->may_delete = 0; 

            }
           
           $course->chapters_count =  $chapters_count[$c];
           $course->categories_count =  $categories_count[$c];

        } */
        /* return response()->json($activities, 200); */
        if($courses){
            return response()->json($courses, 200);
        }
        return response()->json(['message' => 'Courses not found!'], 404);
    }

    public function my_courses($user_id,$paginate=null,$search=null) 
    {   
        //User_roles
        /* $user_id = $request->input('user_id'); */
        $role = 4;
        $role_user = Role_has_user::where('user_id', $user_id)->where('role_id', $role)->first();

        //User_roles_courses
        $ids = User_role_course::where('user_role_id',$role_user->id)->pluck('course_id')->toArray(); 
   
        $courses = Course::with('chapters','categories','roles_has_users','chapters.activities')
        ->when($search, function  ($q) use ($search) { 
            return $q->where(DB::raw('lower(title)'), 'like', '%' . strtolower(trim($search)) . '%');
        })
        ->whereIn('id', $ids)
        ->orderBy('created_at')
        ->where('published', 1)
        ->paginate($paginate);
    
        if($courses){
            return response()->json($courses, 200);
        }
        return response()->json(['message' => 'Courses not found!'], 404);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
