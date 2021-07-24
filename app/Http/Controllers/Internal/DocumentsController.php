<?php

namespace App\Http\Controllers\Internal;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use DB;
use App\Models\Type_document;
use App\Models\Document;

class DocumentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $document = Document::all();

        if($document){
            return response()->json($document, 200);
        }
        return response()->json(['message' => 'Document not found!'], 404);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $type_document = Type_document::all();

        if($type_document){
            return response()->json($type_document, 200);
        }
        return response()->json(['message' => 'Type document not found!'], 404);
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
            'path' => 'required',
            'order' => 'required|numeric',
            'type_document_id' => 'required|numeric',
            'documentable_id' => 'required|numeric',
            'documentable_type' => 'required'
        ]);
        if($validator->fails()){
            return response()->json([
                'error' => $validator->messages()], 404);
        }else{

            $title = $request->input('title');
            $path = $request->input('path');
            $order = $request->input('order');
            $type_document_id = $request->input('type_document_id');
            $documentable_id = $request->input('documentable_id');
            $documentable_type = $request->input('documentable_type');

            $document = new Document;
            $document->title = $title;
            $document->path = $path;
            $document->order = $order;
            $document->type_document_id = $type_document_id;
            $document->documentable_id = $documentable_id;
            $document->documentable_type = $documentable_type;

            if($document->save()){
                return response()->json(['message' => 'Successfully created document!'], 200);
            }
            return response()->json(['message' => 'Course was not created!'], 404);

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
        $document = Document::with('type_document')->where('id', $id)->first();
        
        if($document){
        	return response()->json($document, 200);
        }
        return response()->json(['message' => 'Document not found!'], 404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $document = Document::with('type_document')->where('id', $id)->first();
        $type_document = Type_document::all();

        if($document){
            return response()->json(['document' => $document, 'type_document' => $type_document], 200);
        }
        return response()->json(['message' => 'Document not found!'], 404);
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
            'path' => 'required',
            'order' => 'required|numeric',
            'type_document_id' => 'required|numeric',
            'documentable_id' => 'required|numeric',
            'documentable_type' => 'required'
        ]);
        if($validator->fails()){
            return response()->json([
                'error' => $validator->messages()], 404);
        }else{

            $title = $request->input('title');
            $path = $request->input('path');
            $order = $request->input('order');
            $type_document_id = $request->input('type_document_id');
            $documentable_id = $request->input('documentable_id');
            $documentable_type = $request->input('documentable_type');

            $document = Document::find($id);
            $document->title = $title;
            $document->path = $path;
            $document->order = $order;
            $document->type_document_id = $type_document_id;
            $document->documentable_id = $documentable_id;
            $document->documentable_type = $documentable_type;

            if($document->save()){
                return response()->json(['message' => 'Successfully updated Document!'], 200);
            }
            return response()->json(['message' => 'Document was not updated!'], 404);

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
        $document = Document::find($id);

        if($document->delete()){
            return response()->json(['message' => 'Successfully deleted Document!'], 200);
        }
        return response()->json(['error' => 'Document was not deleted!'], 404);
    }
}
