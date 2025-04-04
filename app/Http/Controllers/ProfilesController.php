<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\Profile;
use \App\Models\User;
use Auth;
use Illuminate\Support\Facades\Validator;

class ProfilesController extends Controller
{

    public function index(){
        $result = Profile::all();
        return $result;
    }

    public function show(){
        $id = Auth::user()->id;
        $data = Profile::where('user_id',$id)->first();
        return response()->json($data,200);
    }

    public function edit()
    {   
        $id = Auth::user()->id;
        $data = Profile::where('user_id',$id)->first();
        return response()->json($data,200);
    }

    public function store(Request $request)
    {
        // $validator = Validator::make($request->all(),[
        //     'username' => 'required|max:191',
        //     'first_name' => 'required|max:191',
        //     'organization_name' => 'required|max:191',
        //     'email' => 'required|max:191|email|unique:profiles,email',
        //     'number' => 'required|max:191',
        //     'birthday' => 'required|max:191',
        //     'image' => 'required|image|mimes:jpeg,png,jpg|max:5048',
        // ]);

        // if($validator->fails()){
        //     return response()->json(['error' => $validator->messages()], 442);
        // }
        // else
        // {
        // $id = Auth::user()->id;
        // $data = new Profile($id);

        // $data->username =$request->input('username'); 
        // $data->first_name =$request->input('first_name');
        // $data->last_name =$request->input('last_name');                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                          
        // $data->organization_name =$request->input('organization_name');
        // $data->location =$request->input('location');
        // $data->email =$request->input('email');
        // $data->number =$request->input('number');
        // $data->birthday =$request->input('birthday');

        // $data->save();
        // return response()->json(['message' => 'Successfully updated Profile!'], 200);
        // }
    }

    public function update(Request $request)
    {   
        $validator = Validator::make($request->all(),[
            'username' => 'required|max:191',
            'first_name' => 'required|max:191',
            'organization_name' => 'required|max:191',
            'email' => 'required|max:191',
            'number' => 'required|max:191',
            'birthday' => 'required|max:191',
        ]);

        if($validator->fails()){
            return response()->json([
                'error' => $validator->messages()], 404);
        }
        else{
        $id = Auth::user()->id;
        $data = Profile::where('user_id',$id)->first();

        $data->username =$request->input('username'); 
        $data->first_name =$request->input('first_name');
        $data->last_name =$request->input('last_name');
        $data->organization_name =$request->input('organization_name');
        $data->location =$request->input('location');
        $data->email =$request->input('email');
        $data->number =$request->input('number');
        $data->birthday =$request->input('birthday');

        if($request->input('profile_picture')){
            $file = $request->input('profile_picture');
            $folderPath = "uploads/profiles/";
            $base64Image = explode(";base64,",$file);
            $explodeImage = explode("image/",$base64Image[0]);
            $imageType = $explodeImage[1];
            $image_base64 = \base64_decode($base64Image[1]);
            $filename = $request->input("profile_picture_name");
            $data->profile_picture = $folderPath .$filename;

            file_put_contents( $data->profile_picture, $image_base64);
        }
    
        $data->update();
        return response()->json(['message' => 'Successfully updated Profile!'], 200);
        }
    }
}
