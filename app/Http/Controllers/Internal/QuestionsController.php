<?php

namespace App\Http\Controllers\Internal;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use DB;
use App\Models\Question;
use App\Models\Type_question;

class QuestionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $question = Question::all();

        if($question){
            return response()->json($question, 200);
        }
        return response()->json(['message' => 'Question not found!'], 404);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $type_question = Type_question::all();

        if($type_question){
            return response()->json($type_question, 200);
        }
        return response()->json(['message' => 'Type question not found!'], 404);
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
            'order' => 'required|numeric',
            'questionnaires_id' => 'required|numeric',
            'type_questions_id' => 'required|numeric'
        ]);
        if($validator->fails()){
            return response()->json([
                'error' => $validator->messages()], 404);
        }else{

            $title = $request->input('title');
            $order = $request->input('order');
            $questionnaires_id = $request->input('questionnaires_id');
            $type_questions_id = $request->input('type_questions_id');

            $question = new Question;
            $question->title = $title;
            $question->order = $order;
            $question->questionnaires_id = $questionnaires_id;
            $question->type_questions_id = $type_questions_id;

            if($question->save()){
                return response()->json(['message' => 'Successfully created question!'], 200);
            }
            return response()->json(['message' => 'Question was not created!'], 404);

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
        $question = Question::with('type_question')->where('id', $id)->first();

        if($question){
        	return response()->json($question, 200);
        }
        return response()->json(['message' => 'Question not found!'], 404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $question = Question::with('type_question')->where('id', $id)->first();
        $type_question = Type_question::all();

        if($question){
            return response()->json(['question' => $question, 'type_question' => $type_question], 200);
        }
        return response()->json(['message' => 'Question not found!'], 404);
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
            'title' => 'required',
            'order' => 'required|numeric',
            'questionnaires_id' => 'required|numeric',
            'type_questions_id' => 'required|numeric'
        ]);
        if($validator->fails()){
            return response()->json([
                'error' => $validator->messages()], 404);
        }else{

            $title = $request->input('title');
            $order = $request->input('order');
            $questionnaires_id = $request->input('questionnaires_id');
            $type_questions_id = $request->input('type_questions_id');

            $question = Question::find($id);
            $question->title = $title;
            $question->order = $order;
            $question->questionnaires_id = $questionnaires_id;
            $question->type_questions_id = $type_questions_id;

            if($question->save()){
                return response()->json(['message' => 'Successfully updated question!'], 200);
            }
            return response()->json(['message' => 'Question was not updated!'], 404);

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
        $question = Question::find($id);

        if($question->delete()){
            return response()->json(['message' => 'Successfully deleted question!'], 200);
        }
        return response()->json(['error' => 'Question was not deleted!'], 404);
    }
}
