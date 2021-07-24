<?php

namespace App\Http\Controllers\Internal;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use DB;
use App\Models\Menu;

class MenusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menus = Menu::all();

        if($menus){
            return response()->json($menus, 200);
        }
        return response()->json(['message' => 'Menus not found!'], 404);
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
        $validator = Validator::make($request->all(), [
            'description' => 'required|unique:menus,description,NULL,id,deleted_at,NULL',
            'description' => 'required|unique:menus,description,NULL,id,deleted_at,NULL',
            'icon' => 'required'
        ]);
        if($validator->fails()){
            return response()->json([
                'error' => $validator->messages()], 404);
        }else{
            $description = $request->input('description');
            $icon = $request->input('icon');
            

            $menu = new Menu;
            $menu->description = $description;
            $menu->icon = $icon;

            if($menu->save()){
                return response()->json(['message' => 'Successfully created menu!'], 200);
            }
            return response()->json(['message' => 'Menu was not created!'], 404);

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
        $menu = Menu::find($id);

        if($menu){
            return response()->json($menu, 200);
        }
        return response()->json(['message' => 'Menu not found!'], 404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $menu = Menu::find($id);

        if($menu){
            return response()->json($menu, 200);
        }
        return response()->json(['message' => 'Menu not found!'], 404);
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
            'description' => 'required|unique:menus,description,'.$id.',id,deleted_at,NULL',
            'icon' => 'required'
        ]);
        if($validator->fails()){
            return response()->json([
                'error' => $validator->messages()], 404);
        }else{
            $description = $request->input('description');
            $icon = $request->input('icon');
            
            

            $menu = Menu::find($id);
            $menu->icon = $icon;
            $menu->description = $description;

            if($menu->save()){
                return response()->json(['message' => 'Successfully updated menu!'], 200);
            }
            return response()->json(['message' => 'Menu was not updated!'], 404);

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
        
        $menu = Menu::find($id);

        if($menu->delete()){
            return response()->json(['message' => 'Successfully deleted menu!'], 200);
        }
        return response()->json(['error' => 'Menu was not deleted!'], 404);
    }
}
