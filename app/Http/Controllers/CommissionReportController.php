<?php

namespace App\Http\Controllers;

use App\Models\DepositCommission;
use App\Models\DepositTarget;
use App\Models\Project;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CommissionReportController extends Controller
{
    public function monthly_target_achive(Request $request){  
        $datas = DepositTarget::whereMonth('month', date('m'))
        ->whereYear('created_at', date('Y'))
        ->distinct('assign_to'); 

        if(isset($request->month) && $request->month != ''){ 
            $month = date('m',strtotime($request->month));
            $year = date('Y',strtotime($request->month)); 
            $datas = $datas->whereMonth('month',$month)->whereYear('month',$year);
        }
 
        $datas = $datas->get(); 
        $selected = $request->month; 
        if($selected == ''){
            $selected = date('Y-m');
        }
        return view('report.commission.monthly_target_achive', compact('datas','selected'));
    }

    public function mst_commission(Request $request){ 
        if($request->month){
            $selected = Carbon::parse($request->month)->format('Y-m'); 
        }else{
            $selected = Carbon::now()->format('Y-m');
        } 
        $start = Carbon::parse($selected)->startOfMonth();
        $end = Carbon::parse($selected)->endOfMonth();
        $projects = Project::where('status',1)->get();
        $employees = User::where('status',1)->get(); 
        $commission = DepositCommission::whereBetween('created_at',[$start,$end])->get(); 
       
        return view('report.commission.mst_commission',compact('projects','employees','selected','commission'));
    } 

    public function mst_commission_details($id){
        return view('report.commission.mst_commission_details');
    }

    public function rsa_co_ordinator(){
        return view('report.commission.rsa_co_ordinator');
    }

    public function cc_report(){
        return view('report.commission.cc_report');
    }
}
