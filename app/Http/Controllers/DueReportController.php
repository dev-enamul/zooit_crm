<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DueReportController extends Controller
{
    public function due_report(){
        return view('report.due_report');
    }
}
