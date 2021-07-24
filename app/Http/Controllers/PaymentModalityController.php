<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lw_payment_modality;
use Validator;
use App\Models\Lw_users_course_modality;

class PaymentModalityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function get_user_course_modality($userId,$courseId){
        $row = Lw_users_course_modality::where('user_id',$userId)
                                        ->where('course_id',$courseId)
                                        ->first();
        
        if($row){
            $modality = Lw_payment_modality::find($row->payment_modality_id);
            return response()->json(
                $modality, 200);

        }
        return response()->json(["Message" => "Not found"], 404);

    }
    public function index()
    {
        $payments = Lw_payment_modality::all();
        if($payments){
            return response()->json(
                $payments, 200);

        }
        return response()->json(["Message" => "Modalities not found"], 404); 
        
    }
    public function assignModality(Request $request)
    {
    
        $validator = Validator::make($request->all(), [
            'modality' => 'required',
        ]);
        if($validator->fails()){
            return response()->json([
                'error' => $validator->messages()], 404);
        }else{
            $mod = Lw_users_course_modality::where('user_id',$request->input('userId'))
                                            ->where('course_id',$request->input('courseId'))
                                            ->first();
                $modality = $request->input('modality');
                $username = $request->input('username');
            if(!$mod){
                $mod = new Lw_users_course_modality;
                $mod->username = $username;
                
                $mod->payment_modality_id = $modality;
                
                $mod->user_id = $request->input('userId');
                
                $mod->course_id = $request->input('courseId');
                

                if($mod->save()){
                    return response()->json(['message' => 'Successful Assignment!'], 200);    
                }
                return response()->json(['message' => 'Unsuccessful Assignment!'], 404);
                

           }else{
                $mod->username = $username;
                    
                $mod->payment_modality_id = $modality;
                
                $mod->user_id = $request->input('userId');
                
                $mod->course_id = $request->input('courseId');
                if($mod->save()){
                    return response()->json(['message' => 'Successful Updated!'], 200);        
                }
                return response()->json(['message' => 'Unsuccessful Updated!'], 404);
            
               
           }
            

        }
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    
}
