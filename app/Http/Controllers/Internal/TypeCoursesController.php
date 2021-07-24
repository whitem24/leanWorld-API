<?php

namespace App\Http\Controllers\Internal;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use DB;
use App\Models\Type_course;

class TypeCoursesController extends Controller
{
    /**
     * Display a listing of the type of course.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $types = Type_course::all();

        if($types){
            return response()->json($types, 200);
        }
        return response()->json(['message' => 'Type courses not found!'], 404);
    
    }

    /**
     * Show the form for creating a new type of course.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created type of course in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'description' => 'required|unique:type_courses,description,NULL,id,deleted_at,NULL',
        ]);
        if($validator->fails()){
            return response()->json([
                'error' => $validator->messages()], 404);
        }else{
            $description = $request->input('description');
            $type = new Type_course;
            $type->description = $description;
            

            if($type->save()){
                return response()->json(['message' => 'Successfully created type course!'], 200);                
            }
            return response()->json(['message' => 'Type course was not created!'], 404);

        }
    }

    /**
     * Display the specified type of course.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $type = Type_course::find($id);

        if($type){
            return response()->json($type, 200);
        }
        return response()->json(['message' => 'Type course not found!'], 404);
    }

    /**
     * Show the form for editing the specified type of course.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {    
        $type = Type_course::find($id);

        if($type){
            return response()->json($type, 200);
        }
        return response()->json(['message' => 'Type course not found!'], 404);
    }

    /**
     * Update the specified type of course in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $type = Type_course::find($id);
        $unique = $type->description == $request->description ? '' : 'unique:type_courses,description,{$id},id,deleted_at,NULL';
        $validator = Validator::make($request->all(), [
            'description' => 'required|'.$unique
        ]);
        if($validator->fails()){
            return response()->json([
                'error' => $validator->messages()], 404);
        }else{
            $description = $request->input('description');
            $type->description = $description;

            if($type->save()){
                return response()->json(['message' => 'Successfully updated type course!'], 200);                
            }
            return response()->json(['message' => 'Type course was not updated!'], 404);

        }
    }

    /**
     * Remove the specified trype of course from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {
        $type = Type_course::find($id);
            if($type->delete()){
              return response()->json(['message' => 'Successfully deleted type course!'], 200);
            }
        return response()->json(['error' => 'Type course was not deleted!'], 404);
    }
}
