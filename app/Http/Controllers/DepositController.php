<?php

namespace App\Http\Controllers;

use App\DataTables\DepositDataTable;
use App\Models\Bank;
use App\Models\Commission;
use App\Models\Customer;
use App\Models\Deposit;
use App\Models\DepositCategory;
use App\Models\DepositCommission;
use App\Models\Designation;
use App\Models\Invoice;
use App\Models\Salse;
use App\Models\Service;
use App\Models\Transaction;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class DepositController extends Controller
{ 
    public function index(DepositDataTable $dataTable, Request $request)
    {       
        $title      = 'Prospecting List';
        $date       = $request->date ?? null;
        $status     = $request->status ?? 0;
        $start_date = Carbon::parse($date ? explode(' - ', $date)[0] : date('Y-m-01'))->format('Y-m-d');
        $end_date   = Carbon::parse($date ? explode(' - ', $date)[1] : date('Y-m-t'))->format('Y-m-d');
        if (isset($request->employee) && $request->employee != null) {
            $employee = User::find($request->employee);
        } else {
            $employee = User::find(auth()->user()->id);
        }  
        $services = Service::get();
        $selected_service = $request->service ?? 0; 
 
        return $dataTable->render('deposit.deposit_list', compact('title', 'employee', 'status', 'start_date', 'end_date','services','selected_service'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {  
        if(isset($request->invoice_id)){
            $invoice_id = decrypt($request->invoice_id); 
            $selected_invoice = Invoice::find($invoice_id); 
        }else{
            $selected_invoice = null;
        }
        $invoices = Invoice::where('status','!=',1)->get(); 
        $banks = Bank::where('status',1)->get(); 
        return view('deposit.deposit_create',compact('selected_invoice','banks','invoices'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {  
        $validator = Validator::make($request->all(), [
            'invoice_id' => 'required|exists:invoices,id', 
            'amount' => 'required|numeric|min:.1', 
            'date' => 'required|date|before_or_equal:today', 
            'bank_id' => 'required|exists:banks,id', 
            'tnx_id' => 'nullable|string|max:255', 
            'remark' => 'nullable|string|max:1000',
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator)->with('error', $validator->errors()->first());
        } 

        DB::beginTransaction();
        try{
            $input = $request->all(); 
            $invoice = Invoice::find($request->invoice_id);
            $input['user_id'] = $invoice->user_id;
            $input['customer_id'] = $invoice->customer_id;
            $input['project_id'] = $invoice->project_id;
            $input['created_by'] = auth()->id(); 
            $input['date'] = date('Y-m-d',strtotime($request->date));   
            $deposit = Deposit::create($input); 
            if($deposit){
                $due_amount = $invoice->due_amount-$request->amount;
                $invoice->due_amount = $due_amount;
                if($due_amount <= 0){ 
                    $invoice->status = 1;
                }else{
                    $invoice->status = 2;
                }   

                $invoice->project->paid =  $invoice->project->paid+$request->amount;
                $invoice->save();
                $invoice->project->save();

                $transaction = new Transaction();
                $transaction->user_id = $invoice->user_id;
                $transaction->bank_id = $request->bank_id;
                $transaction->invoice_id = $invoice->id;
                $transaction->invoice_id = $invoice->id;
                $transaction->type = 1;
                $transaction->amount = $request->amount;
                $transaction->due_after_transaction = $due_amount;
                $transaction->save();
            }   

            DB::commit();
            return redirect()->route('deposit.index')->with('success','Deposit created successfully');
        }catch(Exception $e){
            DB::rollBack(); 
            return redirect()->back()->withInput()->with('error', $e->getMessage());
        } 
    }

    

    public function getCustomerFormDepositType(Request $request){
        try{
            $deposit_categgory_id = $request->deposit_category; 
   
        if($deposit_categgory_id == 1){
                $customers = Customer::whereHas('salse',function($query){
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

    public function get_invoice_due(Request $request){
        $invoice_id = $request->invoice_id; 
        $invoice = Invoice::find($invoice_id);
        return response()->json([
            'status'=>true,
            'due'=>$invoice->due_amount
        ]);   
    } 

   
}
