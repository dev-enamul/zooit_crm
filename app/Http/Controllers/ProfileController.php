<?php

namespace App\Http\Controllers;

use App\Enums\MaritualStatus;
use App\Models\Deposit;
use App\Models\DepositCommission;
use App\Models\DepositTarget;
use App\Models\FieldTarget;
use App\Models\FreelancerApprovel;
use App\Models\ReportingUser;
use App\Models\User;
use App\Models\UserCommission;
use App\Models\Withdraw;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function hierarchy($id){  
        $user_id = decrypt($id); 
        $user = User::find($user_id);
  
        $topUser = ReportingUser::where('user_id', $user_id)->where('status', 1)
        ->select(['id', 'user_id'])
        ->first();
        $organogram = getOrganogram($topUser);   
         
        return view('profile.hierarchy',compact('user_id','organogram','user'));
    }


    //tree
    public function hierarchy_tree(Request $request, $id){
        if(isset($request->employee) && !empty($request->employee)){ 
            $employee_id = decrypt($request->employee);  
        }else{ 
            $employee_id = decrypt($id); 
        }
        $user_id = decrypt($id);
        $user =  User::find($user_id);
        $employee = User::find($employee_id);
        $my_emplyees = my_employee($employee_id);
         

        return view('profile.hierarchy_tree',compact('user_id','user','my_emplyees','employee')); 
    }

    public function profile($id){  
        $user_id = decrypt($id); 
        $user = User::find($user_id);  
        $reporting_users = json_decode($user->reporting_user);
        $data = ReportingUser::where('user_id', $user_id)->where('status',1)->latest()->first();
        $boss = ReportingUser::find($data->reporting_user_id); 
        if(count($reporting_users) > 1){
            $reporting_user = user_info($reporting_users[1]);
            $top_reporting_user = user_info($reporting_users[count($reporting_users)-1]);
        }else{
            $top_reporting_user = $reporting_user = null;
        }
        $user['marital_status'] = MaritualStatus::values()[$user->marital_status??1]; 
        return view('profile.profile',compact('user_id','user','reporting_user','top_reporting_user'));
    }

    public function freelancer_join_process($id){  
        $user_id = decrypt($id);
        $user = User::find($user_id);
        $approve_process = FreelancerApprovel::where('freelancer_id',$user_id)->get();
  
        return view('profile.freelancer_join_process',compact('user_id','user','approve_process'));
    } 

    public function target_achive(Request $request, $id){ 
        $user_id = decrypt($id);
        if(isset($request->month) && $request->month != ''){ 
            $date = Carbon::parse($request->month);
        }else{ 
            $date = Carbon::now();
        }  
 
        $user = User::find($user_id); ;
        $target = FieldTarget::where('assign_to',$user_id)
                    ->whereMonth('month',$date)
                    ->whereYear('month',$date)
                    ->first();

        $deposit_target = DepositTarget::where('assign_to', $user_id)
            ->whereMonth('month', $date)
            ->whereYear('month', $date)
            ->with(['depositTargetProjects' => function ($query) {
                $query->select('deposit_target_id')
                        ->selectRaw('SUM(new_unit + existing_unit) as total_unit')
                        ->groupBy('deposit_target_id');
            }])
            ->selectRaw('SUM(new_total_deposit + existing_total_deposit) as total_deposit')
            ->whereHas('depositTargetProjects')
            ->first();
        
        
        

        $my_all_employee = json_decode($user->user_employee);
        $achive['freelancer'] = $user->freelanecr_achive($date, $my_all_employee)??0;
        $achive['customer'] = $user->customer_achive($date, $my_all_employee)??0;
        $achive['prospecting'] = $user->prospecting_achive($date, $my_all_employee)??0;
        $achive['cold_calling'] = $user->cold_calling_achive($date, $my_all_employee)??0;
        $achive['lead'] = $user->lead_achive($date, $my_all_employee)??0;
        $achive['lead_analysis'] = $user->lead_analysis_achive($date, $my_all_employee)??0;
        $achive['presentation'] = $user->presentation_achive($date, $my_all_employee)??0;
        $achive['visit_analysis'] = $user->visit_analysis_achive($date, $my_all_employee)??0;
        $achive['followup'] = $user->followup_achive($date, $my_all_employee)??0;
        $achive['followup_analysis'] = $user->followup_analysis_achive($date, $my_all_employee)??0;
        $achive['negotiation'] = $user->negotiation_achive($date, $my_all_employee)??0;
        $achive['negotiation_analysis'] = $user->negotiation_analysis_achive($date, $my_all_employee)??0;
        $achive['rejection'] = $user->rejection($date, $my_all_employee)??0;
        $achive['sales'] = $user->sales_achive($date, $my_all_employee)??0;
        $achive['deposit'] = $user->deposit_achive($date, $my_all_employee)??0; 

        $achive['rejection'] = $user->rejection($date, $my_all_employee);
        $achive['return'] = $user->return($date, $my_all_employee);
        // $transfer = $user->transfer($date, $my_all_employee);


        $per['freelancer'] = get_percent($achive['freelancer']??0,$target->freelancer??0);
        $per['customer'] = get_percent($achive['customer']??0,$target->customer??0);
        $per['prospecting'] = get_percent($achive['prospecting']??0,$target->prospecting??0);
        $per['cold_calling'] = get_percent($achive['cold_calling']??0,$target->cold_calling??0);
        $per['lead'] = get_percent($achive['lead']??0,$target->lead??0);
        $per['lead_analysis'] = get_percent($achive['lead_analysis']??0,$target->lead_analysis??0);
        $per['presentation'] = get_percent($achive['presentation']??0,$target->project_visit??0);
        $per['visit_analysis'] = get_percent($achive['visit_analysis']??0,$target->project_visit_analysis??0);
        $per['followup'] = get_percent($achive['followup']??0,$target->follow_up??0);
        $per['followup_analysis'] = get_percent($achive['followup_analysis']??0,$target->follow_up_analysis??0);
        $per['negotiation'] = get_percent($achive['negotiation']??0,$target->negotiation??0);
        $per['negotiation_analysis'] = get_percent($achive['negotiation_analysis']??0,$target->negotiation_analysis??0);
        $per['sales'] = get_percent($achive['sales']??0,$deposit_target->total_unit??0);
        $per['deposit'] = get_percent($achive['deposit']??0,$deposit_target->total_deposit??0);
        $date_range = $date->startOfMonth()->format('Y/m/d').' - '.$date->endOfMonth()->format('Y/m/d');
        

        $total_achive = array_sum($per); 
        $total_per = $total_achive/1200;
     
       


        return view('profile.target_achive',compact('user_id','user','date','target','achive','per','date_range','total_per','deposit_target'));
    }    

    public function wallet(Request $request, $id){
        $user_id = decrypt($id); 
        $user = User::find($user_id); 
        if(isset($request->month) && $request->month != ''){ 
            $date = Carbon::parse($request->month);
        }else{ 
            $date = Carbon::now();
        }  

        $commissions = DepositCommission::where('user_id',$user_id)
                        ->whereMonth('created_at',$date)
                        ->whereYear('created_at',$date)
                        ->get(); 
        $total_commission = DepositCommission::where('user_id',$user_id)->sum('payble_commission');
        $return_commission = 0; 

        $user_commission = UserCommission::where('user_id',$user_id)->first()??null;

        return view('profile.wallet',compact('commissions','total_commission','return_commission','user','date','user_commission'));
    }
}
