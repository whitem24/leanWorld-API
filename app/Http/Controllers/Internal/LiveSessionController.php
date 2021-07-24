<?php

namespace App\Http\Controllers\Internal;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use DB;
use App\Models\Type_live_session;
use App\Models\Live_session;

class LiveSessionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $live_session = Live_session::all();

        if($live_session){
            return response()->json($live_session, 200);
        }
        return response()->json(['message' => 'Live session not found!'], 404);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $type_live_session = Type_live_session::all();

        if($type_live_session){
            return response()->json($type_live_session, 200);
        }
        return response()->json(['message' => 'Type live session not found!'], 404);
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
            'link' => 'required',
            'description' => 'required',
            'order' => 'required|numeric',
            'schedule' => 'required',
            'type_live_session_id' => 'required|numeric',
            'chapter_id' => 'required|numeric'
        ]);
        if($validator->fails()){
            return response()->json([
                'error' => $validator->messages()], 404);
        }else{

            $link = $request->input('link');
            $description = $request->input('description');
            $order = $request->input('order');
            $schedule = $request->input('schedule');
            $type_live_session_id = $request->input('type_live_session_id');
            $chapter_id = $request->input('chapter_id');

            $live_session = new Live_session;
            $live_session->link = $link;
            $live_session->description = $description;
            $live_session->order = $order;
            $live_session->schedule = $schedule;
            $live_session->type_live_session_id = $type_live_session_id;
            $live_session->chapter_id = $chapter_id;

            if($live_session->save()){
                return response()->json(['message' => 'Successfully created live session!'], 200);
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
        $live_session = Live_session::with('type_live_session')->where('id', $id)->first();
        
        if($live_session){
        	return response()->json($live_session, 200);
        }
        return response()->json(['message' => 'Live session not found!'], 404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $live_session = Live_session::with('type_live_session')->where('id', $id)->first();
        $type_live_session = Type_live_session::all();

        if($live_session){
            return response()->json(['live_session' => $live_session, 'type_live_session' => $type_live_session], 200);
        }
        return response()->json(['message' => 'Live session not found!'], 404);
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
            'link' => 'required',
            'description' => 'required',
            'order' => 'required|numeric',
            'schedule' => 'required',
            'type_live_session_id' => 'required|numeric',
            'chapter_id' => 'required|numeric'
        ]);
        if($validator->fails()){
            return response()->json([
                'error' => $validator->messages()], 404);
        }else{

            $link = $request->input('link');
            $description = $request->input('description');
            $order = $request->input('order');
            $schedule = $request->input('schedule');
            $type_live_session_id = $request->input('type_live_session_id');
            $chapter_id = $request->input('chapter_id');

            $live_session = Live_session::find($id);
            $live_session->link = $link;
            $live_session->description = $description;
            $live_session->order = $order;
            $live_session->schedule = $schedule;
            $live_session->type_live_session_id = $type_live_session_id;
            $live_session->chapter_id = $chapter_id;

            if($live_session->save()){
                return response()->json(['message' => 'Successfully updated Live session!'], 200);
            }
            return response()->json(['message' => 'Live session was not updated!'], 404);

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
        $live_session = Live_session::find($id);

        if($live_session->delete()){
            return response()->json(['message' => 'Successfully deleted Live session!'], 200);
        }
        return response()->json(['error' => 'Live session was not deleted!'], 404);
    }
}
