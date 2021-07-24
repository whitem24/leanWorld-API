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
use App\Models\User;
use Illuminate\Support\Str;
//use App\Http\Traits\UpdateSessionTrait;

class CoursesController extends Controller
{
    //use UpdateSessionTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($user_id,$role,$paginate=null,$search=null) 
    {   
        //User_roles_courses
        $role_user = Role_has_user::where('user_id', $user_id)->where('role_id', $role)->first();
        $ids = User_role_course::where('user_role_id',$role_user->id)->pluck('course_id')->toArray();
        $courses = Course::with('chapters','categories','roles_has_users')
        ->when($search, function  ($q) use ($search) { 
            return $q->where(DB::raw('lower(title)'), 'like', '%' . strtolower(trim($search)) . '%');
        })
        ->whereIn('id', $ids)
        ->orderBy('created_at')
        ->paginate($paginate);
        foreach($courses as $c => $course){
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

        }
        return response()->json($courses, 200);
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
        $type_courses = Type_course::all();

        if($type_courses){
            return response()->json($type_courses, 200);
        }
        return response()->json(['message' => 'Type courses not found!'], 404);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {/* 
        $request->merge([
            'discount_price' => 50
        ]); */
        $validator = Validator::make($request->all(), [
            'title' => 'required|unique:courses,title,NULL,id,deleted_at,NULL',
			'description' => 'required',
			'cover' => 'required',
			'price' => 'required|numeric',
			/* 'video' => 'required', */
			'type_course_id' => 'required|numeric',
            'discount_price' => 'nullable|numeric|lt:price',
        ]);
        if($validator->fails()){
            return response()->json([
                'error' => $validator->messages()], 404);
        }else{
        	$title = $request->input('title');
			$description = $request->input('description');
            //upload image
			$cover = $request->input('cover');
            $extension = explode('/', explode(':', substr($cover, 0, strpos($cover, ';')))[1])[1];   // .jpg .png .pdf
            $replace = substr($cover, 0, strpos($cover, ',')+1); 
            // find substring fro replace here eg: data:image/png;base64,
            $image = str_replace($replace, '', $cover); 
            $image = str_replace(' ', '+', $image); 
            $imageName = time().'.'.$extension;
            Storage::disk('public')->put('/images/courses/'.$imageName, base64_decode($image));
            /* $imageName = time().'.'$cover->getClientOriginalExtension();
            $cover->move(public_path('/images/courses'), $imageName); */
            
			$price = $request->input('price');
			$discounted_price = $request->input('discount_price');
			$video = $request->input('video');
			$published = $request->input('published');
			$type_course_id = $request->input('type_course_id');
            $slug = Str::slug($title, '-');

        

            $course = new Course;
            $course->title = $title;
			$course->description = $description;
			$course->slug = $slug;
			$course->cover = $imageName;
			$course->discounted_price = $discounted_price;
			$course->price = $price;
			$course->video = $video;
			$course->published = $published;
			$course->type_course_id = $type_course_id;
            
            if($course->save()){
                $instructor = null;
                $user = null;
                //User_roles_courses
                $user_id = $request->input('user_id');
                $role = $request->input('role');
                if($role != 5){
                    $active = $role;
                    $role_user = Role_has_user::where('user_id', $user_id)->where('role_id', $role)->first();

                }else{
                    $active = 3;
                    $role_user = Role_has_user::where('user_id', $user_id)->where('role_id', 3)->first();
                    if(!$role_user)                
                        $role_user = new Role_has_user;
                        $role_user->user_id = $user_id;
                        $role_user->role_id = 3;
                        $role_user->save(); 
                    
                
                }
                /* $courses_role = User_role_course::where('user_role_id',$role_user->id)->get(); */
                /* $role_instructor_user = Role_has_user::where('user_id', $user_id)->where('role_id', 3)->first(); */
                
                
                $user = User::updateSession($user_id)->first();
                $role_user_id = $role_user->id;      
                $course->roles_has_users()->attach($role_user_id);
                return response()->json(['message' => 'Successfully created course!', 
                                          'active' => $active,
                                          'user' => $user], 200);
            }
            return response()->json(['message' => 'Course was not created!'], 404);

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $course = Course::with('type_courses')->where('id', $id)->first();
        
        if($course){
        	return response()->json($course, 200);
        }
        return response()->json(['message' => 'Course not found!'], 404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        
        $course = Course::with('type_course','categories','discounts','chapters.certificates')->where('slug', $slug)->first();
        $type_courses = Type_course::all();
        $categories = Category::all();


        if($course){
            return response()->json(['course' => $course,'categories' => $categories, 'type_courses' => $type_courses], 200);
        }
        return response()->json(['message' => 'Course not found!'], 404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $slug)
    {
        $course = Course::where('slug', $slug)->first();
        $validator = Validator::make($request->all(), [
            'title' => 'required|unique:courses,title,'.$course->id.',id,deleted_at,NULL',
			'description' => 'required',
			/* 'cover' => 'required', */
			'price' => 'required|numeric',
			'video' => 'nullable',
			'type_course_id' => 'required|numeric',
            'discount_price' => 'nullable|numeric|lt:price',

            
        ]);
        if($validator->fails()){
            return response()->json([
                'error' => $validator->messages()], 404);
        }else{

            $title = $request->input('title');
			$description = $request->input('description');
			$price = $request->input('price');
			$discounted_price = $request->input('discount_price');
			$video = $request->input('video');
			$published = $request->input('published');
			$type_course_id = $request->input('type_course_id');

			/* $course = Course::find($id); */
            $course->title = $title;
			$course->description = $description;
			$course->slug = Str::slug($title, '-');
			$cover = $request->input('cover');
			$categories = $request->input('catValues');
            if($categories != '' && $categories){
                $course->categories()->sync($categories);
            }
            if($cover != ''){
                $extension = explode('/', explode(':', substr($cover, 0, strpos($cover, ';')))[1])[1];   // .jpg .png .pdf
                $replace = substr($cover, 0, strpos($cover, ',')+1); 
                // find substring fro replace here eg: data:image/png;base64,
                $image = str_replace($replace, '', $cover); 
                $image = str_replace(' ', '+', $image); 
                $imageName = time().'.'.$extension;
                Storage::disk('public')->put('/images/courses/'.$imageName, base64_decode($image));                
                Storage::disk('public')->delete('/images/courses/'.$course->cover);
			    $course->cover = $imageName;
            }
			$course->price = $price;
			$course->discounted_price = $discounted_price;
			$course->video = $video;
			$course->published = $published;
			$course->type_course_id = $type_course_id;

            if($course->save()){
                return response()->json(['message' => 'Successfully updated Course!'], 200);
            }
            return response()->json(['message' => 'Course was not updated!'], 404);

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $course = Course::with('roles_has_users')->find($id);
        foreach($course->roles_has_users as $r => $role_user_id){
            $course->may_delete = 1;
            $result = array();
            if($role_user_id->role_id == 4 || $role_user_id->role_id == 2)  
            {
                $result[$r] = 0;
            }

                         

        }
        if(in_array(0, $result)){
            $course->may_delete = 0; 

        }
        if($course->may_delete == 0){
            return response()->json(['error' => 'Este curso está siendo usado y no puede ser eliminado'], 400);
        }
        if($course->delete()){
            return response()->json(['message' => 'Successfully deleted Course!'], 200);
        }
        return response()->json(['error' => 'Course was not deleted'], 404);
    }
}
