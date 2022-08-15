<?php

namespace App\Http\Controllers\Internal;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Validator;
use DB;
use App\Models\Option;
use App\Models\Question_option;
use Illuminate\Support\Facades\App;

class OptionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $options = Option::all();

        if($options){
            return response()->json($options, 200);
        }
        return response()->json(['message' => 'Options not found!'], 404);
    
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
        App::setLocale($request->lang);
        $validator = Validator::make($request->all(), [
            'order' => 'required',
        ]);
        if($validator->fails()){
            return response()->json([
                'error' => $validator->messages()], 404);
        }else{
            $description = $request->input('description');
            $option = Option::where('description',$description)->first();
            if(!$option){
                $option = new Option;
                $option->description = $description;
                $option->save();
            }
            $option_id = $option->id;
            $question_id = $request->input('question_id');
            $is_correct = $request->input('is_correct');
            $order = $request->input('order');
            $other_text = $request->input('other_text');
    

            $q_options = new Question_option;
            $q_options->option_id = $option_id;
            $q_options->question_id = $question_id;
            $q_options->is_correct = $is_correct;
            $q_options->order = $order;
            $q_options->other_text = $other_text;

            

            if($q_options->save()){
                return response()->json(['message' => 'Successfully created options!'], 200);                
            }
            return response()->json(['message' => 'Option was not created!'], 404);

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
        
        /* $type = Option::find($id);

        if($type){
            return response()->json($type, 200);
        }
        return response()->json(['message' => 'Type certificate not found!'], 404); */
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
        /* $type = Option::find($id);

        if($type){
            return response()->json($type, 200);
        }
        return response()->json(['message' => 'Type certificate not found!'], 404); */
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
            'order' => 'required',
        ]);
        if($validator->fails()){
            return response()->json([
                'error' => $validator->messages()], 404);
        }else{
            $description = $request->input('description');
            $option = Option::where('description',$description)->first();
            if(!$option){
                $option = new Option;
                $option->description = $description;
                $option->save();
            }
            $option_id = $option->id;
            $question_id = $request->input('question_id');
            $is_correct = $request->input('is_correct');
            $order = $request->input('order');
            $other_text = $request->input('other_text');
    

            $q_options = Question_option::find($id);
            $q_options->option_id = $option_id;
            $q_options->question_id = $question_id;
            $q_options->is_correct = $is_correct;
            $q_options->order = $order;
            $q_options->other_text = $other_text;

            

            if($q_options->save()){
                return response()->json(['message' => 'Successfully updated options!'], 200);                
            }
            return response()->json(['message' => 'Option was not updated!'], 404);

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
        $deleted=false;
        $q_option = Question_option::find($id);
        $q_options = Question_option::where('option_id',$q_option->option_id)->get();
        if(count($q_options) <= 1 ){
            $option = Option::find($q_option->option_id);
            $deleted=true;
        }    
        

        if($q_option->delete()){
          if($deleted){
            $option->delete();
          }
          return response()->json(['message' => 'Successfully deleted option!'], 200);
        }
        return response()->json(['error' => 'Option was not deleted!'], 404);

    }
}
