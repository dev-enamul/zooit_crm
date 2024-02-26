<?php

namespace App\Http\Controllers;

use App\Enums\Priority;
use App\Models\ApproveSetting;
use App\Models\Customer;
use App\Models\FollowUp;
use App\Models\FollowUpAnalysis;
use App\Models\Project;
use App\Models\ProjectUnit;
use App\Models\Unit;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class FollowupAnalysisController extends Controller
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
        $followUps = FollowUpAnalysis::whereHas('customer', function($q) use($user_employee){ 
            $q->whereIn('ref_id', $user_employee);
        }); 

         $followUps = $followUps->orderBy('id','desc')->get();  
         $filter =  $request->all();
        return view('followup_analysis.followup_analysis_list', compact('followUps','employee_data','employees','filter'));
    }

    public function create(Request $request)
    {
        $title = 'Follow Up Analysis Entry';
        $user_id            = Auth::user()->id; 
        $my_all_employee    = my_all_employee($user_id);
        $customers          = FollowUp::where('status',0)->where('approve_by','!=',null)->whereHas('customer',function($q) use($my_all_employee){
                                    $q->whereIn('ref_id',$my_all_employee);
                                })->get();
        $projects       = Project::where('status',1)->get(['name', 'id']);
        $projectUnits   = ProjectUnit::where('status', 1)->get(['name', 'id']);
        $employees          = User::whereIn('id', $my_all_employee)->get();
        $priorities         = $this->priority();
        $units          = Unit::select('id','title')->get();

        $selected_data = 
        [
            'employee' => Auth::user()->id,
            'priority' => Priority::Regular,
        ];
        if ($request->has('customer')) {
            $selected_data['customer'] = $request->customer;
        } 
        return view('followup_analysis.followup_analysis_save',compact('selected_data','priorities','projects','projectUnits','customers','employees','units'));
    }

    public function save(Request $request, $id = null)
    {
        $validator = Validator::make($request->all(), [
            'customer'          => 'required',
            'priority'          => 'required',
            'project'           => 'required',
            'unit'              => 'required', 
            'employee'          => 'required',
            'regular_amount'    => 'required',
            'negotiation_amount'=> 'nullable',
            'remark'            => 'nullable',
            'customer_expectation'=> 'nullable',
            'customer_need'     => 'nullable',
            'customer_ability'  => 'nullable',
            'influencer_opinion'=> 'nullable',
            'descision_maker'   => 'nullable',
            'decision_maker_opinion'=> 'nullable',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator)->with('error', $validator->errors()->first());
        }

        if (!empty($id)) {
            $follow = FollowUpAnalysis::findOrFail($id);
            $follow->customer_id = $request->customer;
            $follow->employee_id = $request->employee;
            $follow->priority = $request->priority;
            $follow->project_id = $request->input('project');
            $follow->unit_id = $request->input('unit'); 
            $follow->project_units = json_encode($request->input('project_unit'));
            $follow->regular_amount = $request->input('regular_amount');
            $follow->negotiation_amount = $request->input('negotiation_amount');

            $follow->remark = $request->remark;

            $follow->customer_expectation = $request->customer_expectation;
            $follow->need = $request->customer_need;
            $follow->ability = $request->customer_ability;
            $follow->influencer_opinion = $request->influencer_opinion;
            $follow->decision_maker = $request->descision_maker;
            $follow->decision_maker_opinion = $request->decision_maker_opinion;

            $follow->updated_by = $request->updated_by;
            $follow->updated_at = $request->updated_at;
            $follow->save();
            return redirect()->route('followup-analysis.index')->with('success','Follow Up Analysis update successfully');
        } else {
            $follow = new FollowUpAnalysis();
            $follow->customer_id = $request->customer;
            $follow->employee_id = $request->employee;
            $follow->priority = $request->priority;
            $follow->project_id = $request->input('project');
            $follow->unit_id = $request->input('unit');
            $follow->select_type = $request->select_type;
            $follow->payment_duration = $request->payment_duration;
            $follow->project_units = json_encode($request->input('project_unit'));
            $follow->regular_amount = $request->input('regular_amount');
            $follow->negotiation_amount = $request->input('negotiation_amount');
            $follow->remark = $request->remark;
            $follow->customer_expectation = $request->customer_expectation;
            $follow->need = $request->customer_need;
            $follow->ability = $request->customer_ability;
            $follow->influencer_opinion = $request->influencer_opinion;
            $follow->decision_maker = $request->descision_maker;
            $follow->decision_maker_opinion = $request->decision_maker_opinion;

            $approve_setting = ApproveSetting::where('name','follow_up_analysis')->first(); 
            if(isset($approve_setting->status) && $approve_setting->status == 0){ 
                $follow->approve_by = auth()->user()->id;
            }

            $follow->created_by = auth()->id();
            $follow->created_at = now();
            $follow->status = 0;
            $follow->save();

            if($follow) {
                $visit = FollowUp::where('customer_id',$request->customer)->first();
                $visit->status = 1;
                $visit->save();
            }
            
            return redirect()->route('followup-analysis.index')->with('success','Follow Up Analysis create successfully');
        }
    }

    public function edit(string $id, Request $request)
    {
        $title = 'Follow Up Analysis Entry';
        $user_id            = Auth::user()->id; 
        $my_all_employee    = my_all_employee($user_id);
        $customers          = FollowUp::where('status',0)->where('approve_by','!=',null)->whereHas('customer',function($q) use($my_all_employee){
                                    $q->whereIn('ref_id',$my_all_employee);
                                })->get();
        $projects       = Project::where('status',1)->get(['name', 'id']);
        $projectUnits   = ProjectUnit::where('status', 1)->get(['name', 'id']);
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

        $followUp  = FollowUpAnalysis::find($id);
        return view('followup_analysis.followup_analysis_save',compact('followUp','selected_data','priorities','projects','projectUnits','customers','employees'));
    }


    public function followUpDelete($id){
        try{ 
            $data  = FollowUp::find($id);
            $data->delete();
            return response()->json(['success' => 'Follow Up Deleted'],200);
        }catch(Exception $e){
            return response()->json(['error' => $e->getMessage()],500);
        }
    }

    public function followUpApprove(){ 
        $user_id        = Auth::user()->id; 
        $my_employee    = my_employee($user_id);
        $followUps  = FollowUpAnalysis::where('approve_by', null)->whereIn('employee_id',$my_employee)->orderBy('id','desc')->get(); 
        return view('followup_analysis.followup_analysis_approve', compact('followUps'));
    }

    public function followUpsApproveSave(Request $request) {
        if($request->has('followUp_id') && $request->followUp_id !== '' & $request->followUp_id !== null) {
            DB::beginTransaction();
            try {
                foreach ($request->followUp_id as $key => $followUp_id) {
                    $lead = FollowUpAnalysis::where('id',$followUp_id)->first();
                    $lead->approve_by = Auth::user()->id;
                    $lead->save();
                }
                DB::commit();
                return redirect()->route('followup-analysis.index')->with('success', 'Successfully Approved');
            } catch (Exception $e) {
                DB::rollback();
                return redirect()->back()->withInput()->with('error', $e->getMessage());
            }
            
        } else {
            return redirect()->back()->with('error', 'Please select at least one record');
        }
    }

}
