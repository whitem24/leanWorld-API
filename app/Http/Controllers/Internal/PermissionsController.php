<?php

namespace App\Http\Controllers\Internal;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use DB;
use App\Models\Permission;
use App\Models\Menu;

class PermissionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $permissions = DB::table('permissions')
        ->select('permissions.id', 'permissions.description', 'p.description as parent_name')
        ->leftjoin('permissions as p', 'p.id', '=', 'permissions.parent_id')
        ->where('permissions.deleted_at', null)
        ->get();

        if($permissions){
            return response()->json($permissions, 200);
        }
        return response()->json(['message' => 'Permissions not found!'], 404);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $menus = Menu::all();
        $permissionParents = Permission::/* with('menu')-> */whereNull('parent_id')->get();

        if($permissionParents){
            return response()->json(['permissionParents' => $permissionParents, 'menus' => $menus], 200);
        }
        return response()->json(['message' => 'Permission not found!'], 404);
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
            'description' => 'required|unique:permissions,description,NULL,id,deleted_at,NULL'
        ]);
        if($validator->fails()){
            return response()->json([
                'error' => $validator->messages()], 404);
        }else{
            $description = $request->input('description');
            $parent_id = $request->input('parent')!=='-1' ? $request->input('parent') : NULL;
            $menu_id = $request->input('menu')!=='-1' ? $request->input('menu') : NULL;

            $permission = new Permission;
            $permission->description = $description;
            $permission->parent_id = $parent_id;            
            $permission->menu_id = $menu_id;

            if($permission->save()){
                return response()->json(['message' => 'Successfully created permission!'], 200);
            }
            return response()->json(['message' => 'Permission was not created!'], 404);

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
        $permission = DB::table('permissions')
        ->select('permissions.id', 'permissions.description', 'permissions.parent_id', 'p.description as parent_name')
        ->leftjoin('permissions as p', 'p.id', '=', 'permissions.parent_id')
        ->where('permissions.id', $id)
        ->get();

        if($permission){
            return response()->json($permission, 200);
        }
        return response()->json(['message' => 'Permission not found!'], 404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $permission = Permission::find($id);
        $menus = Menu::all();
        $permissionParents = Permission::whereNull('parent_id')->get();


        if($permission) {
            return response()->json(['permission' => $permission,'permissionParents' => $permissionParents, 'menus' => $menus], 200);
        }
        return response()->json(['message' => 'Permission not found!'], 404);
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
        $permission = Permission::find($id);
        $unique = $permission->description == $request->description ? '' : 'unique:permissions,description,{$id},id,deleted_at,NULL';
        $validator = Validator::make($request->all(), [
            'description' => 'required|'.$unique
        ]);
        if($validator->fails()){
            return response()->json([
                'error' => $validator->messages()], 404);
        }else{

            $description = $request->input('description');
            $parent_id = $request->input('parent')!=='-1' ? $request->input('parent') : NULL;
            $menu_id = $request->input('menu')!=='-1' ? $request->input('menu') : NULL;

            //$permission = Permission::find($id);
            $permission->description = $description;
            $permission->parent_id = $parent_id;
            $permission->menu_id = $menu_id;

            if($permission->save()){
                return response()->json(['message' => 'Successfully updated permission!'], 200);
            }
            return response()->json(['message' => 'Permission was not updated!'], 404);

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
        Permission::where('parent_id', $id)->delete();
        $permission = Permission::find($id);

        if($permission->delete()){
            return response()->json(['message' => 'Successfully deleted permission!'], 200);
        }
        return response()->json(['error' => 'Permission was not deleted!'], 404);
    }
}
