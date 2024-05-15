<?php

namespace App\Http\Controllers;

use App\Models\Meeting;
use App\Models\MeetingAttendance;
use App\Models\Notification;
use App\Models\Training;
use App\Models\TrainingAttendance;
use App\Models\TrainingCategory;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        $reporting_employee = json_decode(auth()->user()->user_employee); 
        $all_reporting = array_merge($reporting_user,$reporting_employee);
        $datas = Training::whereMonth('date',$month)
            ->whereYear('date',$year)
            ->whereIn('created_by',$all_reporting)
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


    public function edit($id){
        $data = Training::find($id);
        $categoris =  TrainingCategory::where('status',1)->get();
        return view('training.training_edit',compact('data','categoris'));
    }

    public function update(Request $request, $id){ 
 
        $validator = Validator::make($request->all(), [
            'category_id' => 'required|string|max:255|exists:training_categories,id',
            'trainer' => 'required|array',
            'seat' => 'required|integer|min:1',
            'date' => 'required|date',
            'time' => 'required',
            'agenda' => 'nullable|string',
        ]);
        
        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator)->with('error', $validator->errors()->first());
        }

       try{
            $event = Training::find($id); 
            $event->category_id  = $request->category_id;
            $event->trainer = json_encode($request->trainer); 
            $event->seat    = $request->seat;
            $event->date    = $request->date;
            $event->time    = $request->time;
            $event->agenda  = $request->agenda;
            $event->save();
            return redirect()->route('training.index')->with('success', 'Training updated successfully'); 
       }catch(Exception $e){
            return redirect()->back()->with('error', $e->getMessage());
       }
    }

    public function training_schedule(){
        $attendance = TrainingAttendance::where('user_id',auth()->user()->id)->with('training')->get();
        $datas = [];
        foreach ($attendance as $data) {
            $datas[] = [
                'title' => "Training ".$data->training->category->title,
                'url' => route('training.show', $data->training->id),
                'date' => $data->training->date . ' ' . $data->training->time,
                
            ];
        }

        $trainings = Training::whereJsonContains('trainer',(string) auth()->user()->id)->get(); 
        foreach ($trainings as $data) {
            $datas[] = [
                'title' => "Trainer ".$data->category->title,
                'url' => route('training.show', $data->id),
                'date' => $data->date . ' ' . $data->time,
                
            ];
        }

        $trainings = Training::where('created_by', auth()->user()->id)->get(); 
        foreach ($trainings as $data) {
            $datas[] = [
                'title' => "Creator ".$data->category->title,
                'url' => route('training.show', $data->id),
                'date' => $data->date . ' ' . $data->time,
                
            ];
        } 

        $meetings = MeetingAttendance::where('user_id',auth()->user()->id)->with('meeting')->get();
        foreach ($meetings as $data) {
            $datas[] = [
                'title' => "Meeting ".$data->meeting->title,
                'url' => route('meeting.show', encrypt($data->meeting->id)),
                'date' => $data->meeting->date_time,
                
            ];
        }

        $meetings = Meeting::where('created_by', auth()->user()->id)->get();
        foreach ($meetings as $data) {
            $datas[] = [
                'title' => "Meeting ".$data->title,
                'url' => route('meeting.show', encrypt($data->id)),
                'date' => $data->date_time,
                
            ];
        }

        return view('training.training_schedule',compact('datas'));
    }
  
    public function show($id){
        try{
            $data = Training::find($id); 
            $trainers = json_decode($data->trainer);
            $trainers = User::whereIn('id',$trainers)->get();
            $present = TrainingAttendance::where('training_id',$id)->where('status',1)->get();
            $absent = TrainingAttendance::where('training_id',$id)->where('status',0)->get();

            $bookeds = TrainingAttendance::where('training_id',$id)->get();

            $is_attendent_changer = false;
            $is_time_end = false;
            $is_admin = Auth::user()->hasPermission('admin');
            if($is_admin){
                $is_attendent_changer = true;
            }

            if($data->created_by == auth()->user()->id){
                $is_attendent_changer = true;
            }

            $date_time = $data->date.' '.$data->time;
            if($date_time < Carbon::now()){ 
                $is_time_end = true;
            }

            if(in_array(auth()->user()->id,json_decode($data->trainer))){
                $is_attendent_changer = true;
            } 
            return view('training.training_details',compact('data','trainers','present','absent','bookeds','is_time_end','is_attendent_changer'));
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
                    'status' => 0,
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

    public function training_attendance_status($id){
        $id = decrypt($id);
        $data = TrainingAttendance::find($id);
        $data->status = !$data->status;
        $data->save(); 
        return redirect()->back()->with('success', 'Attendance updated successfully');
    }

    public function training_attendance($id){
        $id = decrypt($id);
        $data = Training::with('attendance')->find($id); 
        return view('training.training_attendance',compact('data'));
    }

    
}
