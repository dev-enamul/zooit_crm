<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CommissionReportController extends Controller
{
    public function salse_comission_summary(){
        return view('commission_report.salse_commission_summary');
    }
}
