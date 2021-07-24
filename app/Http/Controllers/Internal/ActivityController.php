<?php

namespace App\Http\Controllers\Internal;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use DB;
use App\Models\Activity;

class ActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $activity = Activity::all();

        if($activity){
            return response()->json($activity, 200);
        }
        return response()->json(['message' => 'Activity not found!'], 404);
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
        $validator = Validator::make($request->all(), [
            'title' => 'required|unique:activity,title,NULL,id,deleted_at,NULL',
            'description' => 'required'
        ]);
        if($validator->fails()){
            return response()->json([
                'error' => $validator->messages()], 404);
        }else{

            $title = $request->input('title');
            $description = $request->input('description');

            $activity = new Activity;
            $activity->title = $title;
            $activity->description = $description;

            if($activity->save()){
                return response()->json(['message' => 'Successfully created activity!'], 200);
            }
            return response()->json(['message' => 'Activity was not created!'], 404);

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
        $activity = Activity::find($id);
        
        if($activity){
        	return response()->json($activity, 200);
        }
        return response()->json(['message' => 'Activity not found!'], 404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $activity = Activity::find($id);

        if($activity){
            return response()->json($activity, 200);
        }
        return response()->json(['message' => 'Activity not found!'], 404);
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
        $validator = Validator::make($request->all(), [
            'title' => 'required|unique:activity,title,'.$id.',id,deleted_at,NULL',
            'description' => 'required'
        ]);
        if($validator->fails()){
            return response()->json([
                'error' => $validator->messages()], 404);
        }else{

            $title = $request->input('title');
            $description = $request->input('description');

			$activity = Activity::find($id);
            $activity->title = $title;
            $activity->description = $description;

            if($activity->save()){
                return response()->json(['message' => 'Successfully updated Activity!'], 200);
            }
            return response()->json(['message' => 'Activity was not updated!'], 404);

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
        $activity = Activity::find($id);

        if($activity->delete()){
            return response()->json(['message' => 'Successfully deleted Activity!'], 200);
        }
        return response()->json(['error' => 'Activity was not deleted!'], 404);
    }
}
