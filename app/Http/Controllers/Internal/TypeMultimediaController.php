<?php

namespace App\Http\Controllers\Internal;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use DB;
use App\Models\Type_multimedia;


class TypeMultimediaController extends Controller
{
    /**
     * Display a listing of the type of multimedia.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $types = Type_multimedia::all();

        if($types){
            return response()->json($types, 200);
        }
        return response()->json(['message' => 'Type multimedia not found!'], 404);
    
    }

    /**
     * Show the form for creating a new type of multimedia.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created type of multimedia in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'description' => 'required|unique:type_multimedia,description,NULL,id,deleted_at,NULL',
        ]);
        if($validator->fails()){
            return response()->json([
                'error' => $validator->messages()], 404);
        }else{
            $description = $request->input('description');
            $type = new Type_multimedia;
            $type->description = $description;
            

            if($type->save()){
                return response()->json(['message' => 'Successfully created type multimedia!'], 200);                
            }
            return response()->json(['message' => 'Type multimedia was not created!'], 404);

        }
    }

    /**
     * Display the specified type of multimedia.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $type = Type_multimedia::find($id);

        if($type){
            return response()->json($type, 200);
        }
        return response()->json(['message' => 'Type multimedia not found!'], 404);
    }

    /**
     * Show the form for editing the specified type of multimedia.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {    
        $type = Type_multimedia::find($id);

        if($type){
            return response()->json($type, 200);
        }
        return response()->json(['message' => 'Type multimedia not found!'], 404);
    }

    /**
     * Update the specified type of multimedia in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $type = Type_multimedia::find($id);
        $unique = $type->description == $request->description ? '' : 'unique:type_multimedia,description,{$id},id,deleted_at,NULL';
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
                return response()->json(['message' => 'Successfully updated type multimedia!'], 200);                
            }
            return response()->json(['message' => 'Type multimedia was not updated!'], 404);

        }
    }

    /**
     * Remove the specified trype of multimedia from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {
        $type = Type_multimedia::find($id);
            if($type->delete()){
              return response()->json(['message' => 'Successfully deleted type multimedia!'], 200);
            }
        return response()->json(['error' => 'Type multimedia was not deleted!'], 404);
    }
}
