<?php

namespace App\Http\Controllers;

use App\Penalty;
use App\Persons;
use Illuminate\Http\Request;

class PenaltyController extends Controller
{
    public function index()
    {
        $penalty=Penalty::select('penalties.id','penalties.cause','penalties.state',
            'penalties.entry_date','persons.name','persons.last_name','persons.document')
            ->where('penalties.state',1)
            ->join('persons', 'penalties.person_id', '=', 'persons.id')
            ->get();
        return response()->json($penalty);
    }

    public function penaltyDisabled()
    {
        $penalty=Penalty::select('penalties.id','penalties.cause','penalties.state',
            'penalties.entry_date','persons.name','persons.last_name','persons.document')
            ->where('penalties.state',0)
            ->join('persons', 'penalties.person_id', '=', 'persons.id')
            ->get();
        return response()->json($penalty);
    }

    public function store(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'cause'=>'required',
            'entry_date'=>'required',
            'person_id'=>'required',
        ]);
        if ($validator->fails()) {
            $data=[
                'code'=>400,
                'status'=>'error',
                'message'=>'Faltan datos'
            ];
        }else{
            $penalty=new Penalty();
            $penalty->cause=$request->cause;
            $penalty->entry_date=$request->entry_date;
            $penalty->state='1';
            $penalty->person_id=$request->person_id;
            $penalty->save();
            //$penalty = Penalty::create($request->all());
            $data=[
                'code'=>200,
                'status'=>'success',
                'penalty'=>$penalty
            ];
        }

        return response()->json($data, $data['code']);
    }

    public function getPersons(){
        $persons=Persons::select('id','document')->get();
        $data=[
            'code'=>200,
            'status'=>'success',
            'persons'=>$persons
        ];
        return response()->json($data, $data['code']);

    }

    public function edit($id)
    {
        $penalty = Penalty::findOrFail($id);
        return response()->json([
            'error' => false,
            'penalty'  => $penalty,
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $penalty = Penalty::findOrFail($id);
        $validator = \Validator::make($request->all(), [
            'cause'=>'required',
            'entry_date'=>'required',
            'state'=>'required',
            'person_id'=>'required',
        ]);
        if ($validator->fails()) {
            $data=[
                'code'=>400,
                'status'=>'error',
                'message'=>'Faltan datos'
            ];
        }else{
            $penalty->update($request->all());
            $data=[
                'code'=>200,
                'status'=>'success',
                'penalty'=>$penalty
            ];
        }

        return response()->json($data, $data['code']);
    }

    public function delete($id)
    {
        $penalty = Penalty::findOrFail($id);
        $penalty->delete();
        return 204;
    }
}
