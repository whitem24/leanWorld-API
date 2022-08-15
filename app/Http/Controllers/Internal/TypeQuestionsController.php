<?php

namespace App\Http\Controllers\Internal;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use DB;
use App\Models\Type_question;

use Illuminate\Support\Facades\App;


class TypeQuestionsController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $types = Type_question::all();

        if($types){
            return response()->json($types, 200);
        }
        return response()->json(['message' => 'Type questions not found!'], 404);
    
    
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
        
        App::setLocale($request->lang);
        $validator = Validator::make($request->all(), [
            'description' => 'required|unique:type_questions,description,NULL,id,deleted_at,NULL',
        ]);
        if($validator->fails()){
            return response()->json([
                'error' => $validator->messages()], 404);
        }else{
            $description = $request->input('description');
            $type = new Type_question;
            $type->description = $description;
            

            if($type->save()){
                return response()->json(['message' => 'Successfully created type question!'], 200);                
            }
            return response()->json(['message' => 'Type question was not created!'], 404);

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
        
        $type = Type_question::find($id);

        if($type){
            return response()->json($type, 200);
        }
        return response()->json(['message' => 'Type question not found!'], 404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
        $type = Type_question::find($id);

        if($type){
            return response()->json($type, 200);
        }
        return response()->json(['message' => 'Type question not found!'], 404);
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
        $type = Type_question::find($id);
        $unique = $type->description == $request->description ? '' : 'unique:type_questions,description,{$id},id,deleted_at,NULL';
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
                return response()->json(['message' => 'Successfully updated type question!'], 200);                
            }
            return response()->json(['message' => 'Type question was not updated!'], 404);

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
        $type = Type_question::find($id);
        if($type->delete()){
          return response()->json(['message' => 'Successfully deleted type question!'], 200);
        }
        return response()->json(['error' => 'Type question was not deleted!'], 404);

    }
    
}
