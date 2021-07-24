<?php

namespace App\Http\Controllers\Internal;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use DB;
use App\Models\Certificate;
use App\Models\Type_certificate;

class CertificatesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $certificate = Certificate::all();

        if($certificate){
            return response()->json($certificate, 200);
        }
        return response()->json(['message' => 'Certificate not found!'], 404);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $type_certificate = Type_certificate::all();

        if($type_certificate){
            return response()->json($type_certificate, 200);
        }
        return response()->json(['message' => 'Type certificate not found!'], 404);
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
            'order' => 'required|numeric',
            'type_questionnaires_id' => 'required|numeric',
            'questionnaireble_id' => 'required|numeric',
            'questionnaireble_type' => 'required|numeric'
        ]);
        if($validator->fails()){
            return response()->json([
                'error' => $validator->messages()], 404);
        }else{

            $title = $request->input('title');
            $description = $request->input('description');
            $order = $request->input('order');
            $type_certificates_id = $request->input('type_certificates_id');
            $certificateable_id = $request->input('certificateable_id');
            $certificateable_type = $request->input('certificateable_type');

            $certificate = new Certificate;
            $certificate->title = $title;
            $certificate->description = $description;
            $certificate->order = $order;
            $certificate->type_certificates_id = $type_certificates_id;
            $certificate->certificateable_id = $certificateable_id;
            $certificate->certificateable_type = $certificateable_type;

            if($certificate->save()){
                return response()->json(['message' => 'Successfully created certificate!'], 200);
            }
            return response()->json(['message' => 'Certificate was not created!'], 404);

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
        $certificate = Certificate::with('type_certificate')->where('id', $id)->first();

        if($certificate){
        	return response()->json($certificate, 200);
        }
        return response()->json(['message' => 'Certificate not found!'], 404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $certificate = Certificate::with('type_certificate')->where('id', $id)->first();
        $type_certificate = Type_certificate::all();

        if($certificate){
            return response()->json(['certificate' => $certificate, 'type_certificate' => $type_certificate], 200);
        }
        return response()->json(['message' => 'Certificate not found!'], 404);
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
            'description' => 'required',
            'order' => 'required|numeric',
            'type_questionnaires_id' => 'required|numeric',
            'questionnaireble_id' => 'required|numeric',
            'questionnaireble_type' => 'required|numeric'
        ]);
        if($validator->fails()){
            return response()->json([
                'error' => $validator->messages()], 404);
        }else{

            $title = $request->input('title');
            $description = $request->input('description');
            $order = $request->input('order');
            $type_certificates_id = $request->input('type_certificates_id');
            $certificateable_id = $request->input('certificateable_id');
            $certificateable_type = $request->input('certificateable_type');

            $certificate = Certificate::find($id);
            $certificate->title = $title;
            $certificate->description = $description;
            $certificate->order = $order;
            $certificate->type_certificates_id = $type_certificates_id;
            $certificate->certificateable_id = $certificateable_id;
            $certificate->certificateable_type = $certificateable_type;

            if($certificate->save()){
                return response()->json(['message' => 'Successfully updated certificate!'], 200);
            }
            return response()->json(['message' => 'Certificate was not updated!'], 404);

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
        $certificate = Certificate::find($id);

        if($certificate->delete()){
            return response()->json(['message' => 'Successfully deleted certificate!'], 200);
        }
        return response()->json(['error' => 'Certificate was not deleted!'], 404);
    }
}
