<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CommissionReportController extends Controller
{
    public function monthly_target_achive(){
        return view('report.commission.monthly_target_achive');
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
}
