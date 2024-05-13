<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use App\Models\Training;
use App\Models\TrainingAttendance;
use App\Models\TrainingCategory;
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

        $reporting_user = json_decode(auth()->user()->user_reporting);
        $datas = Training::whereMonth('date',$month)
            ->whereYear('date',$year)
            ->whereIn('created_by',$reporting_user)
            ->get();
 
        return view('training.training_history',compact('datas','date'));
    }

    public function create(){  
        $categoris =  TrainingCategory::where('status',1)->get();
        return view('training.training_create',compact('categoris'));
    }

    public function store(Request $request){ 
    $validator = Validator::make($request->all(), [
            'category_id' => 'required|string|max:255|exists:training_categories,id',
            'trainer' => 'required|array',
            'seat' => 'required|integer|min:1',
            'date' => 'required|date',
            'time' => 'required|date_format:H:i',
            'agenda' => 'nullable|string',
        ]);
        
        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator)->with('error', $validator->errors()->first());
        }

       try{
            $event = new Training(); 
            $event->category_id   = $request->category_id;
            $event->trainer = json_encode($request->trainer); 
            $event->seat    = $request->seat;
            $event->date    = $request->date;
            $event->time    = $request->time;
            $event->agenda  = $request->agenda;
            $event->created_by = auth()->id();
            $event->save(); 
            return redirect()->back()->with('success', 'Training created successfully'); 
       }catch(Exception $e){
            return redirect()->back()->with('error', $e->getMessage());
       }
    }


    public function training_schedule(){
        return view('training.training_schedule');
    }
  
    public function show($id){
        try{
            $data = Training::find($id); 
            $trainers = json_decode($data->trainer);
            $trainers = User::whereIn('id',$trainers)->get();
            $present = TrainingAttendance::where('training_id',$id)->where('status',1)->get();
            $absent = TrainingAttendance::where('training_id',$id)->where('status',0)->get();

            $bookeds = TrainingAttendance::where('training_id',$id)->get();
            return view('training.training_details',compact('data','trainers','present','absent','bookeds'));
        }catch(Exception $e){
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function training_add_person(Request $request){
       foreach($request->user_id as $user){
            $existing = TrainingAttendance::where('training_id',$request->training_id)->where('user_id',$user)->first();
             if(!isset($existing) || empty($existing)){
                $data = [
                    'training_id' => $request->training_id,
                    'user_id' => $user,
                    'status' => 1,
                    'created_by' => auth()->user()->id
                ];

                TrainingAttendance::create($data);  
                Notification::store([
                    'title' => 'You have been added to a training',
                    'content' => auth()->user()->name . 'has added you to a training please check your schedule',
                    'link' => route('training.schedule'),
                    'created_by' => auth()->user()->id,
                    'user_id' => [$user]
                ]);
             } 
       }
        return redirect()->back()->with('success', 'Person added successfully');
    }

    public function training_attendance($id){
        $data = Training::find($id);
        $attendance = TrainingAttendance::where('training_id',$id)->get();
        dd($attendance);
    }

    
}
