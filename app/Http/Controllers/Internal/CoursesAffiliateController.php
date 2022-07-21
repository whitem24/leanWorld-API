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

class CoursesAffiliateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($paginate=null,$search=null) 
    {
        $courses = Course::with('chapters','categories','roles_has_users','chapters.activities')
        ->when($search, function  ($q) use ($search) { 
            return $q->where(DB::raw('lower(title)'), 'like', '%' . strtolower(trim($search)) . '%');
        })
        ->orderBy('created_at')
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
