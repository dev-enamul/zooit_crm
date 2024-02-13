<?php

namespace App\Http\Controllers;

use App\Models\DepositTarget;
use App\Models\User;
use Illuminate\Http\Request;

class CommissionReportController extends Controller
{
    public function monthly_target_achive(){  
        $datas = DepositTarget::whereMonth('month', date('m'))
        ->whereYear('created_at', date('Y'))
        ->distinct('assign_to')
        ->get(); 
        return view('report.commission.monthly_target_achive', compact('datas'));
    }

    public function mst_commission(){
        return view('report.commission.mst_commission');
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
