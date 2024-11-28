<?php

namespace App\Http\Controllers;

use App\DataTables\ProspectingDataTable;
use App\DataTables\RejectionDataTable;
use App\Models\ColdCalling;
use App\Models\Customer;
use App\Models\FollowUp;
use App\Models\FollowUpAnalysis;
use App\Models\Lead;
use App\Models\LeadAnalysis;
use App\Models\Negotiation;
use App\Models\NegotiationAnalysis;
use App\Models\NegotiationWaitingDay;
use App\Models\Presentation;
use App\Models\Prospecting;
use App\Models\Rejection;
use App\Models\RejectReason;
use App\Models\User;
use App\Models\VisitAnalysis;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class RejectionController extends Controller
{
     
    public function index(RejectionDataTable $dataTable, Request $request)
    { 
        $title      = 'Rejection List';
        $date       = $request->date ?? null;
        $status     = $request->status ?? 0;
        $start_date = Carbon::parse($date ? explode(' - ', $date)[0] : date('Y-m-01'))->format('Y-m-d');
        $end_date   = Carbon::parse($date ? explode(' - ', $date)[1] : date('Y-m-t'))->format('Y-m-d');
        $employee   = $request->employee ?? null;
        $employee   = $employee ? User::find($employee) ?? User::find(auth()->user()->id) : User::find(auth()->user()->id);
        return $dataTable->render('rejection.rejection_list', compact('title', 'employee', 'status', 'start_date', 'end_date'));
    }

   
    public function create(Request $request)
    {
        $title = 'Rejection Entry'; 
        $my_all_employee    = json_decode(Auth::user()->user_employee);
        $customers          = Customer::get(); 
        $reject_reasons     = RejectReason::get();
        $selected_data = 
        [
            'employee' => Auth::user()->id,
        ];  
        if ($request->has('customer')) {
            $selected_data['customer'] = Customer::find($request->customer);
        } 
        
        return view('rejection.rejection_save',compact('customers','selected_data','reject_reasons'));
    }

    public function save(Request $request, $id = null)
    {
        $validator = Validator::make($request->all(), [
            'customer'          => 'required', 
            'remark'            => 'nullable',
        ]); 

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator)->with('error', $validator->errors()->first());
        }

        if (!empty($id)) {
            $rejection = Rejection::findOrFail($id);
            $rejection->customer_id = $request->customer;
            $rejection->employee_id = Auth::user()->id;
            $rejection->remark = $request->remark; 
            $rejection->remark = $request->remark;  
            $rejection->reject_reason_id = $request->rejection_reason;
            $rejection->customer_price_capability =  $request->customer_price_capability;
            $rejection->possible_purchase_date =  $request->possible_purchase_date;
            $rejection->competitor_information =  $request->competitor_information;
 
            $rejection->updated_by = $request->updated_by;
            $rejection->updated_at = $request->updated_at;
            $rejection->save();
            return redirect()->route('rejection.index')->with('success','Rejection update successfully');
        } else {
            $rejection = new Rejection();
            $rejection->customer_id = $request->customer;
            $rejection->employee_id = Auth::user()->id;
            $rejection->reject_reason_id = $request->rejection_reason;
            $rejection->customer_price_capability =  $request->customer_price_capability;
            $rejection->possible_purchase_date =  $request->possible_purchase_date;
            $rejection->competitor_information =  $request->competitor_information;

            $rejection->remark = $request->remark;
            $rejection->created_by = auth()->id();
            $rejection->created_at = now();
            $rejection->status = 1;
            $rejection->save();  
                
              
            // update table data 
            if($rejection){
                if(Customer::where('id',$request->customer)->where('status',0)->count() > 0){
                    $datas = Customer::where('id',$request->customer)->where('status',0)->get(); 
                    $this->rejectData($datas);
                }elseif(Prospecting::where('customer_id',$request->customer)->where('status',0)->count() > 0){
                    $datas = Prospecting::where('customer_id',$request->customer)->where('status',0)->get(); 
                    $this->rejectData($datas); 
                }elseif(ColdCalling::where('customer_id',$request->customer)->where('status',0)->count() > 0){
                    $datas = ColdCalling::where('customer_id',$request->customer)->where('status',0)->get(); 
                    $this->rejectData($datas);   
                }elseif(Lead::where('customer_id',$request->customer)->where('status',0)->count() > 0){ 
                    $datas = Lead::where('customer_id',$request->customer)->where('status',0)->get(); 
                    $this->rejectData($datas);    
                }elseif(Presentation::where('customer_id',$request->customer)->where('status',0)->count() > 0){
                    $datas = Presentation::where('customer_id',$request->customer)->where('status',0)->get(); 
                    $this->rejectData($datas);  
                }elseif(FollowUp::where('customer_id',$request->customer)->where('status',0)->count() > 0){ 
                    $datas = FollowUp::where('customer_id',$request->customer)->where('status',0)->get(); 
                    $this->rejectData($datas);  
                }elseif(Negotiation::where('customer_id',$request->customer)->where('status',0)->count() > 0){ 
                    $datas = Negotiation::where('customer_id',$request->customer)->where('status',0)->get(); 
                    $this->rejectData($datas); 
                } 
                $customer = Customer::find($request->customer); 
                $customer->last_stpe = 8; 
                $customer->save();
            }

            return redirect()->route('rejection.index')->with('success','Rejection create successfully');
        }
    } 

    public function rejectData($datas){
        foreach($datas as $data){
            $data->status = 1;
            if($data->approve_by == null){
                $data->approve_by =Auth::user()->id;
            } 
            $data->save();
        } 
    }

    public function edit(string $id, Request $request)
    {
        $title = 'Rejection Edit'; 
        $my_all_employee    = Auth::user()->user_employee; 
 
        $selected_data = 
        [
            'employee' => Auth::user()->id,
        ];

        if ($request->has('customer')) {
            $selected_data['customer'] = $request->customer;
        }

        $rejection = Rejection::find($id);

        return view('rejection.rejection_save',compact('selected_data','rejection'));
    }


    public function rejectionDelete($id){
        try{ 
            $data  = Rejection::find($id);
            $data->delete();
            return response()->json(['success' => 'Rejection Deleted'],200);
        }catch(Exception $e){
            return response()->json(['error' => $e->getMessage()],500);
        }
    }

    public function rejectionApprove(){ 
        $user_id        = Auth::user()->id; 
        $my_employee    = my_employee($user_id);
        $rejections     = Rejection::where('approve_by', null)->whereIn('employee_id',$my_employee)->orderBy('id','desc')->get(); 
        return view('rejection.rejection_approve', compact('rejections'));
    }

    public function rejectionApproveSave(Request $request) {
        if($request->has('rejection_id') && $request->rejection_id !== '' & $request->rejection_id !== null) {
            DB::beginTransaction();
            try {
                foreach ($request->rejection_id as $key => $rejection_id) {
                    $lead = Rejection::where('id',$rejection_id)->first();
                    $lead->approve_by = Auth::user()->id;
                    $lead->save();
                }
                DB::commit();
                return redirect()->route('rejection.approve')->with('success', 'Status Updated Successfully');
            } catch (Exception $e) {
                DB::rollback();
                return redirect()->back()->withInput()->with('error', $e->getMessage());
            }
            
        } else {
            return redirect()->route('rejection.approve')->with('error', 'Something went wrong!');
        }
    } 

    public function select2_customer(Request $request) {
        $request->validate([
            'term' => ['nullable', 'string'],
        ]);  
        
        $users = Customer::query()
        ->where(function ($query) use ($request) {
            $term = $request->term;
            $query->where('customer_id', 'like', "%{$term}%")
                ->orWhereHas('user', function ($subQuery) use ($term) {
                    $subQuery->where('name', 'like', "%{$term}%");
                });
        })
        ->with('user:id,name')  
        ->select('id', 'user_id', 'customer_id')  
        ->limit(10)
        ->get();
    
        $results = [];
        foreach ($users as $customer) {
            $results[] = [
                'id'   => $customer->id,
                'text' => "{$customer->user->name} [{$customer->customer_id}]",
            ];
        }

        return response()->json([
            'results' => $results,
        ]);
    }
}
