<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TargetReportController extends Controller
{
    public function target_sheet(){
        return view('report.target_report');
    }
}
