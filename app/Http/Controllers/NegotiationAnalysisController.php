<?php

namespace App\Http\Controllers;

use App\Enums\Priority;
use App\Models\ApproveSetting;
use App\Models\Customer;
use App\Models\Lead;
use App\Models\Negotiation;
use App\Models\NegotiationAnalysis;
use App\Models\NegotiationWaitingDay;
use App\Models\Presentation;
use App\Models\Project;
use App\Models\ProjectUnit;
use App\Models\Unit;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class NegotiationAnalysisController extends Controller
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

        $waiting_day = NegotiationWaitingDay::first();
        if(isset($waiting_day) && $waiting_day != null){
            $startDate = Carbon::now()->subDays($waiting_day->waiting_day)->startOfDay(); 
        }else{
            $startDate = Carbon::now()->subDays(7)->startOfDay(); 
        }
        
        $endDate = Carbon::now()->endOfDay();
      
        $user_employee = my_all_employee($user_id);
        $negotiations = NegotiationAnalysis::whereBetween('created_at',[$startDate,$endDate])
        ->where(function($q){
            $q->where('approve_by','!=',null)
                ->orWhere('employee_id', Auth::user()->id)
                ->orWhere('created_by', Auth::user()->id);
        })
        ->whereHas('customer', function($q) use($user_employee){ 
            $q->whereIn('ref_id', $user_employee);
        }); 
  

         $negotiations = $negotiations->orderBY('id','desc')->get();  
         $filter =  $request->all();
        return view('negotiation_analysis.negotiation_analysis_list',compact('negotiations','employee_data','employees','filter','waiting_day'));
    }

   
    public function create(Request $request)
    {
        $title = 'Negotiation Analysis Entry';
        $user_id            = Auth::user()->id; 
        $my_all_employee    = my_all_employee($user_id);
        $customers          = Negotiation::where('status',0)->where('approve_by','!=',null)->whereHas('customer',function($q) use($my_all_employee){
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

        return view('negotiation_analysis.negotiation_analysis_save', compact('selected_data','priorities','projects','projectUnits','customers','employees','units'));
    }

    public function save(Request $request, $id = null)
    {
        $validator = Validator::make($request->all(), [
            'customer'          => 'required',
            'employee'          => 'required',
            'priority'          => 'required',
            'project'           => 'required',
            'unit'              => 'required', 
            'regular_amount'    => 'required',
            'unit_qty'          => 'required',
            'negotiation_amount'=> 'required',
            'customer_emotion'  => 'nullable',
            'customer_preference'=> 'nullable',
            'plan_b'            => 'nullable'
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator)->with('error', $validator->errors()->first());
        }

        if (!empty($id)) {
            $follow = NegotiationAnalysis::findOrFail($id);
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
            $follow->customer_emotion = $request->input('customer_emotion');
            $follow->customer_preference = $request->input('customer_preference');
            $follow->plan_b = $request->input('plan_b');
            
            $follow->updated_by = $request->updated_by;
            $follow->updated_at = $request->updated_at;
            $follow->save();
            return redirect()->route('negotiation-analysis.index')->with('success','Negotiation Analysis update successfully');
        } else {
            $follow = new NegotiationAnalysis();
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
            $follow->customer_emotion = $request->input('customer_emotion');
            $follow->customer_preference = $request->input('customer_preference');
            $follow->plan_b = $request->input('plan_b');

            $approve_setting = ApproveSetting::where('name','negotiation_analysis')->first(); 
            if(isset($approve_setting->status) && $approve_setting->status == 0){ 
                $follow->approve_by = auth()->user()->id;
            }

            $follow->created_by = auth()->id();
            $follow->created_at = now();
            $follow->status = 0;
            $follow->save();

            if($follow) {
                $visit = Negotiation::where('customer_id',$request->customer)->first();
                $visit->status = 1;
                $visit->save();
            }
            
            return redirect()->route('negotiation-analysis.index')->with('success','Negotiation Analysis create successfully');
        }
    }

    public function edit(string $id, Request $request)
    {
        $title = 'Negotiation Analysis Edit';
        $user_id            = Auth::user()->id; 
        $my_all_employee    = my_all_employee($user_id);
        $customers          = Negotiation::where('status',0)->where('approve_by','!=',null)->whereHas('customer',function($q) use($my_all_employee){
                                    $q->whereIn('ref_id',$my_all_employee);
                                })->get();
        $projects           = Project::where('status',1)->get(['name', 'id']);
        $projectUnits       = ProjectUnit::where('status', 1)->get(['name', 'id']);
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
        $negotiation = NegotiationAnalysis::find($id);
        
        return view('negotiation_analysis.negotiation_analysis_save',compact('selected_data','priorities','projects','projectUnits','customers','employees','negotiation'));

    }

    public function negotiationAnalysisDelete($id){
        try{ 
            $data  = NegotiationAnalysis::find($id);
            $data->delete();
            return response()->json(['success' => 'Negotiation Analysis Deleted'],200);
        }catch(Exception $e){
            return response()->json(['error' => $e->getMessage()],500);
        }
    }

    public function negotiationAnalysisApprove(){ 
        $user_id        = Auth::user()->id; 
        $my_employee    = my_employee($user_id);
        $negotiations  = NegotiationAnalysis::where('approve_by', null)->whereIn('employee_id',$my_employee)->orderBy('id','desc')->get(); 
        return view('negotiation_analysis.negotiation_analysis_approve', compact('negotiations'));
    }

    public function negotiationAnalysisApproveSave(Request $request) {
        if($request->has('negotiation_id') && $request->negotiation_id !== '' & $request->negotiation_id !== null) {
            DB::beginTransaction();
            try {
                foreach ($request->negotiation_id as $key => $negotiation_id) {
                    $lead = NegotiationAnalysis::where('id',$negotiation_id)->first();
                    $lead->approve_by = Auth::user()->id;
                    $lead->save();
                }
                DB::commit();
                return redirect()->route('negotiation-analysis.index')->with('success', 'Status Updated Successfully');
            } catch (Exception $e) {
                DB::rollback();
                return redirect()->back()->withInput()->with('error', $e->getMessage());
            }
            
        } else {
            return redirect()->back()->with('error', 'Please select at least one negotiation analysis');
        }
    }

    public function update_waiting_day(Request $request){
        $validator = Validator::make($request->all(),[
            'waiting_day' => 'required',
        ]); 
        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator)->with('error', $validator->errors()->first());
        }

        try{
            $waiting_day = NegotiationWaitingDay::first();
            if(!isset($waiting_day) || $waiting_day== null){
                $waiting_day  = new NegotiationWaitingDay();
            }

            $waiting_day->waiting_day = $request->waiting_day;
            $waiting_day->save(); 
            return redirect()->back()->with('success','Successfully Updated');
        }catch(Exception $e){
            return redirect()->back()->with('error',$e->getMessage());
        }

    } 

    public function negotiation_analysis_details($id){
        $id = decrypt($id);
        $data = NegotiationAnalysis::find($id);  
        $last_lead = Lead::where('customer_id',$data->customer_id)->whereNotNull('approve_by')->select('created_at')->latest()->first();
        $last_presentation_date = Presentation::where('customer_id',$data->customer_id)
            ->whereNotNull('approve_by')
            ->select('created_at')
            ->latest()
            ->first();
        $last_follow_up = Negotiation::where('customer_id',$data->customer_id)
                ->whereNotNull('approve_by')
                ->select('created_at','negotiation_amount')
                ->latest()
                ->first();
        return view('negotiation_analysis.negotiation_analysis_details',compact([
            'data',
            'last_lead','last_presentation_date','last_follow_up'
        ])); 
    }

}
