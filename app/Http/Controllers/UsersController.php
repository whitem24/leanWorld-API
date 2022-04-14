<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $result = learnworldsGetRequest('/users', env('ACCESS_TOKEN'), env('CLIENT_ID'));
    
        $results = array();
        $i = 0;
        //return $result["users"];
        foreach ($result["users"] as $key => $value) { 
            $coursesInfo = array();
            if($value["courses"]){
                
                $j = 0;
                foreach ($value["courses"] as $key2 => $value2) {
     
                    $resultCourse = learnworldsGetRequest('/course/'.$value2["titleId"], env('ACCESS_TOKEN'), env('CLIENT_ID'));
                    $coursesInfo[$key2] = $resultCourse["course"];
                    if($coursesInfo[$key2]["status"]== "paid"){
                        if(!$value["isAffiliate"] and !$value["isInstructorIn"] and !$value["isStaff"]){
                            $value["paid"] = "Paying - user";
                        }else{
                            $value["paid"] = "Paying - others";
                        }
                        
                    }
                    $j++;
                }


            }
           // $res = learnworldsGetRequest('/user/'.$value["id"].'/profile', env('ACCESS_TOKEN'), env('CLIENT_ID'));       
            
            //$profile = $this->show('5fd277eefc128d31f63d81cb');
            
            $results[$i] = $value;
            $results[$i]["courses"] = $coursesInfo;
            $i++;
        }
    
        //dd($results);
        return response()->json(
            $results, 200);
            //return $results;
     
         
        //
    }
    public function index2()
    {
        
        $result = learnworldsGetRequest('/users', env('ACCESS_TOKEN'), env('CLIENT_ID'));
    
        $results = array();
        $i = 0;
        foreach ($result["users"] as $key => $value) {
            //echo $key;
            $results[$i] = $value;
            $i++;
        }
    
        //dd($results);
        return response()->json(
            $results, 200);
            //return $results;
     
         
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
    public function show(Request $request)
    {
       $result = learnworldsGetRequest('/user/'.$request->userId.'/profile', env('ACCESS_TOKEN'), env('CLIENT_ID'));
       $results = array();
       $i = 0;
       foreach ($result["user"]["courses"] as $key => $value) {
          $resultCourse = learnworldsGetRequest('/course/'.$value["titleId"], env('ACCESS_TOKEN'), env('CLIENT_ID'));
          $results[$key] = $resultCourse["course"];
          $i++;
       }
        //dd($results);
       return response()->json(['user' => $result['user'],'courses' => $results], 200);
    }
    
    public function user(Request $request)
    {
       $result = learnworldsGetRequest('/user/'.$request->userId.'/profile', env('ACCESS_TOKEN'), env('CLIENT_ID'));
      
       return response()->json(['user' => $result['user']], 200);
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
        //
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
