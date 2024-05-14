<?php

namespace App\Http\Controllers;

use App\Models\ColdCalling;
use App\Models\Customer;
use App\Models\FieldTarget;
use App\Models\Lead;
use App\Models\LeadAnalysis;
use App\Models\Notification;
use App\Models\Prospecting;
use App\Models\SubmitTime;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;

class FieldTargetController extends Controller
{
     public function assign_target(Request $request){ 
        if(isset($request->id)){
            $data = FieldTarget::find($request->id);
        }else{
            $data = null;
        } 

        $my_employee = my_employee(auth()->user()->id);
        $employeies = User::whereIn('id',$my_employee)->where('status',1)->get(); 
         return view('target.field_target.assign_target',compact('employeies','data'));
     } 

     public function field_target_save(Request $request){
        try{
            $validatedData = $request->validate([
                'assign_to' => 'required|exists:users,id',
                'month' => 'required|date_format:Y-m', 
                'freelancer' => 'nullable|numeric',
                'customer' => 'nullable|numeric',
                'prospecting' => 'nullable|numeric',
                'cold_calling' => 'nullable|numeric',
                'lead' => 'nullable|numeric',
                'lead_analysis' => 'nullable|numeric',
                'project_visit' => 'nullable|numeric',
                'project_visit_analysis' => 'nullable|numeric',
                'follow_up' => 'nullable|numeric',
                'follow_up_analysis' => 'nullable|numeric',
                'negotiation' => 'nullable|numeric',
                'negotiation_analysis' => 'nullable|numeric',
            ]); 
            
            $input = $request->all();
            $submit_time = SubmitTime::first();
            $input['submit_time'] = $submit_time->submit_time??'00:00:00';
            $input['assign_by'] = auth()->user()->id; 
            $input['month'] = date('Y-m-d',strtotime($input['month']));
            $old = FieldTarget::where('assign_to',$input['assign_to'])->where('month',$input['month'])->first();
            if($old){
                $old->update($input);
                
                // Notification Store
                Notification::store([
                    'title' => 'Field Target Updated',
                    'content' => auth()->user()->name . ' has updated your field target',
                    'link' => route('my.field.target'),
                    'created_by' => auth()->user()->id,
                    'user_id' => [$input['assign_to']]
                ]); 
                
                return redirect()->back()->with('success', 'Target updated successfully');
            }else{
                $target = new FieldTarget($input);  
                $target->save(); 
                Notification::store([
                    'title' => 'Field Target Assigned',
                    'content' => auth()->user()->name . ' has assigned you a field target',
                    'link' => route('my.field.target'),
                    'created_by' => auth()->user()->id,
                    'user_id' => [$input['assign_to']]
                ]); 
                return redirect()->back()->with('success', 'Target assigned successfully');
            } 
        }catch(Exception $e){ 
            return redirect()->back()->with('error', $e->getMessage());
        }
     }

     public function my_field_target(Request $request){
        if(isset($request->month) && $request->month != ''){ 
            $date = Carbon::parse($request->month);
            $start_date = $date->startOfMonth()->format('Y/m/d');
            $end_date   = $date->endOfMonth()->format('Y/m/d');
        }else{ 
            $date = Carbon::now(); 
            $start_date = $date->startOfMonth()->format('Y/m/d');
            $end_date   = $date->endOfMonth()->format('Y/m/d');
        } 

        $currentMonth = $date->format('Y-m');
        if(isset($request->start_date) && $request->start_date != ''){ 
            $dayOfMonth = $request->start_date; 
            $start_date = Carbon::parse($currentMonth . '-' . $dayOfMonth)->format('Y/m/d');
        }

        if(isset($request->end_date) && $request->end_date != ''){   
            $dayOfMonth = $request->end_date;  
            $end_date = Carbon::parse($currentMonth . '-' . $dayOfMonth)->format('Y/m/d');
        }

        $full_date = $start_date.' - '.$end_date;
        $diff = Carbon::parse($start_date)->diffInDays(Carbon::parse($end_date))+1;
        $total_days = Carbon::parse($date)->daysInMonth;
        $month = $date->format('Y-m');

        if(isset($request->employee) && $request->employee!=null){
            $user_id = decrypt($request->employee);
        }else{
            $user_id = auth()->user()->id;
        } 

        $user = User::find($user_id);
        $data = FieldTarget::where('assign_to',$user_id)
                ->whereMonth('month',$date)
                ->whereYear('month',$date)
                ->first();
        $my_all_employee = json_decode($user->user_employee);
        $achive['freelancer'] = $user->freelanecr_achive($full_date, $my_all_employee)??0;
        $achive['customer'] = $user->customer_achive($full_date, $my_all_employee)??0;
        $achive['prospecting'] = $user->prospecting_achive($full_date, $my_all_employee)??0;
        $achive['cold_calling'] = $user->cold_calling_achive($full_date, $my_all_employee)??0;
        $achive['lead'] = $user->lead_achive($full_date, $my_all_employee)??0;
        $achive['lead_analysis'] = $user->lead_analysis_achive($full_date, $my_all_employee)??0;
        $achive['presentation'] = $user->presentation_achive($full_date, $my_all_employee)??0;
        $achive['visit_analysis'] = $user->visit_analysis_achive($full_date, $my_all_employee)??0;
        $achive['followup'] = $user->followup_achive($full_date, $my_all_employee)??0;
        $achive['followup_analysis'] = $user->followup_analysis_achive($full_date, $my_all_employee)??0;
        $achive['negotiation'] = $user->negotiation_achive($full_date, $my_all_employee)??0;
        $achive['negotiation_analysis'] = $user->negotiation_analysis_achive($full_date, $my_all_employee)??0;
        $achive['rejection'] = $user->rejection($full_date, $my_all_employee)??0;
        $achive['return'] = $user->return($full_date, $my_all_employee);


        $per['freelancer'] = get_percent($achive['freelancer']??0,target_cal($data->freelancer??0,$total_days,$diff));
        $per['customer'] = get_percent($achive['customer']??0,target_cal($data->customer??0,$total_days,$diff) );
        $per['prospecting'] = get_percent($achive['prospecting']??0,target_cal($data->prospecting??0,$total_days,$diff));
        $per['cold_calling'] = get_percent($achive['cold_calling']??0,target_cal($data->cold_calling??0,$total_days,$diff));
        $per['lead'] = get_percent($achive['lead']??0,target_cal($data->lead??0,$total_days,$diff));
        $per['lead_analysis'] = get_percent($achive['lead_analysis']??0,target_cal($data->lead_analysis??0,$total_days,$diff));
        $per['presentation'] = get_percent($achive['presentation']??0,target_cal($data->project_visit??0,$total_days,$diff));
        $per['visit_analysis'] = get_percent($achive['visit_analysis']??0,target_cal($data->project_visit_analysis??0,$total_days,$diff));
        $per['followup'] = get_percent($achive['followup']??0,target_cal($data->follow_up??0,$total_days,$diff));
        $per['followup_analysis'] = get_percent($achive['followup_analysis']??0,target_cal($data->follow_up_analysis??0,$total_days,$diff));
        $per['negotiation'] = get_percent($achive['negotiation']??0,target_cal($data->negotiation??0,$total_days,$diff));
        $per['negotiation_analysis'] = get_percent($achive['negotiation_analysis']??0,target_cal($data->negotiation_analysis??0,$total_days,$diff));

    
        $selected = $request->month??Carbon::now()->format('Y-m');  
        return view('target.field_target.my_field_target',compact('data','selected','user','total_days','diff','achive','per','start_date','end_date','month'));
     }


