<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Requestr; 
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Validator;
use DB;
use DataTables;
use Carbon\Carbon;
use App\User;
use App\member;


class TaskController extends Controller{
  
  //view table
    public function table(){
    $types = member::get();
    return view('table',compact('types'));
}

//create member
  public function laradd_available(Request $request){  
    member::create($request->all());
}


// add data
  public function addAvailable(Request $request){
    member::create($request->all());
    return redirect()->back()->with('alert', 'Data Successfully Updated!');;
  }


//get to tabale
  public function getclients(Request $request){
      $rr= member::get();

      return Datatables::of($rr)
      ->addColumn('action', function($row){
 
        $model='<button class="btn btn-primary btn-edit" data-toggle="modal" data-target="#addAvailableModal" data-id="'.$row->id.'">Edit</button>';
        $Delete= '<button class="btn btn-danger btn-delete" data-id="'.$row->id.'">Delete</button>';
        return $model.' '.$Delete;
      })
      ->rawColumns(['action'])
      ->make(true);                                                                                                                                                                                                                                                       
  }


  //edit
  public function getclientid($id){
    $rtr=member::where('id',$id)->first();
     return $rtr;
  }
  
  //update
  public function changeclient(Request $request){
    $rr =member::where('id',$request->input('id'))->first();

      $rr->update([
        'fname' =>$request->input('fname'),
        'lname' =>$request->input('lname'),
        'divition' =>$request->input('divition'),
        'dob' =>$request->input('dob'),
        'summery' =>$request->input('summery')
      ]);

      return response()->json(['msg' => 'You successfully Updated']);
  }

  //delete
  public function clientdel($id){
    member::where('id',$id)->delete();
    return response()->json(['msg' => 'You successfully Delete']);  
  }


  
}
