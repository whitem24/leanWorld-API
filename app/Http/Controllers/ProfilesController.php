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
        // $data = Profile::findOrFail($profileId);
        // return response()->json(
        //     $data, 200);

        $id = Auth::user()->id;
        $data = Profile::findOrFail($id);
        return response()->json($data,200);
    }
}
