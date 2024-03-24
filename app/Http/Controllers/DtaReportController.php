<?php

namespace App\Http\Controllers;

use App\Models\BankDay;
use App\Models\Deposit;
use App\Models\DepositCategory;
use App\Models\DepositTarget;
use App\Models\Designation;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DtaReportController extends Controller
{
    public function dt_achivement(Request $request){ 
        $employees= User::where('approve_by','!=',null)->where('status',1);
        if(isset($request->date) && $request->date != ''){
            $date = Carbon::parse($request->date);
            $startDate = $date->firstOfMonth()->toDateString(); 
            $endDate = $date->endOfMonth()->toDateString();
        }else{
            $startDate = Carbon::now()->startOfMonth();
            $endDate = Carbon::now()->endOfMonth();
        } 
 
        if(isset($request->designation) && $request->designation!='' && count($request->designation) > 0){ 
            $selected_designation = Designation::whereIn('id', $request->designation)->get(); 
            $is_all_designation = false; 
        }else{
            $selected_designation = Designation::where('status', 1)->get();
            $is_all_designation = true; 
        }  
        $designations = Designation::where('status', 1)->select('id','title')->get();
        $deposit_categories =  DepositCategory::where('status', 1)->select('id','name')->get();

      

        // Perform the query
        $deposit_target = DepositTarget::where(function ($query) use ($startDate, $endDate) {
                $query->whereBetween('month',[$startDate,$endDate]);
            })
            ->get();  

            $bank_day = BankDay::where('month', 'LIKE', date('Y-m', strtotime($startDate)) . '%')->first();
            if(isset($bank_day) && $bank_day != null){
                $bank_day = json_decode($bank_day->bank_day);
            }else{
                $bank_day =  [];
            } 
            
            $remaining_day = 0;
            $today = Carbon::now()->format('d');
            foreach ($bank_day as $value) {  
                if ($value > $today) {
                    $remaining_day++;
                }
            } 
       
        return view('report.dta.dt_achivement',compact([
            'startDate',
            'endDate',
            'selected_designation',
            'designations',
            'deposit_categories',
            'is_all_designation',
            'deposit_target',
            'bank_day',
            'remaining_day'
        ]));
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

    public function monthly_dt_achivement(Request $request){
        $employees= User::where('approve_by','!=',null)->where('status',1);
 

        if(isset($request->month) && $request->month != ''){
            $date = $request->month.'-'. 1;
            $date = Carbon::parse($date);
        }else{
            $date = Carbon::now(); 
        }  
 

        $week = $request->week;

        if($week==1){
            $clone_date     = clone $date;
            $startDate      = $clone_date;  
            $clone_date     = clone $date;
            $endDate        = $clone_date->addDay(6); 
        }elseif($week==2){
            $clone_date     = clone $date; 
            $startDate      = $clone_date->addDay(7); 
            $clone_date     = clone $date; 
            $endDate        = $clone_date->addDay(14); 
        }elseif($week==3){
            $clone_date     = clone $date; 
            $startDate      = $clone_date->addDay(15); 
            $clone_date     = clone $date; 
            $endDate        = $clone_date->addDay(20); 
        }elseif($week==4){
            $clone_date     = clone $date; 
            $startDate      = $clone_date->addDay(21); 
            $clone_date     = clone $date; 
            $endDate        = $clone_date->endOfMonth();
        }else{
            $clone_date     = clone $date; 
            $startDate      = $clone_date; 
            $clone_date     = clone $date; 
            $endDate        = $clone_date->endOfMonth();
            $week="0";
        }   
     
        if(isset($request->designation) && $request->designation[0]!=null && count($request->designation) > 0){ 
            $selected_designation = Designation::whereIn('id', $request->designation)->where('id','!=',1)->orderBy('id','DESC')->get(); 
            $is_all_designation = false; 
          
        }else{
            $selected_designation = Designation::where('status', 1)->where('id','!=',1)->orderBy('id','DESC')->get();
            $is_all_designation = true;  
        }  
        $designations = Designation::where('status', 1)->select('id','title')->get();
        $deposit_categories =  DepositCategory::where('status', 1)->select('id','name')->get();
  
        $deposit_target = DepositTarget::whereMonth('month',date('m',strtotime($date)))
            ->whereYear('month',date('Y',strtotime($date)))
            ->get(); 
 
        return view('report.dta.monthly_dt_achivement',compact([ 
            'date',
            'selected_designation',
            'designations',
            'deposit_categories',
            'is_all_designation',
            'deposit_target',
            'week',
            'startDate',
            'endDate'
        ]));
    }
}
