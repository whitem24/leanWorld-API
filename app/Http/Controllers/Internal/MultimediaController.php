<?php

namespace App\Http\Controllers\Internal;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use DB;
use App\Models\Type_multimedia;
use App\Models\Multimedia;

class MultimediaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $multimedia = Multimedia::all();

        if($multimedia){
            return response()->json($multimedia, 200);
        }
        return response()->json(['message' => 'Multimedia not found!'], 404);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $type_multimedia = Type_multimedia::all();

        if($type_multimedia){
            return response()->json($type_multimedia, 200);
        }
        return response()->json(['message' => 'Type multimedia not found!'], 404);
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
            'order' => 'required|numeric',
            'path' => 'required',
            'duration' => 'required|time',
            'type_multimedia_id' => 'required|numeric',
            'multimediable_id' => 'required|numeric',
            'multimediable_type' => 'required'
        ]);
        if($validator->fails()){
            return response()->json([
                'error' => $validator->messages()], 404);
        }else{

            $title = $request->input('title');
            $description = $request->input('description');
            $order = $request->input('order');
            $path = $request->input('path');
            $duration = $request->input('duration');
            $type_multimedia_id = $request->input('type_multimedia_id');
            $multimediable_id = $request->input('multimediable_id');
            $multimediable_type = $request->input('multimediable_type');

            $multimedia = new Multimedia;
            $multimedia->title = $title;
            $multimedia->description = $description;
            $multimedia->order = $order;
            $multimedia->path = $path;
            $multimedia->duration = $duration;
            $multimedia->type_multimedia_id = $type_multimedia_id;
            $multimedia->multimediable_id = $multimediable_id;
            $multimedia->multimediable_type = $multimediable_type;

            if($multimedia->save()){
                return response()->json(['message' => 'Successfully created multimedia!'], 200);
            }
            return response()->json(['message' => 'Multimedia was not created!'], 404);

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
        $multimedia = Multimedia::with('type_multimedia')->where('id', $id)->first();
        
        if($multimedia){
        	return response()->json($multimedia, 200);
        }
        return response()->json(['message' => 'Multimedia not found!'], 404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $multimedia = Multimedia::with('type_multimedia')->where('id', $id)->first();
        $type_multimedia = Type_multimedia::all();

        if($multimedia){
            return response()->json(['multimedia' => $multimedia, 'type_multimedia' => $type_multimedia], 200);
        }
        return response()->json(['message' => 'Multimedia not found!'], 404);
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
            'title' => 'required',
            'description' => 'required',
            'order' => 'required|numeric',
            'path' => 'required',
            'duration' => 'required|time',
            'type_multimedia_id' => 'required|numeric',
            'multimediable_id' => 'required|numeric',
            'multimediable_type' => 'required'
        ]);
        if($validator->fails()){
            return response()->json([
                'error' => $validator->messages()], 404);
        }else{

            $title = $request->input('title');
            $description = $request->input('description');
            $order = $request->input('order');
            $path = $request->input('path');
            $duration = $request->input('duration');
            $type_multimedia_id = $request->input('type_multimedia_id');
            $multimediable_id = $request->input('multimediable_id');
            $multimediable_type = $request->input('multimediable_type');

			$multimedia = Multimedia::find($id);
            $multimedia->title = $title;
            $multimedia->description = $description;
            $multimedia->order = $order;
            $multimedia->path = $path;
            $multimedia->duration = $duration;
            $multimedia->type_multimedia_id = $type_multimedia_id;
            $multimedia->multimediable_id = $multimediable_id;
            $multimedia->multimediable_type = $multimediable_type;

            if($multimedia->save()){
                return response()->json(['message' => 'Successfully updated Multimedia!'], 200);
            }
            return response()->json(['message' => 'Multimedia was not updated!'], 404);

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
        $multimedia = Multimedia::find($id);

        if($multimedia->delete()){
            return response()->json(['message' => 'Successfully deleted Multimedia!'], 200);
        }
        return response()->json(['error' => 'Multimedia was not deleted!'], 404);
    }
}
