<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class CoursesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $result = learnworldsGetRequest('/courses', env('ACCESS_TOKEN'), env('CLIENT_ID'));

       $results = array();
       $i = 0;
       foreach ($result["courses"] as $key => $value) {
          //echo $key;
          $results[$i] = $value;
          $i++;
       }

       //dd($results);
       return response()->json(
           $results, 200);
           //return $results;

    }

    public function coursesUsers(Request $request)
    {
       $result = learnworldsGetRequest('/users/course/'.$request->titleId, env('ACCESS_TOKEN'), env('CLIENT_ID'));
       $resultCourse = learnworldsGetRequest('/course/'.$request->titleId, env('ACCESS_TOKEN'), env('CLIENT_ID'));

       $results = array();
       $i = 0;
       foreach ($result["learners"] as $key => $value) {
          $results[$i] = $value;
          $i++;
       }
       return response()->json(['learners' => $results,'courseData' => $resultCourse], 200);
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
        
       $result = learnworldsGetRequest('/course/'.$request->titleId, env('ACCESS_TOKEN'), env('CLIENT_ID'));
       


       //dd($results);
       return response()->json(
           $result['course'], 200);
           //return $results;

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
