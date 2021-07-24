<?php

namespace App\Http\Controllers\Internal;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use DB;
use App\Models\Type_questionnaire;

class TypeQuestionnairesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $types = Type_questionnaire::all();

        if($types){
            return response()->json($types, 200);
        }
        return response()->json(['message' => 'Type questionnaires not found!'], 404);
    
    
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
            'description' => 'required|unique:type_questionnaires,description,NULL,id,deleted_at,NULL',
        ]);
        if($validator->fails()){
            return response()->json([
                'error' => $validator->messages()], 404);
        }else{
            $description = $request->input('description');
            $type = new Type_questionnaire;
            $type->description = $description;
            

            if($type->save()){
                return response()->json(['message' => 'Successfully created type questionnaire!'], 200);                
            }
            return response()->json(['message' => 'Type questionnaire was not created!'], 404);

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
        
        $type = Type_questionnaire::find($id);

        if($type){
            return response()->json($type, 200);
        }
        return response()->json(['message' => 'Type questionnaire not found!'], 404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
        $type = Type_questionnaire::find($id);

        if($type){
            return response()->json($type, 200);
        }
        return response()->json(['message' => 'Type questionnaire not found!'], 404);
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
        
        $type = Type_questionnaire::find($id);
        $unique = $type->description == $request->description ? '' : 'unique:type_questionnaires,description,{$id},id,deleted_at,NULL';
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
                return response()->json(['message' => 'Successfully updated type questionnaire!'], 200);                
            }
            return response()->json(['message' => 'Type questionnaire was not updated!'], 404);

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
        $type = Type_questionnaire::find($id);
        if($type->delete()){
          return response()->json(['message' => 'Successfully deleted type questionnaire!'], 200);
        }
        return response()->json(['error' => 'Type questionnaire was not deleted!'], 404);

    }
   
}
