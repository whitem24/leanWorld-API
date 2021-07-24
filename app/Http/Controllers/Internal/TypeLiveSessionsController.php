<?php

namespace App\Http\Controllers\Internal;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use DB;
use App\Models\Type_live_session;

class TypeLiveSessionsController extends Controller
{
    /**
     * Display a listing of the type of live session.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $types = Type_live_session::all();

        if($types){
            return response()->json($types, 200);
        }
        return response()->json(['message' => 'Type live sessions not found!'], 404);
    
    }

    /**
     * Show the form for creating a new type of live session.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created type of live session in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'description' => 'required|unique:type_live_sessions,description,NULL,id,deleted_at,NULL',
        ]);
        if($validator->fails()){
            return response()->json([
                'error' => $validator->messages()], 404);
        }else{
            $description = $request->input('description');
            $type = new Type_live_session;
            $type->description = $description;
            

            if($type->save()){
                return response()->json(['message' => 'Successfully created type live session!'], 200);                
            }
            return response()->json(['message' => 'Type live session was not created!'], 404);

        }
    }

    /**
     * Display the specified type of live session.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $type = Type_live_session::find($id);

        if($type){
            return response()->json($type, 200);
        }
        return response()->json(['message' => 'Type live session not found!'], 404);
    }

    /**
     * Show the form for editing the specified type of live session.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {    
        $type = Type_live_session::find($id);

        if($type){
            return response()->json($type, 200);
        }
        return response()->json(['message' => 'Type live session not found!'], 404);
    }

    /**
     * Update the specified type of live session in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $type = Type_live_session::find($id);
        $unique = $type->description == $request->description ? '' : 'unique:type_live_sessions,description,{$id},id,deleted_at,NULL';
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
                return response()->json(['message' => 'Successfully updated type live session!'], 200);                
            }
            return response()->json(['message' => 'Type live session was not updated!'], 404);

        }
    }

    /**
     * Remove the specified trype of live session from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {
        $type = Type_live_session::find($id);
            if($type->delete()){
              return response()->json(['message' => 'Successfully deleted type live session!'], 200);
            }
        return response()->json(['error' => 'Type live session was not deleted!'], 404);
    }
}
