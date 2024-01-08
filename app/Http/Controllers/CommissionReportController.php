<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CommissionReportController extends Controller
{
    public function salse_comission_summary(){
        return view('report.commission.salse_commission_summary');
    }

    public function monthly_target_achive(){
        return view('report.commission.monthly_target_achive');
    }

    public function area_wise_commission(){
        return view('report.commission.area_wise_commission');
    }
}
