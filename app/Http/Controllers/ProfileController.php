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
        $deposit_achive['this_month'] = $this->target_achive($user_id, 0);
        $deposit_achive['last_month'] = $this->target_achive($user_id, 1);
        $deposit_achive['last_2_month'] = $this->target_achive($user_id, 2);
        $deposit_achive['last_6_month'] = $this->target_achive($user_id, 6);
        $deposit_achive['last_12_month'] = $this->target_achive($user_id, 12);
        $deposit_achive['last_24_month'] = $this->target_achive($user_id, 24); 

        $topUser = ReportingUser::where('user_id', $user_id)
        ->select(['id', 'user_id'])
        ->first();
        $organogram = getOrganogram($topUser);   
        
        $reporting_users = array_reverse(user_reporting(8));
        return view('profile.hierarchy',compact('user_id','deposit_achive','organogram','reporting_users','user'));
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


     public function target_achive($user_id,$month){
        $deposit_target = DepositTarget::getDepositTarget($user_id, $month);
        $total_deposit = Deposit::getDeposit($user_id, $month); 
        if($deposit_target > 0){
            $achive = ($total_deposit / $deposit_target) * 100;
        }else{
            $achive = 0;
        } 
        return round($achive);
     }
}
