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
use App\client;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    
    //view table
      public function phptable(){
        $types = member::get();
        return view('php.table',compact('types'));
    }
    
    //edit table
    public function newedit($id){
     $editdata=member::where('id',$id)->get();
    //  print_r($editdata);
    //  die();
    // dd($editdata);
     return view('php.update',compact('editdata'));
   }

   //update
    public function postupdate(Request $request){
      $up=member::where('id',$request->id)->first();
      $up->update([
        'fname' =>$request->input('fname'),
        'lname' =>$request->input('lname'),
        'divition' =>$request->input('divition'),
        'dob' =>$request->input('dob'),
        'summery' =>$request->input('summery')
      ]);
      $types = member::get();
      return view('php.table',compact('types'));
    }

   //del
   public function newdel($id){
    //  dd($id);
    member::where('id',$id)->delete();
    return redirect()->back();
   }

   
   public function search(Request $request){
    
    $types = member::where('fname','LIKE',$request->search)->orWhere('divition','LIKE',$request->search)->get();
    return view('php.table',compact('types'));
   }


   public function short_by(Request $request){
    
    $types = member::all()->sortBy("fname");
    return view('php.table',compact('types'));
   }
  
   public function shortbylname(Request $request){
    $types = member::all()->sortBy("lname");
    return view('php.table',compact('types'));
   }

   public function shortbydivition(Request $request){
    $types = member::all()->sortBy("divition");
    return view('php.table',compact('types'));
   }

   public function shortbydob(Request $request){
    $types = member::all()->sortBy("dob");
    return view('php.table',compact('types'));
   }
  //  $results = Project::all()->sortBy("name");
}
