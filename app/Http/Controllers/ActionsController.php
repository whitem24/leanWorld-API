<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;

class ActionsController extends Controller
{
    public function get_users()
    {
        
        $result = learnworldsGetRequest('/users', env('ACCESS_TOKEN'), env('CLIENT_ID'));
    
        $results = array();
        $i = 0;
        //return $result["users"];
        foreach ($result["users"] as $key => $value) { 
            $coursesInfo = array();
            $coursesTitle = Array();
            if($value["courses"]){
                
                $j = 0;
                foreach ($value["courses"] as $key2 => $value2) {
     
                    $resultCourse = learnworldsGetRequest('/course/'.$value2["titleId"], env('ACCESS_TOKEN'), env('CLIENT_ID'));
                    $coursesInfo[$key2] = $resultCourse["course"];
                    $coursesTitle[$key2] = $resultCourse["course"]["title"];
                    $j++;
                }


            }
           // $res = learnworldsGetRequest('/user/'.$value["id"].'/profile', env('ACCESS_TOKEN'), env('CLIENT_ID'));       
            
            //$profile = $this->show('5fd277eefc128d31f63d81cb');
            $stringCourses = implode(", ",$coursesTitle);
            $results[$i] = $value;
            $results[$i]["courses"] = $coursesInfo;
            $results[$i]["stringCourses"] = $stringCourses;
            $i++;
        }
    
        return response()->json(
            $results, 200);
            //return $results;
     
         
        //
    }
    
}
