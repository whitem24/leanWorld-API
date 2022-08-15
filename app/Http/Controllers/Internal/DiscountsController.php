<?php

namespace App\Http\Controllers\Internal;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Validator;
use DB;
use App\Models\Discount;
use Illuminate\Support\Facades\App;

class DiscountsController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $discounts = Discount::all();

        if($discounts){
            return response()->json($discounts, 200);
        }
        return response()->json(['message' => 'Discounts not found!'], 404);
    
    
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
        App::setLocale($request->lang);
        $validator = Validator::make($request->all(), [
            'description' => 'required|unique:discounts,description,NULL,id,deleted_at,NULL',
            'percent' => 'required|numeric',
            'date_start' => 'required|date',
            'date_end' => 'required|date',

        ]);
        if($validator->fails()){
            return response()->json([
                'error' => $validator->messages()], 404);
        }else{
            $description = $request->input('description');
            $percent = $request->input('percent');
            $date_start = $request->input('date_start');
            $date_end = $request->input('date_end');
            $discount = new Discount;
            $discount->description = $description;
            $discount->percent = $percent;
            $discount->date_start = $date_start;
            $discount->description = $description;
            

            if($discount->save()){
                return response()->json(['message' => 'Successfully created discount!'], 200);                
            }
            return response()->json(['message' => 'Discount was not created!'], 404);

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
        $discount = Discount::find($id);

        if($discount){
            return response()->json($discount, 200);
        }
        return response()->json(['message' => 'Discount not found!'], 404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
        $discount = Discount::find($id);

        if($discount){
            return response()->json($discount, 200);
        }
        return response()->json(['message' => 'Discount not found!'], 404);
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
        App::setLocale($request->lang);
        $discount = Discount::find($id);
        $unique = $discount->description == $request->description ? '' : 'unique:discounts,description,{$id},id,deleted_at,NULL';
        $validator = Validator::make($request->all(), [
            'description' => 'required|'.$unique,
            'percent' => 'required|numeric',
            'date_start' => 'required|date',
            'date_end' => 'required|date',
            
        ]);
        if($validator->fails()){
            return response()->json([
                'error' => $validator->messages()], 404);
        }else{
            $description = $request->input('description');
            $percent = $request->input('percent');
            $date_start = $request->input('date_start');
            $date_end = $request->input('date_end');
            $discount->description = $description;
            $discount->percent = $percent;
            $discount->date_start = $date_start;
            $discount->description = $description;

            if($discount->save()){
                return response()->json(['message' => 'Successfully updated discount!'], 200);                
            }
            return response()->json(['message' => 'discount was not updated!'], 404);

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $discount = Discount::find($id);
        if($discount->delete()){
          return response()->json(['message' => 'Successfully deleted discount!'], 200);
        }
        return response()->json(['error' => 'discount was not deleted!'], 404);

    }
}
