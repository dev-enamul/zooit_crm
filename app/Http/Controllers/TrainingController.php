<?php

namespace App\Http\Controllers;

use App\Models\Training;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TrainingController extends Controller
{ 

    public function index(Request $request){ 
        if(isset($request->month)){ 
            $month =  Carbon::parse($request->month)->format('m');
            $year =  Carbon::parse($request->month)->format('Y'); 
            $date = Carbon::parse($request->month)->format('Y-m');
        }else{
            $month =  Carbon::now()->format('m');
            $year =  Carbon::now()->format('Y');
            $date = Carbon::now()->format('Y-m');
        }

        $datas = Training::whereMonth('date',$month)->whereYear('date',$year)->get();
 
        return view('training.training_history',compact('datas','date'));
    }

    public function create(){ 
        $employees = User::where('user_type','1')->select('name','id','user_id')->get();
        return view('training.training_create',compact('employees'));
    }

    public function store(Request $request){
        $rules = [
            'title' => 'required|string|max:255',
            'trainer' => 'required|array',
            'seat' => 'required|integer|min:1',
            'date' => 'required|date',
            'time' => 'required|date_format:H:i',
            'agenda' => 'nullable|string',
        ];   

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator)->with('error', $validator->errors()->first());
        }  

       try{
            $event = new Training();
            $event->title   = $request->title;
            $event->trainer = json_encode($request->trainer); 
            $event->seat    = $request->seat;
            $event->date    = $request->date;
            $event->time    = $request->time;
            $event->agenda  = $request->agenda;
            $event->save(); 
            return redirect()->back()->with('success', 'Training created successfully'); 
       }catch(Exception $e){
            return redirect()->back()->with('error', $e->getMessage());
       }
    }


    public function training_schedule(){
        return view('training.training_schedule');
    }
 

    public function training_details(){
        return view('training.training_details');
    }
}
