<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PendingReportController extends Controller
{
    public function pending_report()
    {
        return view('report.pending_report');
    }
}
