<?php

namespace App\Http\Controllers;

use App\Models\FieldTarget;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;

class FieldTargetController extends Controller
{
     public function assign_target(){
        $my_employee = my_employee(auth()->user()->id);
        $employeies = User::whereIn('id',$my_employee)->where('status',1)->get(); 
         return view('target.field_target.assign_target',compact('employeies'));
     } 

     public function field_target_save(Request $request){
        try{
            $validatedData = $request->validate([
                'assign_to' => 'required|exists:users,id',
                'month' => 'required|date_format:Y-m',
                'submit_time' => 'required|date_format:H:i',
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
            $input['assign_by'] = auth()->user()->id; 
            $input['month'] = date('Y-m-d',strtotime($input['month']));
            $old = FieldTarget::where('assign_to',$input['assign_to'])->where('month',$input['month'])->first();
            if($old){
                $old->update($input);
                return redirect()->back()->with('success', 'Target updated successfully');
            }else{
                $target = new FieldTarget($input); 
                $target->save(); 
                return redirect()->back()->with('success', 'Target assigned successfully'); 
            } 
        }catch(Exception $e){
            dd($e->getMessage());
            return redirect()->back()->with('error', $e->getMessage());
        }
     }

     public function my_field_target(Request $request){
        $data = new FieldTarget();
        if(isset($request->month) && $request->month != ''){ 
            $month = date('m',strtotime($request->month));
            $year = date('Y',strtotime($request->month)); 
            $data = $data->whereMonth('month',$month)->whereYear('month',$year);
        }else{
            $data = $data->whereMonth('month',date('m'))->whereYear('month',date('Y'));
        }
        $data =   $data->where('assign_to',auth()->user()->id)->first();  
        $selected = $request->month; 
        return view('target.field_target.my_field_target',compact('data','selected'));
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

        $datas =   $datas->where('assign_by',auth()->user()->id)->get();  
        $selected = $request->month; 
        return view('target.field_target.assign_target_list',compact('datas','selected'));
    }

    public function today_target(){
        return view('target.today_target');
    } 

    public function marketing_field_report(){
        return view('target.marketing_field_report');
    } 

    public function salse_field_report(){
        return view('target.salse_field_report');
    }
}
