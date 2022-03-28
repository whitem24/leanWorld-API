<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\Profile;

class ProfilesController extends Controller
{
    //
    public function index($user){
        $data = Profile::find($user);
        return view('home');
    }
}
