<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DueReportController extends Controller
{
    public function due_report(){ 
        $my_all_employee = json_decode(Auth::user()->user_employee);
        $customers = Customer::whereHas('salse', function($query){
            $query->where('is_return',0)
            ->where('status',1)
            ->where('is_all_paid',0);
        })  
        ->whereIn('ref_id',$my_all_employee)->get(); 
        return view('report.due_report',compact('customers'));
    }
}
