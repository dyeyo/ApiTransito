<?php

namespace App\Http\Controllers;

use App\Persons;
use Illuminate\Http\Request;

class PersonsController extends Controller
{
    public function index()
    {
        $person=Persons::all();
        return response()->json($person);
    }

    public function store(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'name'=>'required',
            'last_name'=>'required',
            'document'=>'required',
            'plate_car'=>'required',
            'model_car'=>'required',
        ]);
        if ($validator->fails()) {
            $data=[
                'code'=>400,
                'status'=>'error',
                'message'=>'Faltan datos'
            ];
        }else{
            $person = Persons::create($request->all());
            $data=[
                'code'=>200,
                'status'=>'success',
                'person'=>$person
            ];
        }

        return response()->json($data, $data['code']);
    }

    public function edit($id)
    {
        $person = Persons::findOrFail($id);
        return response()->json([
            'error' => false,
            'person'  => $person,
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $person = Persons::findOrFail($id);
        $validator = \Validator::make($request->all(), [
            'name'=>'required',
            'last_name'=>'required',
            'document'=>'required',
            'plate_car'=>'required',
            'model_car'=>'required',
        ]);
        if ($validator->fails()) {
            $data=[
                'code'=>400,
                'status'=>'error',
                'message'=>'Faltan datos'
            ];
        }else{
            $person->update($request->all());
            $data=[
                'code'=>200,
                'status'=>'success',
                'person'=>$person
            ];
        }

        return response()->json($data, $data['code']);
    }

    public function delete($id)
    {
        $person = Persons::findOrFail($id);
        $person->delete();
        return 204;
    }
}
