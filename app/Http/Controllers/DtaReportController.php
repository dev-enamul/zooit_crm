<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DtaReportController extends Controller
{
    public function dt_achivement(){
        return view('report.dta.dt_achivement');
    } 
    public function daily_deposit(){
        return view('report.dta.daily_deposit');
    }

    public function deposit_report(){
        return view('report.dta.deposit_report');
    } 
}
