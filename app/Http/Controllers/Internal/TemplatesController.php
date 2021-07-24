<?php

namespace App\Http\Controllers\Internal;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use DB;
use App\Models\Template;

class TemplatesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $template = Template::all();

        if($template){
            return response()->json($template, 200);
        }
        return response()->json(['message' => 'Template not found!'], 404);
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
            'title' => 'required|unique:templates,title,NULL,id,deleted_at,NULL',
            'description' => 'required',
            'content' => 'required',
            'order' => 'required|numeric'
        ]);
        if($validator->fails()){
            return response()->json([
                'error' => $validator->messages()], 404);
        }else{

            $title = $request->input('title');
            $description = $request->input('description');
            $content = $request->input('content');
            $order = $request->input('order');

            $template = new Template;
            $template->title = $title;
            $template->description = $description;
            $template->content = $content;
            $template->order = $order;

            if($template->save()){
                return response()->json(['message' => 'Successfully created template!'], 200);
            }
            return response()->json(['message' => 'Template was not created!'], 404);

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
        $template = Template::find($id);

        if($template){
        	return response()->json($template, 200);
        }
        return response()->json(['message' => 'Template not found!'], 404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $template = Template::find($id);

        if($template){
            return response()->json($template, 200);
        }
        return response()->json(['message' => 'Template not found!'], 404);
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
            'title' => 'required|unique:templates,title,'.$id.',id,deleted_at,NULL',
            'description' => 'required',
            'order' => 'required|numeric',
            'type_questionnaires_id' => 'required|numeric',
            'questionnaireble_id' => 'required|numeric',
            'questionnaireble_type' => 'required|numeric'
        ]);
        if($validator->fails()){
            return response()->json([
                'error' => $validator->messages()], 404);
        }else{

            $title = $request->input('title');
            $description = $request->input('description');
            $content = $request->input('content');
            $order = $request->input('order');

            $template = Template::find($id);
            $template->title = $title;
            $template->description = $description;
            $template->content = $content;
            $template->order = $order;

            if($template->save()){
                return response()->json(['message' => 'Successfully updated template!'], 200);
            }
            return response()->json(['message' => 'Template was not updated!'], 404);

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
        $template = Template::find($id);

        if($template->delete()){
            return response()->json(['message' => 'Successfully deleted template!'], 200);
        }
        return response()->json(['error' => 'Questionnaire was not deleted!'], 404);
    }
}
