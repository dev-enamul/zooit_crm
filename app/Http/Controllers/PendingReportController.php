<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PendingReportController extends Controller
{
    public function pending_report(Request $request){ 
        if(isset($request->date) && $request->date != ''){
            $date = $request->date;
            $dateParts = explode(' - ', $date); 
            $startDate = Carbon::createFromFormat('m/d/Y', $dateParts[0]);
            $endDate = Carbon::createFromFormat('m/d/Y', $dateParts[1]); 
        }else{
            $startDate = Carbon::now()->startOfMonth();
            $endDate = Carbon::now()->endOfMonth();
        } 
        $employees =  User::where('user_type',1)->where('status',1)->get();
        return view('report.pending_report',compact('employees','startDate','endDate'));
    }
}
