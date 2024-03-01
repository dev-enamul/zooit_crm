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
use Exception;
use Illuminate\Http\Request;
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
        return view('deposit.deposit_create',compact('deposit_categories','customers','banks'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'customer_id' => 'required',
            'deposit_category_id' => 'required',
            'amount' => 'required',
            'date' => 'required', 
            'bank_id' => 'required',
            'cheque_no' => 'nullable | string',
            'branch_name' => 'nullable | string',
        ]);
   
        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator)->with('error', $validator->errors()->first());
        } 

        try{
            $input = $request->all(); 
            $input['created_by'] = auth()->id(); 
            // $request->deposit_category_id ==0 == Regular Deposit 

            $input['date'] = date('Y-m-d',strtotime($request->date));
            $input['deposit_category_id'] = $request->deposit_category_id==0?null:$request->deposit_category_id;
            $deposit = Deposit::create($input);

            if($request->deposit_category_id==0){
                $salse = Salse::where('customer_id', $request->customer_id)->orderBy('id', 'desc')->select('id','project_id')->first();
                if(isset($salse) && !empty($salse)){ 
                    $deposit->salse_id = $salse->id;
                    $deposit->project_id = $salse->project_id;
                    $deposit->save();
                }   
                $customer = Customer::find($request->customer_id);  

                if(isset($customer) && $customer->ref_id != null){
                    $ref_employees = user_reporting($customer->ref_id);
                    if(isset($ref_employees) && !empty($ref_employees)){
                        foreach($ref_employees as $ref_employee){
                          $user = User::find($ref_employee); 
                          if($user->user_type== 1){
                            $designation = $user->employee->designation;
                          }else{ 
                            $designation = $user->freelancer->designation;
                          } 

                          $deposit_commission = DepositCommission::create([
                            'deposit_id' => $deposit->id,
                            'user_id' => $ref_employee,
                            'designation_id' => $designation->id,
                            'commission_id' => $designation->commission_id, 
                            'commission' => $designation->commission->commission/100 * $deposit->amount,
                            'status' => 1,
                            'created_by' => auth()->id()
                          ]);
                        }
                    }
                }
            
            } 
            return redirect()->route('deposit.index')->with('success','Deposit created successfully');
        }catch(Exception $e){
            dd($e->getMessage());
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
        if($deposit_categgory_id == 1){
            $salse = Salse::where('customer_id',$customer_id)->first();
            if(isset($salse) && !empty($salse)){
                $due = $salse->installment_value;
                $datas['installment_type'] = $salse->installment_type; 
                $datas['next_payment_date'] = $customer->nextPaymentDate();
                $datas['due_installment'] = $customer->dueInstallment(); 
            }
        }elseif($deposit_categgory_id == 2){ 
            $salse = Salse::where('customer_id',$customer_id)->first();
            if(isset($salse) && !empty($salse)){
                $due = $salse->down_payment_due;
            } 
        }elseif($deposit_categgory_id == 3){
            $salse = Salse::where('customer_id',$customer_id)->first();
            $due = $salse->booking_due; 
        }  
        return response()->json(['status'=>true,'due'=>$due]); 
    }
}
