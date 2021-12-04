<?php

namespace App\Http\Controllers;
use Auth;
use DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\Profiles;
use Validator;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        // $profile = Profiles::find($id);
        $id = Auth::user()->id;
        $profile = Profiles::where("userid", $id)->first();
        return response()->json($profile, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
            'fname' => 'required', 
            'lname' => 'required',
            'phone_no' => 'int',
            'orgname' => 'string | max:255',
            'location' => 'string | max:255'
            // 'imagelink' =>''
        ]);
        
        // $request->validate([
        //     'fname' => 'required', 
        //     'lname' => 'required',
        //     'phone_no' => 'int',
        //     'orgname' => 'string | max:255',
        //     'location' => 'string | max:255',
        //     'imagelink' =>'mimes:jpeg | jpg | png | max:5120'
        // ]);
        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->messages()], 422);   
        }

        $profile = Profiles::where("userid", $id)->first();

        $profile->fname = $request->get('fname');
		$profile->lname = $request->get('lname');
		$profile->phone_no = $request->get('phone_no');
		$profile->orgname = $request->get('orgname');
		$profile->location = $request->get('location');
        $picture = $request->get('imagelink');
        $oldImageName = $profile->imagelink;

        if ($picture != '') {
            $extension = explode('/', explode(':', substr($picture, 0, strpos($picture, ';')))[1])[1];   // .jpg .png .pdf
            $replace = substr($picture, 0, strpos($picture, ',')+1);
            // find substring fro replace here eg: data:image/png;base64,
            $image = str_replace($replace, '', $picture); 
            $image = str_replace(' ', '+', $image); 
            $imageName = time().'.'.$extension;
            Storage::disk('public')->put('/images/profile-pictures/'.$imageName, base64_decode($image));
            if ($oldImageName != "default.png"){
                Storage::disk('public')->delete('/images/profile-pictures/'.$oldImageName);
            }                

            $profile->imagelink = $imageName;
		}

        if($profile->save()){
            return response()->json(['message' => 'Successfully updated profile!'], 200);                
        }
        return response()->json(['message' => 'Profile was not updated!'], 404);

    // return response()->json(['message' => 'Successfully updated profile!'], 200);
    }
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
