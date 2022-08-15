<?php

namespace App\Http\Controllers\Internal;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use DB;
use App\Models\Chapter;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\App;

class ChaptersController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $chapters = Chapter::all();

        if($chapters){
            return response()->json($chapters, 200);
        }
        return response()->json(['message' => 'Chapters not found!'], 404);
    
    
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
        $arrDescriptions = [];
        $chapters = Chapter::where('course_id', $request->course_id)->get();
        foreach ($chapters as $key => $value) {
            $arrDescriptions[$key] = $value->description;
        }
        $messages = [
            'not_in' => $request->lang=='en' ? 'The :attribute is already in use': 'La :attribute ya está en uso',
        ];
        $validator = Validator::make($request->all(), [
            'description' =>  [
                'required',
                Rule::notIn($arrDescriptions),
            ],
            'course_id' => 'required|numeric',
        ], $messages);
        if($validator->fails()){
            return response()->json([
                'error' => $validator->messages()], 404);
        }else{
            $description = $request->input('description');
            $course_id = $request->input('course_id');
            $chapter = new Chapter;
            $chapter->description = $description;
            $chapter->course_id = $course_id;
            

            if($chapter->save()){
                return response()->json(['message' => 'Successfully created chapter!'], 200);                
            }
            return response()->json(['message' => 'Chapter was not created!'], 404);

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
        
        $chapter = Chapter::find($id);

        if($chapter){
            return response()->json($chapter, 200);
        }
        return response()->json(['message' => 'Chapter not found!'], 404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
        $chapter = Chapter::find($id);

        if($chapter){
            return response()->json($chapter, 200);
        }
        return response()->json(['message' => 'Chapter not found!'], 404);
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
        $chapter = Chapter::find($id);
        $arrDescriptions = [];
        $chapters = Chapter::where('course_id', $chapter->course_id)->get();
        foreach ($chapters as $key => $value) {
            $arrDescriptions[$key] = $value->description;
        }
        $messages = [
            'not_in' => $request->lang=='en' ? 'The :attribute is already in use': 'La :attribute ya está en uso',
        ];
        /* $unique = $chapter->description == $request->description ? '' : 'unique:chapters,description,{$id},id,deleted_at,NULL'; */
        $validator = Validator::make($request->all(), [
            'description' => [
                'required',
                Rule::notIn($arrDescriptions),
            ],
        ], $messages);
        if($validator->fails()){
            return response()->json([
                'error' => $validator->messages()], 404);
        }else{
            $description = $request->input('description');
            $chapter->description = $description;

            if($chapter->save()){
                return response()->json(['message' => 'Successfully updated chapter!'], 200);                
            }
            return response()->json(['message' => 'Chapter was not updated!'], 404);

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
        $chapter = Chapter::find($id);
        if($chapter->delete()){
          return response()->json(['message' => 'Successfully deleted chapter!'], 200);
        }
        return response()->json(['error' => 'Chapter was not deleted!'], 404);

    }
}
