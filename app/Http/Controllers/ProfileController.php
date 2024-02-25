<?php

namespace App\Http\Controllers;

use App\Models\Deposit;
use App\Models\DepositCommission;
use App\Models\DepositTarget;
use App\Models\User;
use App\Models\Withdraw;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index(){  
        $user_id = auth()->user()->id; 
        $deposit_achive['this_month'] = $this->target_achive($user_id, 0);
        $deposit_achive['last_month'] = $this->target_achive($user_id, 1);
        $deposit_achive['last_2_month'] = $this->target_achive($user_id, 2);
        $deposit_achive['last_6_month'] = $this->target_achive($user_id, 6);
        $deposit_achive['last_12_month'] = $this->target_achive($user_id, 12);
        $deposit_achive['last_24_month'] = $this->target_achive($user_id, 24); 
         
        return view('profile.profile',compact('user_id','deposit_achive'));
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
