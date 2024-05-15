<?php

namespace App\Http\Controllers;

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
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
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
        $datas = Meeting::whereMonth('date_time',$month)
            ->whereYear('date_time',$year)
            ->whereIn('created_by',$all_reporting)
            ->get();

        return view('meeting.meeting_list',compact('datas','date'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('meeting.meeting_create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
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

        $meeting = new Meeting();
        $meeting->title = $request->title;
        $meeting->date_time = $request->date . ' ' . $request->time;
        $meeting->agenda = $request->agenda;
        $meeting->created_by = auth()->id();
        $meeting->save();

        if(isset($request->employee) && count($request->employee) > 0) {
           foreach($request->employee as $employee) {
               $attendance = new MeetingAttendance();
               $attendance->meeting_id = $meeting->id;
               $attendance->user_id = $employee;
               $attendance->save();
           }  
        }

        Notification::store([
            'title' => 'Meeting Schedule',
            'content' => Auth::user()->name.' You have been invited to a meeting',
            'user_id' => $request->employee,
            'link'  => route('meeting.show', encrypt($meeting->id)),
          ]);

          return redirect()->route('meeting.index')->with('success', 'Meeting scheduled successfully');
            
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
        $id = decrypt($id);
        $data = Meeting::with('attendance')->find($id);
        return view('meeting.meeting_edit',compact('data'));
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

    public function attend_status($id){
        try{
            $id = decrypt($id);
            $attendance = MeetingAttendance::find($id);
            $attendance->is_present = !$attendance->is_present;
            $attendance->save();
            return redirect()->back()->with('success', 'Attendance updated successfully');
        }catch(Exception $e){
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
