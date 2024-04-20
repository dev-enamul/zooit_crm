<?php

namespace App\Http\Controllers;

use App\Models\CommissionDeductedSetting;
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
       
        $commission = DepositCommission::whereBetween('created_at',[$start,$end])->get(); 
       

        $employees = User::where('user_type', 1)
            ->join('deposit_commissions', 'users.id', '=', 'deposit_commissions.user_id')
            ->selectRaw('users.id as id, 
                    MAX(users.name) as name, 
                    MAX(users.user_id) as user_id, 
                    SUM(deposit_commissions.amount) as total_commission,
                    SUM(deposit_commissions.payble_commission) as payble_commission,
                    SUM(deposit_commissions.applicable_commission) as applicable_commission')
            ->whereBetween('deposit_commissions.created_at', [$start, $end])
            ->groupBy('users.id')
            ->get();
            $gtbi_deduction = CommissionDeductedSetting::where('status', 1)->get();

        return view('report.commission.mst_commission',compact('projects','employees','selected','commission','gtbi_deduction'));
    } 

    public function mst_commission_details($id,$month){
        $id = decrypt($id);  
        $start = Carbon::parse($month)->startOfMonth();
        $end = Carbon::parse($month)->endOfMonth();
        $commissions = DepositCommission::where('user_id',$id)
                            ->whereBetween('created_at', [$start, $end])->get();  
        $user = User::find($id);

        return view('report.commission.mst_commission_details',compact('commissions','month','user'));
    }

    public function rsa_co_ordinator(){
        return view('report.commission.rsa_co_ordinator');
    }

    public function cc_report(){
        return view('report.commission.cc_report');
    }
}
