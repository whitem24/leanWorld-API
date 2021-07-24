<?php
namespace App\Http\Controllers\Internal;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Validator;
use DB;
use App\Models\Questionnaire;
use App\Models\Type_questionnaire;


class QuestionnairesController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $questionnaires = Questionnaire::all();

        if($questionnaires){
            return response()->json($questionnaires, 200);
        }
        return response()->json(['message' => 'Questionnaires not found!'], 404);
    
    
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $type_questionnaires = Type_questionnaire::all();
        if($type_questionnaires){
            return response()->json($type_questionnaires, 200);
        }
        return response()->json(['message' => 'Questionnaire not found!'], 404);
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
            'title' => 'required',
            'description' => 'required',
            'type_questionnaire_id' => 'required|numeric',
            'questionnaireble_id' => 'required|numeric',
            'questionnaireble_type' => 'required',
            'order' => 'required|numeric',
        ]);
        if($validator->fails()){
            return response()->json([
                'error' => $validator->messages()], 404);
        }else{
            $title = $request->input('title');
            $description = $request->input('description');
            $type_questionnaire_id = $request->input('type_questionnaire_id');
            $questionnaireble_id = $request->input('questionnaireble_id');
            $questionnaireble_type = $request->input('questionnaireble_type');
            $order = $request->input('order');
            $questionnaire = new Questionnaire;
            $questionnaire->title = $title;
            $questionnaire->description = $description;
            $questionnaire->type_questionnaire_id = $type_questionnaire_id;
            $questionnaire->questionnaireble_id = $questionnaireble_id;
            $questionnaire->questionnaireble_type = $questionnaireble_type;
            $questionnaire->order = $order;
            

            if($questionnaire->save()){
                return response()->json(['message' => 'Successfully created questionnaire!'], 200);                
            }
            return response()->json(['message' => 'Questionnaire was not created!'], 404);

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
        
        $questionnaire = Questionnaire::with('type_questionnaire')->where('id', $id)->first();

        if($questionnaire){
            return response()->json($questionnaire, 200);
        }
        return response()->json(['message' => 'Questionnaire not found!'], 404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {    
        $questionnaire = Questionnaire::with('type_questionnaire')->where('id', $id)->first();
        $type_questionnaire = Type_questionnaire::all();
        if($questionnaire){
            return response()->json(['questionnaire' => $questionnaire, 'type_questionnaire' => $type_questionnaire], 200);
        }
        return response()->json(['message' => 'Questionnaire not found!'], 404);
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
        
        $questionnaire = Questionnaire::find($id);
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'description' => 'required',
            'type_questionnaire_id' => 'required|numeric',
            'questionnaireble_id' => 'required|numeric',
            'questionnaireble_type' => 'required',
            'order' => 'required|numeric',
        ]);
        if($validator->fails()){
            return response()->json([
                'error' => $validator->messages()], 404);
        }else{
            $title = $request->input('title');
            $description = $request->input('description');
            $type_questionnaire_id = $request->input('type_questionnaire_id');
            $questionnaireble_id = $request->input('questionnaireble_id');
            $questionnaireble_type = $request->input('questionnaireble_type');
            $order = $request->input('order');
            $questionnaire->title = $title;
            $questionnaire->description = $description;
            $questionnaire->type_questionnaire_id = $type_questionnaire_id;
            $questionnaire->questionnaireble_id = $questionnaireble_id;
            $questionnaire->questionnaireble_type = $questionnaireble_type;
            $questionnaire->order = $order;
           

            if($questionnaire->save()){
                return response()->json(['message' => 'Successfully updated questionnaire!'], 200);                
            }
            return response()->json(['message' => 'Questionnaire was not updated!'], 404);

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
        $questionnaire = Questionnaire::find($id);
        if($questionnaire->delete()){
          return response()->json(['message' => 'Successfully deleted questionnaire!'], 200);
        }
        return response()->json(['error' => 'Questionnaire was not deleted!'], 404);

    }
}
