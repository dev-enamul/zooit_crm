<?php

namespace App\Http\Controllers;

use App\Enums\Priority;
use App\Models\ApproveSetting;
use App\Models\ColdCalling;
use App\Models\Customer;
use App\Models\Lead;
use App\Models\Profession;
use App\Models\Project;
use App\Models\Unit;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class LeadController extends Controller
{

    public function index(Request $request)
    {
        $professions = Profession::all();  
        $my_all_employee = my_all_employee(auth()->user()->id);
        $employee_data = Customer::whereIn('ref_id', $my_all_employee)->get(); 
        $employees = User::whereIn('id', $my_all_employee)->get();

        if(isset($request->employee) && !empty($request->employee)){
            $user_id = (int)$request->employee;
        }else{
            $user_id = Auth::user()->id;
        } 
      
        $user_employee = my_all_employee($user_id);
        $leads = Lead::where(function ($q){
            $q->where('approve_by','!=',null)
                ->orWhere('employee_id', Auth::user()->id)
                ->orWhere('created_by', Auth::user()->id);
        }) 
        ->whereHas('customer', function($q) use($user_employee){ 
            $q->whereIn('ref_id', $user_employee);
        }); 

         if(isset($request->profession) && !empty($request->profession)){
            $profession = (int)$request->profession;
            $leads = $leads->whereHas('customer', function($q) use($profession){ 
                $q->where('profession_id', $profession);
            });
         } 
        //  $leads = $leads->with('employee','customer.user')->where(function ($query) {
        //     $query->where('status', 1)
        //         ->orWhere(function ($subquery) {
        //             $subquery->where('status', 0)
        //                     ->where('created_by', Auth::user()->id);
        //         });
        // })->orderBy('id','desc')->get(); 
        
        if(isset($request->status) && !empty($request->status)){
            $status = (int)$request->status;
            $leads = $leads->where('status', $status);
        }else{
            $leads = $leads->where('status', 0);
        } 
        $leads = $leads->get();
       
         $filter =  $request->all();
        return view('lead.lead_list', compact('leads','employee_data','professions','employees','filter'));
    }
    public function priority()
    {
        return Priority::values();
    }

    public function create(Request $request)
    {
        $title = 'Lead Entry';
        $user_id   = Auth::user()->id; 
        $my_all_employee = my_all_employee($user_id);

        $is_admin = Auth::user()->hasPermission('admin'); 
        if($is_admin){
            $customers = Customer::whereDoesntHave('salse')->select('id','customer_id','name')->get();
        }else{
            $customers = ColdCalling::where('status',0)->where('approve_by','!=',null)->whereHas('customer',function($q) use($my_all_employee){
                $q->whereIn('ref_id',$my_all_employee);
            })->get();
            $customers = $customers->customer->select('id','customer_id','name');
        }  
        $employees          = User::whereIn('id', $my_all_employee)->get();
        $projects = Project::where('status',1)->select('id','name')->get();
        $units          = Unit::select('id','title')->get();
        $priorities = $this->priority();

        $selected_data = 
        [
            'employee' => Auth::user()->id,
            'priority' => Priority::Regular,
        ];
        if ($request->has('customer')) {
            $selected_data['customer'] = $request->customer;
        }
        return view('lead.lead_save', compact('customers','priorities','title','projects','units','selected_data','employees'));
    } 

    public function customer_data(Request $request){
        $cold_calling  = ColdCalling::where('customer_id',$request->customer_id)->first();
        return response()->json($cold_calling,200); 
    }

    public function save(Request $request, $id = null)
    {
        $validator = Validator::make($request->all(), [
            'customer'   => 'required',
            'priority'   => 'required', 
            'remark'     => 'nullable|string|max:255',
            'employee'   => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator)->with('error', $validator->errors()->first());
        }

        if (!empty($id)) {
            $lead = Lead::find($id);
            $lead->update([
                'customer_id'               => $request->customer,
                'purchase_capacity'         => $request->priority,
                'remark'                    => $request->remark,
                'employee_id'               => $request->employee,
                'project_id'                => $request->project,
                'unit_id'                   => $request->unit,
                'possible_purchase_date'    => date('Y-m-d', strtotime($request->purchase_date)),
                'updated_by'                => auth()->id(),
                'updated_at'                => now(),
                'created_by'                => auth()->id(),
            ]);
            return redirect()->route('lead.index')->with('success','Lead update successfully');

        } else {
            $lead = new Lead();
            $lead->customer_id              = $request->customer;
            $lead->employee_id              = $request->employee;
            $lead->project_id               = $request->project;    
            $lead->remark                   = $request->remark;
            $lead->unit_id                  = $request->unit;    
            $lead->updated_by               = auth()->id();
            $lead->purchase_capacity        = $request->priority;
            $lead->possible_purchase_date   = date('Y-m-d', strtotime($request->purchase_date));
            $approve_setting = ApproveSetting::where('name','lead')->first(); 
            $is_admin = Auth::user()->hasPermission('admin'); 
            if($approve_setting?->status == 0 || $is_admin){ 
                $lead->approve_by = auth()->user()->id;
            }  
            $lead->status                   = 0;
            $lead->created_at               = now();
            $lead->save();

            if($lead) {
                $cold_calling = ColdCalling::where('customer_id',$request->customer)->first();
                if(isset($cold_calling) && $cold_calling != null){
                    $cold_calling->status = 1;
                    $cold_calling->save();
                } 
            }
            return redirect()->route('lead.index')->with('success','Lead create successfully');
        }
    }

    public function edit($id)
    {
        $title = 'Lead Edit';
        $user_id   = Auth::user()->id; 
        $my_all_employee = my_all_employee($user_id);
        $customers = Customer::whereIn('ref_id', $my_all_employee)->get();
        $projects = Project::where('status',1)->select('id','name')->get();
        $units          = Unit::select('id','title')->get();
        $priorities = $this->priority();
        $lead = Lead::find($id);

        return view('lead.lead_save', compact('customers','priorities','title','projects','units','lead'));
    }

    public function leadDelete($id){
        try{ 
            $data  = Lead::find($id);
            $data->delete();
            return response()->json(['success' => 'Lead Deleted'],200);
        }catch(Exception $e){
            return response()->json(['error' => $e->getMessage()],500);
        }
    }

    public function leadApprove(){ 
        $user_id        = Auth::user()->id; 
        $my_employee    = my_employee($user_id);
        $leads          = Lead::where('approve_by', null)->whereIn('employee_id',$my_employee)->orderBy('id','desc')->get(); 
        return view('lead.lead_approve', compact('leads'));
    }

    public function leadApproveSave(Request $request) {
        if($request->has('lead_id') && $request->lead_id !== '' & $request->lead_id !== null) {
            DB::beginTransaction();
            try {
                foreach ($request->lead_id as $key => $lead_id) {
                    $lead = Lead::where('id',$lead_id)->first();
                    $lead->approve_by = Auth::user()->id;
                    $lead->save();
                }
                DB::commit();
                return redirect()->route('lead.approve')->with('success', 'Status Updated Successfully');
            } catch (Exception $e) {
                DB::rollback();
                return redirect()->back()->withInput()->with('error', $e->getMessage());
            }
            
        } else {
            return redirect()->route('lead.approve')->with('error', 'Something went wrong!');
        }

    }
}
