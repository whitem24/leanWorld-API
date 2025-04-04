<?php

namespace App\Http\Controllers\Internal;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use DB;
use App\Models\Activity;
use App\Models\Type_activity;
use Illuminate\Support\Facades\App;

class ActivitiesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $activity = Activity::with('type_activity')->get();

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
        $type_activities = Type_activity::all();

        if($type_activities){
            return response()->json($type_activities, 200);
        }
        return response()->json(['message' => 'Type activities not found!'], 404);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        App::setLocale($request->lang);
        $validator = Validator::make($request->all(), [
            'title' => 'required|unique:activities,title,NULL,id,deleted_at,NULL',
            'description' => 'required',
            'type_activity_id' => 'required'
        ]);
        if($validator->fails()){
            return response()->json([
                'error' => $validator->messages()], 404);
        }else{

            $title = $request->input('title');
            $description = $request->input('description');
            $type_activity_id = $request->input('type_activity_id');

            $activity = new Activity;
            $activity->title = $title;
            $activity->description = $description;
            $activity->type_activity_id = $type_activity_id;

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
        $activity = Activity::with('type_activity')->find($id);
        
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
        $type_activities = Type_activity::all();
        $activity = Activity::with('type_activity')->find($id);

        if($activity){
            return response()->json(['activity' => $activity, 'type_activities' => $type_activities], 200);
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
        App::setLocale($request->lang);
        $validator = Validator::make($request->all(), [
            'title' => 'required|unique:activities,title,'.$id.',id,deleted_at,NULL',
            'description' => 'required',
            'type_activity_id' => 'required'
        ]);
        if($validator->fails()){
            return response()->json([
                'error' => $validator->messages()], 404);
        }else{

            $title = $request->input('title');
            $description = $request->input('description');
            $type_activity_id = $request->input('type_activity_id');


			$activity = Activity::find($id);
            $activity->title = $title;
            $activity->description = $description;
            $activity->type_activity_id = $type_activity_id;

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
