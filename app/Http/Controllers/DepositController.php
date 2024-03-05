<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use App\Models\Commission;
use App\Models\Customer;
use App\Models\Deposit;
use App\Models\DepositCategory;
use App\Models\DepositCommission;
use App\Models\Designation;
use App\Models\Salse;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class DepositController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {     
        $designations = Designation::where('status',1)->get();
        $datas = Deposit::where('approve_by','!=',null);
        if(isset($request->date) && !empty($request->date)){ 
            $datas = $datas->whereDate('date',date('Y-m-d',strtotime($request->date)));
        }else{
            $start_date = date('Y-m-01'); 
            $end_date = date('Y-m-t'); 
            $datas = $datas->whereBetween('date',[$start_date,$end_date]);
        }
        $datas = $datas->get();
        return view('deposit.deposit_list',compact('datas','designations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    { 
        $customers = Customer::where('status',1)->get();
        $deposit_categories =  DepositCategory::where('status',1)->get();
        $banks = Bank::where('status',1)->get();
        $employees = User::where('status',1)->select('id','user_id','name')->where('user_type',1)->get();
        return view('deposit.deposit_create',compact('deposit_categories','customers','banks','employees'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {  
         
        $validator = Validator::make($request->all(), [
            'customer_id' => 'required',
            'employee_id' => 'required',
            'deposit_category_id' => 'required',
            'amount' => 'required|min:1|numeric',
            'date' => 'required', 
            'bank_id' => 'required',
            'cheque_no' => 'nullable | string',
            'branch_name' => 'nullable | string',
        ]);
   
        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator)->with('error', $validator->errors()->first());
        } 

        DB::beginTransaction();
        try{
            $input = $request->all(); 
            $input['created_by'] = auth()->id();

            $input['date'] = date('Y-m-d',strtotime($request->date)); 
            $input['customer_user_id'] = Customer::find($request->customer_id)->user_id;
            $deposit = Deposit::create($input); 
          
            if($deposit->deposit_category_id==2){
                $salse = Salse::where('customer_id',$request->customer_id)->first();
                if(isset($salse) && !empty($salse) && $salse->down_payment_due > 0 && isset($request->rest_down_payment_date)){
                    $salse->rest_down_payment_date = date('Y-m-d', strtotime($request->rest_down_payment_date));
                }
            }

            if($deposit->deposit_category_id==1 || $deposit->deposit_category_id==2 || $deposit->deposit_category_id==3){
                $salse = Salse::where('customer_id',$deposit->customer_id)->first();
                if(isset($salse) && !empty($salse)){ 
                    $deposit->salse_id = $salse->id;
                    $deposit->project_id = $salse->project_id; 
                } 
            }

            $salse->save();
            $deposit->save();

            if(Auth::user()->hasPermission('approve-deposit')){
                $this->approve_deposit($deposit->id); 
            }
            DB::commit();
            return redirect()->route('deposit.index')->with('success','Deposit created successfully');
        }catch(Exception $e){
            DB::rollBack(); 
            return redirect()->back()->withInput()->with('error', $e->getMessage());
        } 
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function getCustomerFormDepositType(Request $request){
        try{
            $deposit_categgory_id = $request->deposit_category; 
   
        if($deposit_categgory_id == 1){
                $customers = Customer::where('approve_by','!=',null)->whereHas('salse',function($query){
                    $query->where('status',1)
                    ->where('is_all_paid',0);
                })
                ->select('id', 'name', 'customer_id')
                ->get();
        }elseif($deposit_categgory_id == 2){
                $customers = Customer::where('approve_by','!=',null)
                ->whereHas('salse', function ($query) {
                    $query->where('down_payment_due', '>', 0);
                })
                ->select('id', 'name', 'customer_id')
                ->get();
            }elseif($deposit_categgory_id == 3){
                $customers = Customer::where('approve_by','!=',null)
                ->whereHas('salse', function ($query) {
                    $query->where('booking_due', '>', 0);
                })
                ->select('id', 'name', 'customer_id')
                ->get();
            }else{
                $customers = Customer::select('id', 'name', 'customer_id')->get();
            } 
            return response()->json(['status'=>true,'customers'=>$customers]);
        }catch(Exception $e){ 
            return response()->json(['status'=>false,'message'=>$e->getMessage()]);
        }
        
    }

    public function get_customer_due(Request $request){
        $customer_id = $request->customer_id;
        $customer = Customer::find($customer_id); 
        $deposit_categgory_id = $request->deposit_category_id;
        $due = 0;
        $datas = [];
        
        if($deposit_categgory_id == 1){
            $salse = Salse::where('customer_id',$customer_id)->first();
            if(isset($salse) && !empty($salse)){
                $due = $salse->installment_value; 
                $payment_date = $customer->next_payment_date(); 
            }
        }elseif($deposit_categgory_id == 2){ 
            $salse = Salse::where('customer_id',$customer_id)->first();
            if(isset($salse) && !empty($salse)){
                $due = $salse->down_payment_due;
                $payment_date = Carbon::now()->toDateString();
            } 
        }elseif($deposit_categgory_id == 3){
            $salse = Salse::where('customer_id',$customer_id)->first();
            $due = $salse->booking_due; 
            $payment_date = Carbon::now()->toDateString(); 
        }  
        // dd($due);
        return response()->json([
            'status'=>true,
            'due'=>$due,
            'payment_date'=>$payment_date]); 
    } 

    public function approve_deposit($id){
        $deposit = Deposit::find($id);
        $deposit->approve_by = auth()->id();
        $deposit->save();
        if($deposit->deposit_category_id==1 || $deposit->deposit_category_id==2 || $deposit->deposit_category_id==3){
            $salse = Salse::where('customer_id',$deposit->customer_id)->first();
            if(isset($salse) && !empty($salse)){
                $salse->total_deposit = Deposit::where('salse_id',$salse->id)->sum('amount');
                if($deposit->deposit_category_id==2){
                    $down_payment_pay = $deposit->amount;
                    $down_payment_due =  $salse->down_payment_due - $down_payment_pay;
                    if($down_payment_due <= 0){
                        $down_payment_due = 0;
                    }else{
                        $down_payment_due = $down_payment_due;
                    } 
                    $salse->down_payment_due = $down_payment_due;
                }  
    
                if($deposit->deposit_category_id==3){
                    $booking_pay = $deposit->amount;
                    $booking_due =  $salse->booking_due - $booking_pay;
                    if($booking_due <= 0){
                        $booking_due = 0;
                    }else{
                        $booking_due = $down_payment_due;
                    } 
                    $salse->booking_due = $booking_due;
                }  
                $salse->save();
                $this->deposit_commission($deposit->id);
            } 
        } 
    }

    public function deposit_commission($id){
        $deposit = Deposit::find($id);
        $customer = Customer::find($deposit->customer_id);
        $salse = Salse::where('customer_id',$deposit->customer_id)->first();
        $all_employees = user_reporting($customer->ref_id);
        

     
    }
}
