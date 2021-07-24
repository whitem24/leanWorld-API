<?php
namespace App\Http\Controllers\Internal;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;
use Auth;
use Validator;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required', 
            'email' => 'required|email', 
            'password' => 'required|min:6'
        ]);


        $user = User::create([
            'name' => $request->name, 
            'email' => $request->email, 
            'password' => bcrypt($request->password)
        ]);

        return response()->json($user);
    }
    public function login(Request $request)
    {
       /*  $request->validate([
            'email' => 'required|email|exists:users,email', 
            'password' => 'required'
        ]); */
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users,email', 
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->messages()], 404);   
        }

        if( Auth::attempt(['email'=>$request->email, 'password'=>$request->password]) ) {
            $usuario = Auth::user();
            $user = User::with(['roles.permissions.menu' => function($query) {
                $query->orderBy('order', 'ASC');
            },])->where('id', $usuario->id)->first();
            //$user = Role::with('permissions.menu_p')->where('id', 1)->first();
          //  var_dump($user);
            //$user = Permission::with('menu')->where('id', 1)->first();
            $token = $user->createToken($user->email.'-'.now());

            return response()->json([
                'token' => $token->accessToken, 'user' => $user
            ]);
        }else{
            return response()->json([
                'error_mismatch' => 'Invalid E-mail or password.'
            ], 404);
        }
    }

    
}
