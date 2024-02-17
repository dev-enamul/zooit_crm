<?php

namespace App\Http\Controllers;

use App\Models\Deposit;
use App\Models\DepositCategory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DtaReportController extends Controller
{
    public function dt_achivement(){
        return view('report.dta.dt_achivement');
    } 
    public function daily_deposit(Request $request){ 
         
        if(isset($request->date) && $request->date != ''){
            $date = $request->date;
            $dateParts = explode(' - ', $date); 
            $startDate = Carbon::createFromFormat('m/d/Y', $dateParts[0]);
            $endDate = Carbon::createFromFormat('m/d/Y', $dateParts[1]); 
        }else{
            $startDate = Carbon::now()->startOfMonth();
            $endDate = Carbon::now()->endOfMonth();
        } 

        if($startDate==$endDate){
            $daily_deposits = Deposit::whereDate('date',$startDate)->get()->groupBy('date');
            $total_deposit = Deposit::whereDate('date',$startDate)
                ->select('deposit_category_id','amount')
                ->get();
        }else{
            $daily_deposits = Deposit::whereBetween('date',[$startDate,$endDate])->get()->groupBy('date');
            $total_deposit = Deposit::whereBetween('date',[$startDate,$endDate])
                ->select('deposit_category_id','amount')
                ->get();
        } 
      
        $deposit_categories =  DepositCategory::where('status', 1)->select('id','name')->get();

        return view('report.dta.daily_deposit',compact([
            'daily_deposits',
            'deposit_categories',
            'startDate',
            'endDate',
            'total_deposit'
        ]));
    }

    public function deposit_report(){
        return view('report.dta.deposit_report');
    } 
}
