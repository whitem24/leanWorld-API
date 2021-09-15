<?php

namespace App\Http\Controllers\Internal;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Validator;
use DB;
use App\Models\Type_activity;
use App\Models\Activity;

class TypeActivitiesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $types = Type_activity::all();

        if($types){
            return response()->json($types, 200);
        }
        return response()->json(['message' => 'Type activities not found!'], 404);
    
    
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'description' => 'required',     
        ]);
        if($validator->fails()){
            return response()->json([
                'error' => $validator->messages()], 404);
        }else{
            $title = $request->input('title');
            $description = $request->input('description');
            $type = new Type_activity;
            $type->title = $title;
            $type->description = $description;            

            if($type->save()){
                return response()->json(['message' => 'Successfully created type activity!'], 200);                
            }
            return response()->json(['message' => 'Type activity was not created!'], 404);

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
        
        $type = Type_activity::where('id',$id)->first();

        if($type){
            return response()->json($type, 200);
        }
        return response()->json(['message' => 'Type activity not found!'], 404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $type = Type_activity::where('id', $id)->first();

        if($type){
            return response()->json($type, 200);
        }
        return response()->json(['message' => 'Type activity not found!'], 404);
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
        
        $type = Type_activity::find($id);
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'description' => 'required',
        ]);
        if($validator->fails()){
            return response()->json([
                'error' => $validator->messages()], 404);
        }else{
            $title = $request->input('title');
            $description = $request->input('description');
            $type->title = $title;
            $type->description = $description;

            if($type->save()){
                return response()->json(['message' => 'Successfully updated type activity!'], 200);                
            }
            return response()->json(['message' => 'Type activity was not updated!'], 404);

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
        $type = Type_activity::find($id);
        if($type->delete()){
          return response()->json(['message' => 'Successfully deleted type activity!'], 200);
        }
        return response()->json(['error' => 'Type activity was not deleted!'], 404);

    }
}
