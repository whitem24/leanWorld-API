<?php

namespace App\Http\Controllers\Internal;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Facades\Storage;
use DB;
/* use Illuminate\Support\Facades\DB; */
use App\Models\Activity_chapter;
use Illuminate\Support\Facades\App;

class ChapterActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($chapter_id)
    {
        $activities = Activity_chapter::all();

        if($activities){
            return response()->json($activities, 200);
        }
        return response()->json(['message' => 'Activities not found!'], 404);
    
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
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
            'description' => 'required',
            'activity_id' => 'required|numeric',
            'chapter_id' => 'required|numeric',
            'fileActivity' => $request->input('activity_id') == "1" || $request->input('activity_id') == "5" || $request->input('activity_id') == "6" || $request->input('activity_id') == "7" || $request->input('activity_id') == "8" || $request->input('activity_id') == "16" || $request->input('activity_id') == "17" ? 'required' : '',
            'duration' => $request->input('activity_id') == "1" || $request->input('activity_id') == "5" ? 'required' : '',
            'url' => $request->input('activity_id') == "3" || $request->input('activity_id') == "4" || $request->input('activity_id') == "9" || $request->input('activity_id') == "10" || $request->input('activity_id') == "11" ? 'required' : '',

            
        ]);
        
        if($validator->fails()){
            return response()->json([
                'error' => $validator->messages()], 404);
        }else{
            DB::beginTransaction();
            $description = $request->input('description');
            $activity_id = $request->input('activity_id');
            $duration = $request->input('duration');
            $link = $request->input('url');
            $chapter_id = $request->input('chapter_id');


            $activity = new Activity_chapter;
            $activity->description = $description;
            $activity->activity_id = $activity_id;
            $activity->chapter_id = $chapter_id;
            $activity->duration = $duration;
            $activity->link = $link;
            

            $activity->order = 1;
            $activity_order = Activity_chapter::where('chapter_id',$chapter_id)->orderBy('order', 'desc')->first();
            if($activity_order){
                $activity->order = $activity_order->order + 1;  
            }
            //image
            if($request->input('fileActivity')){
                $fileActivity = $request->input('fileActivity');
                $extension = explode('/', explode(':', substr($fileActivity, 0, strpos($fileActivity, ';')))[1])[1];
                $replace = substr($fileActivity, 0, strpos($fileActivity, ',')+1); 
                // find substring fro replace here eg: data:image/png;base64,
                $file = str_replace($replace, '', $fileActivity); 
                $file = str_replace(' ', '+', $file); 
                $fileName = time().'.'.$extension;

                
                $activity->path = $fileName;
            }

            if($activity->save()){
                if($request->input('fileActivity')){
                    if(Storage::disk('public')->put('/activities/files/'.$fileName, base64_decode($file))){
                        /* Storage::disk('public')->delete('/activities/files/'.$activity->path); */
                        DB::commit();
                        return response()->json(['message' => 'Successfully created activity!'], 200);                

                    }else{
                        DB::rollBack();
                        return response()->json(['message' => 'An error ocurred loading the video, please try again'], 404);

                    }
                }
                DB::commit();
                return response()->json(['message' => 'Successfully created activity!'], 200); 
               
            }
            DB::rollBack();
            return response()->json(['message' => 'activity was not created!'], 404);

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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $required = '';
        if ($request->input('fileActivity')) {
            $required = $request->input('activity_id') == "1" || $request->input('activity_id') == "5" || $request->input('activity_id') == "6" || $request->input('activity_id') == "7" || $request->input('activity_id') == "8" || $request->input('activity_id') == "16" || $request->input('activity_id') == "17" ? 'required' : '';
        }
        $validator = Validator::make($request->all(), [
            'description' => 'required',
            'activity_id' => 'required|numeric',
            'fileActivity' => $required,
            'duration' => $request->input('activity_id') == "1" || $request->input('activity_id') == "5" ? 'required' : '',
            'url' => $request->input('activity_id') == "3" || $request->input('activity_id') == "4" || $request->input('activity_id') == "9" || $request->input('activity_id') == "10" || $request->input('activity_id') == "11" ? 'required' : '',
            
        ]);
        
        if($validator->fails()){
            return response()->json([
                'error' => $validator->messages()], 404);
        }else{
            DB::beginTransaction();
            $description = $request->input('description');
            $activity_id = $request->input('activity_id');
            $duration = $request->input('duration');
            $link = $request->input('url');
            $chapter_id = $request->input('chapter_id');


            $activity =  Activity_chapter::find($id);
            $activity->description = $description;
            $activity->activity_id = $activity_id;
            $activity->duration = $duration;
            $activity->link = $link;
            $oldPath = $activity->path;
            /* $activity->order = 1; */
           /*  $activity_order = Activity_chapter::where('chapter_id',$chapter_id)->orderBy('order', 'desc')->first();
            if($activity_order){
                $activity->order = $activity_order->order + 1;  
            } */
            //image
            if ($request->input('fileActivity')) {
                $fileActivity = $request->input('fileActivity');
                $extension = explode('/', explode(':', substr($fileActivity, 0, strpos($fileActivity, ';')))[1])[1];
                $replace = substr($fileActivity, 0, strpos($fileActivity, ',')+1); 
                // find substring fro replace here eg: data:image/png;base64,
                $file = str_replace($replace, '', $fileActivity); 
                $file = str_replace(' ', '+', $file); 
                $fileName = time().'.'.$extension;
                $activity->path = $fileName;
                if (Storage::disk('public')->put('/activities/files/'.$fileName, base64_decode($file)))
                    Storage::disk('public')->delete('/activities/files/'.$oldPath);

            }
            
            if($activity->save()){

                DB::commit();
                return response()->json(['message' => 'Successfully updated activity!'], 200);                                
            }
            DB::rollBack();
            return response()->json(['message' => 'activity was not updated!'], 404);

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
        $activity = Activity_chapter::find($id);
        $order = $activity->order;
        $chapter_id = $activity->chapter_id;
        if($activity->delete()){
            Storage::disk('public')->delete('/activities/files/'.$activity->path);
            $activities = Activity_chapter::where('chapter_id', $chapter_id)->where('order', '>', $order)->whereNull('deleted_at')->get();
            if(count($activities) > 0){
                foreach ($activities as $activity) {
                    $row = Activity_chapter::find($activity->id);
                    $row->order = $row->order - 1;
                    $row->save();
                }
            }
          return response()->json(['message' => 'The activity has been deleted successfully'], 200);
        }
        return response()->json(['error' => 'The activity was not deleted!'], 404);
    }
}
