<?php

namespace App\Http\Controllers;

use App\Models\Deposit;
use App\Models\DepositCommission;
use App\Models\DepositTarget;
use App\Models\FreelancerApprovel;
use App\Models\ReportingUser;
use App\Models\User;
use App\Models\Withdraw;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function hierarchy(){   
      
        $user_id = auth()->user()->id; 
        $user = User::find($user_id);
  
        $topUser = ReportingUser::where('user_id', $user_id)->where('status', 1)
        ->select(['id', 'user_id'])
        ->first();
        $organogram = getOrganogram($topUser);   
         
        return view('profile.hierarchy',compact('user_id','organogram','user'));
    }

    public function profile($id){
        $user_id = decrypt($id); 
        $user = User::find($user_id); 

        $reporting_users = user_reporting($user_id);
        
        if(count($reporting_users) > 1){
            $reporting_user = user_info($reporting_users[1]);
            $top_reporting_user = user_info($reporting_users[count($reporting_users)-1]);
        }else{
            $top_reporting_user = $reporting_user = null;
        }
        

        return view('profile.profile',compact('user_id','user','reporting_user','top_reporting_user'));
    }

    public function freelancer_join_process($id){ 

        $user_id = decrypt($id);
        $user = User::find($user_id);
        $approve_process = FreelancerApprovel::where('freelancer_id',$user_id)->get();
  
        return view('profile.freelancer_join_process',compact('user_id','user','approve_process'));
    } 

    public function target_achive(Request $request){
        if(isset($request->month)){
            $month = $request->month;
        }else{
            $month = date('m');
        }
        $user_id = auth()->user()->id; 
        $user = User::find($user_id);
        return view('profile.target_achive',compact('user_id','user'));
    }     
}
