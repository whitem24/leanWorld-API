<?php

namespace App\Http\Controllers\Internal;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Validator;
use DB;
use App\Models\Category;
use Illuminate\Support\Facades\App;

class CategoriesController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();

        if($categories){
            return response()->json($categories, 200);
        }
        return response()->json(['message' => 'Categories not found!'], 404);
    
    
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
            'description' => 'required|unique:categories,description,NULL,id,deleted_at,NULL',
        ]);
        if($validator->fails()){
            return response()->json([
                'error' => $validator->messages()], 404);
        }else{
            $description = $request->input('description');
            $category = new Category;
            $category->description = $description;
            

            if($category->save()){
                return response()->json(['message' => 'Successfully created category!'], 200);                
            }
            return response()->json(['message' => 'Category was not created!'], 404);

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
        
        $category = Category::find($id);

        if($category){
            return response()->json($category, 200);
        }
        return response()->json(['message' => 'Category not found!'], 404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
        $category = Category::find($id);

        if($category){
            return response()->json($category, 200);
        }
        return response()->json(['message' => 'Category not found!'], 404);
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
        $category = Category::find($id);
        $unique = $category->description == $request->description ? '' : 'unique:categories,description,{$id},id,deleted_at,NULL';
        $validator = Validator::make($request->all(), [
            'description' => 'required|'.$unique
        ]);
        if($validator->fails()){
            return response()->json([
                'error' => $validator->messages()], 404);
        }else{
            $description = $request->input('description');
            $category->description = $description;

            if($category->save()){
                return response()->json(['message' => 'Successfully updated category!'], 200);                
            }
            return response()->json(['message' => 'Category was not updated!'], 404);

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
        $category = Category::find($id);
        if($category->delete()){
          return response()->json(['message' => 'Successfully deleted category!'], 200);
        }
        return response()->json(['error' => 'Category was not deleted!'], 404);

    }
}
