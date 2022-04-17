<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\Profile;
use \App\Models\User;
use Auth;

class ProfilesController extends Controller
{

    public function index(){
        $result = Profile::all();
        return $result;
    }

    public function show(){
        $id = Auth::user()->id;
        $data = Profile::findOrFail($id);
        return response()->json($data,200);
    }

    public function edit()
    {
        $id = Auth::user()->id;
        $data = Profile::findOrFail($id);
        return response()->json($data,200);
    }

    public function update(Request $request)
    {
        $id = Auth::user()->id;
        $data = Profile::findOrFail($id);

        $data->username =$request->username;
        $data->first_name =$request->input('first_name');
        $data->last_name =$request->input('last_name');
        $data->organization_name =$request->input('organization_name');
        $data->location =$request->input('location');
        $data->email =$request->input('email');
        $data->number =$request->input('number');
        $data->birthday =$request->input('birthday');   
        if( $data->update()){
            return response()->json(['message' => 'Successfully updated Profile!'], 200);
        }
        return response()->json(['message' => 'Profile was not updated!'], 404);
    }
   
}