    public function assign_target_list(Request $request){
        $datas = new FieldTarget();
        if(isset($request->month) && $request->month != ''){ 
            $month = date('m',strtotime($request->month));
            $year = date('Y',strtotime($request->month)); 
            $datas = $datas->whereMonth('month',$month)->whereYear('month',$year);
        }else{
            $datas = $datas->whereMonth('month',date('m'))->whereYear('month',date('Y'));
        }
        $datas =   $datas->with('assignTo')->where('assign_by',auth()->user()->id)->get();  
        
        
        $selected = $request->month??Carbon::now()->format('Y-m'); 
        return view('target.field_target.assign_target_list',compact('datas','selected'));
    }

    public function today_target(){
        return view('target.today_target');
    } 

    public function marketing_field_report(Request $request){
        $my_all_employee = json_decode(auth()->user()->user_employee); 
       
        $user = User::find(auth()->user()->id); 

        if(isset($request->month) && $request->month != ''){ 
            $date = Carbon::parse($request->month);
        }else{ 
            $date = Carbon::now();
        }

        $employees = User::where('user_type',1)->whereHas('employee',function($q){
            $q->where('designation_id',17);
        })
        ->whereIn('id',$my_all_employee)->where('status',1)
        ->get(); 

        $user = User::find(auth()->user()->id);
        $employee_id = $user->id;
        if($request->employee==null || $request->employee==''){
            if($user->employee->designation_id!=17 && isset($employees[0]->id)){
                $employee_id = $employees[0]->id;
            }
        }else{
            $employee_id = $request->employee;
            $employee_id = decrypt($employee_id);
        } 
        $employee = User::find($employee_id);
        $my_all_employee = json_decode($employee->user_employee);  
        $datas = User::where('user_type',2)->whereIn('id',$my_all_employee)->where('status',1)->get();
        return view('target.marketing_field_report',compact([
            'employees',
            'datas',
            'employee',
            'date', 
        ]));
    } 

    public function salse_field_report(Request $request){ 

        $my_all_employee = json_decode(auth()->user()->user_employee); 
         
        if(isset($request->month) && $request->month != ''){ 
            $date = Carbon::parse($request->month);
        }else{ 
            $date = Carbon::now();
        }  
       
        if(isset($request->employee) && $request->employee!=null){
            $employee_id = decrypt($request->employee);
        }else{
            $employee_id = auth()->user()->id;
        }
       
        $employee = User::find($employee_id);
 
        $employees = User::where('user_type',1)->whereHas('employee',function($q){
            $q->where('designation_id','!=',17);
        }) 
        ->whereIn('id',$my_all_employee)->where('status',1)
        ->get();
 
        $my_employee = my_employee($employee_id);  
        $datas = User::whereIn('id',$my_employee)->where('status',1)->get();
        return view('target.salse_field_report',compact([
            'employees',
            'datas',
            'employee',
            'date', 
        ]));
 
    }
}
