<?php

namespace App\Http\Controllers;

use App\Enums\Priority;
use App\Models\ApproveSetting;
use App\Models\Customer;
use App\Models\FollowUp;
use App\Models\FollowUpAnalysis;
use App\Models\Negotiation;
use App\Models\Project;
use App\Models\ProjectUnit;
use App\Models\Unit;
use App\Models\User;
use App\Models\VisitAnalysis;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class NegotiationController extends Controller
{

    public function priority()
    {
        return Priority::values();
    }

    public function index(Request $request)
    {
        $my_all_employee = my_all_employee(auth()->user()->id);
        $employee_data = Customer::whereIn('ref_id', $my_all_employee)->get(); 
        $employees = User::whereIn('id', $my_all_employee)->get();

        if(isset($request->employee) && !empty($request->employee)){
            $user_id = (int)$request->employee;
        }else{
            $user_id = Auth::user()->id;
        } 
      
        $user_employee = my_all_employee($user_id);
        $negotiations = Negotiation::whereHas('customer', function($q) use($user_employee){ 
            $q->whereIn('ref_id', $user_employee);
        }); 

         $negotiations = $negotiations->orderBY('id','desc')->get();  
         $filter =  $request->all();
        return view('negotiation.negotiation_list',compact('negotiations','employee_data','employees','filter'));
    }

    public function create(Request $request)
    {
        $title = 'Negotiation Entry';
        $user_id            = Auth::user()->id; 
        $my_all_employee    = my_all_employee($user_id);
        $customers          = FollowUpAnalysis::where('status',0)->where('approve_by','!=',null)->whereHas('customer',function($q) use($my_all_employee){
                                    $q->whereIn('ref_id',$my_all_employee);
                                })->get();
        $projects       = Project::where('status',1)->get(['name', 'id']);
        $projectUnits   = ProjectUnit::where('status', 1)->get(['name', 'id']);
        $employees          = User::whereIn('id', $my_all_employee)->get();
        $priorities         = $this->priority(); 
        $units              = Unit::select('id','title')->get();

        $selected_data = 
        [
            'employee' => Auth::user()->id,
            'priority' => Priority::Regular,
        ];
        if ($request->has('customer')) {
            $selected_data['customer'] = $request->customer;
        }

        return view('negotiation.negotiation_save', compact('selected_data','priorities','projects','projectUnits','customers','employees','units'));
    }

    public function save(Request $request, $id = null)
    {
        $validator = Validator::make($request->all(), [
            'customer'          => 'required',
            'employee'          => 'required',
            'priority'          => 'required',
            'project'           => 'required',
            'unit_qty'          => 'required',
            'unit'              => 'required', 
            'regular_amount'    => 'required',
            'negotiation_amount'=> 'required',
            'remark'            => 'nullable',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator)->with('error', $validator->errors()->first());
        }

        if (!empty($id)) {
            $follow = Negotiation::findOrFail($id);
            $follow->customer_id = $request->customer;
            $follow->employee_id = $request->employee;
            $follow->priority = $request->priority;
            $follow->project_id = $request->input('project');
            $follow->unit_id = $request->input('unit');
            $follow->select_type = $request->select_type;
            $follow->payment_duration = $request->payment_duration; 
            $follow->unit_price = $request->unit_price;
            $follow->unit_qty = $request->unit_qty;
            $follow->regular_amount = $request->input('regular_amount');
            $follow->negotiation_amount = $request->input('negotiation_amount'); 
            $follow->remark = $request->remark;
            $follow->updated_by = $request->updated_by;
            $follow->updated_at = $request->updated_at;
            $follow->save();
            return redirect()->route('negotiation.index')->with('success','Negotiation update successfully');
        } else {
            $follow = new Negotiation();
            $follow->customer_id = $request->customer;
            $follow->employee_id = $request->employee;
            $follow->priority = $request->priority;
            $follow->project_id = $request->input('project');
            $follow->unit_id = $request->input('unit');
            $follow->select_type = $request->select_type;
            $follow->payment_duration = $request->payment_duration; 
            $follow->unit_price = $request->unit_price;
            $follow->unit_qty = $request->unit_qty;
            $follow->regular_amount = $request->input('regular_amount');
            $follow->negotiation_amount = $request->input('negotiation_amount'); 
            $follow->remark = $request->remark;  

            $approve_setting = ApproveSetting::where('name','negotiation')->first(); 
            if(isset($approve_setting->status) && $approve_setting->status == 0){ 
                $follow->approve_by = auth()->user()->id;
            } 
            
            $follow->created_by = auth()->id();
            $follow->created_at = now();
            $follow->status = 0;
            $follow->save();

            if($follow) {
                $visit = FollowUpAnalysis::where('customer_id',$request->customer)->first();
                $visit->status = 1;
                $visit->save();
            }
            
            return redirect()->route('negotiation.index')->with('success','Negotiation create successfully');
        }
    }

    public function edit(string $id, Request $request)
    {
        $title = 'Negotiation Edit';
        $user_id            = Auth::user()->id; 
        $my_all_employee    = my_all_employee($user_id);
        $customers          = VisitAnalysis::where('status',0)->where('approve_by','!=',null)->whereHas('customer',function($q) use($my_all_employee){
                                    $q->whereIn('ref_id',$my_all_employee);
                                })->get();
        $projects = Project::where('status',1)->get(['name', 'id']);
        $projectUnits = ProjectUnit::where('status', 1)->get(['name', 'id']);
        $employees          = User::whereIn('id', $my_all_employee)->get();
        $priorities         = $this->priority();

        $selected_data = 
        [
            'employee' => Auth::user()->id,
            'priority' => Priority::Regular,
        ];
        if ($request->has('customer')) {
            $selected_data['customer'] = $request->customer;
        }
        $negotiation = Negotiation::find($id);
        return view('negotiation.negotiation_save',compact('selected_data','priorities','projects','projectUnits','customers','employees','negotiation'));
    }

    public function negotiationDelete($id){
        try{ 
            $data  = Negotiation::find($id);
            $data->delete();
            return response()->json(['success' => 'Negotiation Deleted'],200);
        }catch(Exception $e){
            return response()->json(['error' => $e->getMessage()],500);
        }
    }

    public function negotiationApprove(){ 
        $user_id        = Auth::user()->id; 
        $my_employee    = my_employee($user_id);
        $negotiations  = Negotiation::where('approve_by', null)->whereIn('employee_id',$my_employee)->orderBy('id','desc')->get(); 
        return view('negotiation.negotiation_approve', compact('negotiations'));
    }

    public function negotiationApproveSave(Request $request) {
        if($request->has('negotiation_id') && $request->negotiation_id !== '' & $request->negotiation_id !== null) {
            DB::beginTransaction();
            try {
                foreach ($request->negotiation_id as $key => $negotiation_id) {
                    $lead = Negotiation::where('id',$negotiation_id)->first();
                    $lead->approve_by = Auth::user()->id;
                    $lead->save();
                }
                DB::commit();
                return redirect()->route('negotiation.index')->with('success', 'Successfully Approved');
            } catch (Exception $e) {
                DB::rollback();
                return redirect()->back()->withInput()->with('error', $e->getMessage());
            }
            
        } else {
            return redirect()->back()->with('error', 'Please select at least one negotiation');
        }
    }

}
