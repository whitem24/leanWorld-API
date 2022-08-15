<?php

namespace App\Http\Controllers\Internal;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use DB;
use App\Models\Role;
use App\Models\Permission;
use Illuminate\Support\Facades\App;

class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::all();

        if($roles){
            return response()->json($roles, 200);
        }
        return response()->json(['message' => 'Roles not found!'], 404);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissions = Permission::all();

        if($permissions){
            return response()->json($permissions, 200);
        }
        return response()->json(['message' => 'Roles not found!'], 404);
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
            'description' => 'required|unique:roles,description,NULL,id,deleted_at,NULL',
            'permissions' => 'required'
        ]);
        if($validator->fails()){
            return response()->json([
                'error' => $validator->messages()], 404);
        }else{
            $description = $request->input('description');
            $permissions = $request->get('permissions');


            $role = new Role;
            $role->description = $description;
            

            if($role->save()){
                $role->permissions()->attach($permissions);
                return response()->json(['message' => 'Successfully created role!'], 200);
                
            }
            return response()->json(['message' => 'Role was not created!'], 404);

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
        $role = Role::with('permissions')->where('id',$id)->first();

        if($role){
            return response()->json($role, 200);
        }
        return response()->json(['message' => 'Role not found!'], 404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role = Role::with('permissions')->where('id',$id)->first();
        $permissions = Permission::all();

        if($role){
            return response()->json(['role' => $role,'permissions' => $permissions], 200);
        
        }
        return response()->json(['message' => 'Role not found!'], 404);
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
        $currentRole = Role::find($id);
        $unique = 'unique:roles,description';
       
        if($request->input('description')==$currentRole->description){
            $unique = '';
        }
        //return $required;
        $validator = Validator::make($request->all(), [
            'description' => 'required|'.$unique,
            'permissions' => 'required'
        ]);
        if($validator->fails()){
            return response()->json([
                'error' => $validator->messages()], 404);
        }else{
            $description = $request->input('description');
            $permissions = $request->get('permissions');


            $role =Role::find($id);
            $role->description = $description;
            

            if($role->save()){
                $role->permissions()->sync($permissions);
                return response()->json(['message' => 'Successfully updated role!'], 200);
                
            }
            return response()->json(['message' => 'Role was not found!'], 404);

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
        $role = Role::find($id);
        if($role->permissions()->detach()){
            if($role->delete()){
              return response()->json(['message' => 'Successfully deleted role!'], 200);
            }
        }
        return response()->json(['error' => 'Role was not deleted!'], 404);
    }
}
