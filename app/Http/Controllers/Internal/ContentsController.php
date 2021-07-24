<?php

namespace App\Http\Controllers\Internal;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Validator;
use DB;
use App\Models\Content;

class ContentsController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contents = Content::all();

        if($contents){
            return response()->json($contents, 200);
        }
        return response()->json(['message' => 'Contents not found!'], 404);
    
    
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
            'title' => 'required',
            'content' => 'required',
            'contenteable_id' => 'required|numeric',
            'contenteable_type' => 'required|numeric',
            'order' => 'required|integer',
        ]);
        if($validator->fails()){
            return response()->json([
                'error' => $validator->messages()], 404);
        }else{
            $title = $request->input('title');
            $contents = $request->input('content');
            $contenteable_id = $request->input('contenteable_id');
            $contenteable_type = $request->input('contenteable_type');
            $order = $request->input('order');
            $content = new Content;
            $content->title = $title;
            $content->content = $contents;
            $content->contenteable_id = $contenteable_id;
            $content->contenteable_type = $contenteable_type;
            $content->order = $order;
            

            if($content->save()){
                return response()->json(['message' => 'Successfully created content!'], 200);                
            }
            return response()->json(['message' => 'Content was not created!'], 404);

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
        
        $content = Content::find($id);

        if($content){
            return response()->json($content, 200);
        }
        return response()->json(['message' => 'Content not found!'], 404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
        $content = Content::find($id);

        if($content){
            return response()->json($content, 200);
        }
        return response()->json(['message' => 'Content not found!'], 404);
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
        
        $content = Content::find($id);
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'content' => 'required',
            'contenteable_id' => 'required|numeric',
            'contenteable_type' => 'required|numeric',
            'order' => 'required|integer',
        ]);
        if($validator->fails()){
            return response()->json([
                'error' => $validator->messages()], 404);
        }else{
            $title = $request->input('title');
            $contents = $request->input('content');
            $contenteable_id = $request->input('contenteable_id');
            $contenteable_type = $request->input('contenteable_type');
            $order = $request->input('order');
            $content->title = $title;
            $content->content = $contents;
            $content->contenteable_id = $contenteable_id;
            $content->contenteable_type = $contenteable_type;
            $content->order = $order;

            if($content->save()){
                return response()->json(['message' => 'Successfully updated content!'], 200);                
            }
            return response()->json(['message' => 'Content was not updated!'], 404);

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
        $content = Content::find($id);
        if($content->delete()){
          return response()->json(['message' => 'Successfully deleted content!'], 200);
        }
        return response()->json(['error' => 'Content was not deleted!'], 404);

    }
}
