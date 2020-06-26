<?php

namespace App\Http\Controllers;
use App\member;
use Illuminate\Http\Request;


class ApiController extends Controller
{
    public function create(Request $request){
        // print_r('dd');
        // die('*****');
        $todo= new member();
        $todo->fname =$request->input('fname');
        $todo->lname= $request->input('lname');
        $todo->divition = $request->input('divition');
        $todo->dob= $request->input('dob');
        $todo->summery = $request->input('summery');
        $todo->save();
        return response()->json($todo);
    }

    public function show(){
        $todos = member::all();
        return response()->json($todos);
    }     

    public function showid($id){
        $todos = member::find($id);
        return response()->json($todos);
    } 
    

    public function updateid(Request $request, $id){
        $todo = member::find($id);
        $todo->fname =$request->input('fname');
        $todo->lname= $request->input('lname');
        $todo->divition = $request->input('divition');
        $todo->dob= $request->input('dob');
        $todo->summery = $request->input('summery');
        $todo->save();
        return response()->json($todo);
    }

    public function del($id){
        $todo = member::find($id);
        $todo->delete();
        return response()->json($todo);
    }   
    

  
}
