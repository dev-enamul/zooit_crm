<?php

namespace App\Http\Controllers;

use App\DataTables\MeetingDataTable;
use App\Models\Customer;
use App\Models\Meeting;
use App\Models\MeetingAttendance;
use App\Models\Notification;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class MeetingController extends Controller
{ 
    public function index(MeetingDataTable $dataTable, Request $request)
    {
        $title      = 'Meeting Schedule';
        $date       = $request->date ?? null;
        $status     = $request->status ?? 0;
        $start_date = Carbon::parse($date ? explode(' - ', $date)[0] : date('Y-m-01'))->format('Y-m-d');
        $end_date   = Carbon::parse($date ? explode(' - ', $date)[1] : date('Y-m-t'))->format('Y-m-d');
        if (isset($request->employee) && $request->employee != null) {
            $employee = User::find($request->employee);
        } else {
            $employee = User::find(auth()->user()->id);
        } 
 
        return $dataTable->render('meeting.meeting_list', compact('title', 'employee', 'status', 'start_date', 'end_date'));
    }
 
    public function create(Request $request)
    {
        $selected_data = [];
        if ($request->has('customer')) {
            $selected_data['customer'] = Customer::find($request->customer);
        } 
        $title = "Meeting Schedule Create";
        return view('meeting.meeting_create',compact('selected_data','title'));
    }  

    public function store(Request $request)
    { 
        $validator = Validator::make($request->all(), [ 
            'title' => 'required|string|max:255',
            'customer_id' => 'required', 
            'date' => 'required|date',
            'time' => 'required|date_format:H:i',
            'agenda' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('error', $validator->errors()->first());
        }

        if(isset($request->meeting_id) && $request->meeting_id!=null){
            $meeting = Meeting::find($request->meeting_id);
        }else{
            $meeting = new Meeting();
        } 
        
        $meeting->title = $request->title;
        $meeting->customer_id = $request->customer_id;
        $meeting->date_time = $request->date . ' ' . $request->time;
        $meeting->agenda = $request->agenda;
        $meeting->created_by = auth()->id();
        $meeting->save(); 

        if(isset($request->meeting_id) && $request->meeting_id!=null){ 
            return redirect()->route('meeting.index')->with('success', 'Meeting scheduled updated');
        }else{
            return redirect()->route('meeting.index')->with('success', 'Meeting scheduled successfully');
        } 
       
            
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try{
            $id= decrypt($id);
            $data = Meeting::with('attendance')->find($id); 
             
            $present = $data->attendance->where('is_present',true);
            $absent = $data->attendance->where('is_present',false); 

            $is_time_end = false;
            if($data->date_time < Carbon::now()){ 
                $is_time_end = true;
            }
            return view('meeting.meeting_details',compact('data', 'present','absent','is_time_end'));
        }catch(Exception $e){
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $title = "Meeting Schedule Edit";
        $id = decrypt($id);
        $meeting = Meeting::with('attendance')->find($id);
        $selected_data['customer'] = Customer::find($meeting->customer_id);
        return view('meeting.meeting_create',compact('meeting','title','selected_data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'employee' => 'required|array',
            'employee.*' => 'exists:users,id',
            'date' => 'required|date',
            'time' => 'required|date_format:H:i',
            'agenda' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('error', $validator->errors()->first());
        }

        $meeting = Meeting::find($id);
        $meeting->title = $request->title;
        $meeting->date_time = $request->date . ' ' . $request->time;
        $meeting->agenda = $request->agenda;
        $meeting->created_by = auth()->id();
        $meeting->save();

        MeetingAttendance::where('meeting_id',$meeting->id)->delete();

        if(isset($request->employee) && count($request->employee) > 0) {
           foreach($request->employee as $employee) {
               $attendance = new MeetingAttendance();
               $attendance->meeting_id = $meeting->id;
               $attendance->user_id = $employee;
               $attendance->save();
           }  
        }

        return redirect()->route('meeting.index')->with('success', 'Meeting updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try{ 
            $meeting = Meeting::find($id);
            $meeting->delete();
            return response()->json(['success' => 'Meeting deleted successfully']);
        }catch(Exception $e){
            return response()->json(['error' => $e->getMessage()]);
        }
    } 

    public function complete($id){  
        $meeting = Meeting::find($id); 
        $meeting->status = 1;
        $meeting->save();
        return response()->json(['success' => 'Meeting completed successfully']);
    }

    
}
