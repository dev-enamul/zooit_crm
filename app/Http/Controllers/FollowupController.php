<?php

namespace App\Http\Controllers;

use App\DataTables\FollowUpDataTable;
use App\Enums\Priority;
use App\Models\ApproveSetting;
use App\Models\Customer;
use App\Models\FollowUp;
use App\Models\Presentation;
use App\Models\Project;
use App\Models\ProjectUnit;
use App\Models\Unit;
use App\Models\UnitPrice;
use App\Models\User;
use App\Models\VisitAnalysis;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class FollowupController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(FollowUpDataTable $dataTable, Request $request)
    { 
        $title = 'Follow Up'; 
        $date = $request->date??null;
        $status = $request->status??0;
        $start_date = Carbon::parse($date ? explode(' - ',$date)[0] : date('Y-m-01'))->format('Y-m-d');
        $end_date = Carbon::parse($date ? explode(' - ',$date)[1] : date('Y-m-t'))->format('Y-m-d'); 
        $employee = $request->employee??null;
        $employee = $employee ? User::find($employee)?? User::find(auth()->user()->id) :  User::find(auth()->user()->id);
        return $dataTable->render('displaydata', compact('title','employee','status','start_date','end_date'));
    } 

    public function priority()
    {
        return Priority::values();
    }
    
    public function create(Request $request)
    {
        $title = 'Follow Up Entry';
        $user_id            = Auth::user()->id; 
        $projects       = Project::where('status',1)->get(['name', 'id']);
        $projectUnits   = ProjectUnit::where('status', 1)->get(['name', 'id']);
     
        $priorities         = $this->priority();
        $units          = Unit::select('id','title')->get();

        $selected_data[] =Priority::Regular;
        if ($request->has('customer')) {
            $selected_data['customer'] = Customer::find($request->customer);
        } 
        return view('followup.followup_save',compact('selected_data','priorities','projects','projectUnits','units'));
    }

    public function customer_data(Request $request){
        $presentation  =  Presentation::where('customer_id',$request->customer_id)->first();
        return response()->json($presentation);
    }
    
    public function projectDurationTypeName(Request $request)
    {
        try {
            $project = Project::find($request->project_id); 
            if (!$project) {
                throw new Exception("Project not found");
            }  
            $project_units = ProjectUnit::where('project_id', $project->id)
                ->where('status', 1)
                ->where('sold_status', '!=', 1)
                ->with('unitCategory');
 
            if (isset($request->unit_id) && !empty($request->unit_id)) {
                $project_units->where('unit_id', $request->unit_id);
            }

            if(isset($request->unit_category_id) && !empty($request->unit_category_id)){
                $project_units->where('unit_category_id', $request->unit_category_id);
            }

            if(isset($request->floor) && !empty($request->floor)){
                $project_units->where('floor', $request->floor);
            }

            $highest_price = $project_units->orderBy('lottery_price', 'desc')->first();
            $project_units =  $project_units->get(); 
  
            $response_data = [ 
                'project_unit' => $project_units,
                'most_highest_price' => $highest_price->lottery_price??"",
            ]; 
            return response()->json($response_data);
        } catch (Exception $e) {
            return response()->json(["error" => $e->getMessage()], 404);
        }
    }

    public function save(Request $request, $id = null)
    {
        $validator = Validator::make($request->all(), [
            'customer'          => 'required',
            'employee'          => 'required',
            'priority'          => 'required',
            'project'           => 'required',
            'unit'              => 'required',
            'unit_qty'          => 'required', 
            'regular_amount'    => 'required',
            'negotiation_amount'=> 'required',
            'remark'            => 'nullable',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator)->with('error', $validator->errors()->first());
        }

        if (!empty($id)) {
            $follow = FollowUp::findOrFail($id);
            $follow->customer_id = $request->customer;
            $follow->employee_id = $request->employee;
            $follow->priority = $request->priority;
            $follow->project_id = $request->input('project');
            $follow->unit_id = $request->input('unit');   
            $follow->unit_price = $request->input('unit_price');
            $follow->unit_qty = $request->input('unit_qty');
            $follow->regular_amount = $request->input('regular_amount');
            $follow->negotiation_amount = $request->input('negotiation_amount'); 
            $follow->remark = $request->remark;
            $follow->updated_by = $request->updated_by;
            $follow->updated_at = $request->updated_at;
            $follow->save();
            return redirect()->route('followup.index')->with('success','Follow Up update successfully');
        } else {
            $follow = new FollowUp();
            $follow->customer_id = $request->customer;
            $follow->employee_id = $request->employee;
            $follow->priority = $request->priority;
            $follow->project_id = $request->input('project');
            $follow->unit_id = $request->input('unit');   
            $follow->unit_price = $request->input('unit_price');
            $follow->unit_qty = $request->input('unit_qty');
            $follow->regular_amount = $request->input('regular_amount');
            $follow->negotiation_amount = $request->input('negotiation_amount'); 
            $follow->remark = $request->remark;

            $approve_setting = ApproveSetting::where('name','follow_up')->first(); 
            $is_admin = Auth::user()->hasPermission('admin'); 
            if($approve_setting?->status == 0 || $is_admin){ 
                $follow->approve_by = auth()->user()->id;
            } 

            $follow->created_by = auth()->id();
            $follow->created_at = now();
            $follow->status = 0;
            $follow->save();

            if($follow) {
                $visit = VisitAnalysis::where('customer_id',$request->customer)->first();
                if(isset($visit) && $visit != null){
                    $visit->status = 1;
                    $visit->save();
                } 
            }
            
            return redirect()->route('followup.index')->with('success','Follow Up create successfully');
        }
    }

    public function edit(string $id, Request $request)
    {
        $title = 'Follow Up Edit'; 
        $my_all_employee    = json_decode(Auth::user()->user_employee);
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
        $follow = FollowUp::find($id);
        return view('followup.followup_save',compact('selected_data','priorities','projects','projectUnits','customers','employees','follow'));
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
        $followUps  = FollowUp::where('approve_by', null)->whereIn('employee_id',$my_employee)->orderBy('id','desc')->get(); 
        return view('followup.followup_approve', compact('followUps'));
    }

    public function followUpApproveSave(Request $request) {
        if($request->has('followUp_id') && $request->followUp_id !== '' & $request->followUp_id !== null) {
            DB::beginTransaction();
            try {
                foreach ($request->followUp_id as $key => $followUp_id) {
                    $lead = FollowUp::where('id',$followUp_id)->first();
                    $lead->approve_by = Auth::user()->id;
                    $lead->save();
                }
                DB::commit();
                return redirect()->route('followup.index')->with('success', 'Status Updated Successfully');
            } catch (Exception $e) {
                DB::rollback();
                return redirect()->back()->withInput()->with('error', $e->getMessage());
            }
            
        } else {
            return redirect()->back()->with('error', 'Please Select At Least One Follow Up');
        }
    } 


    public function select2_customer(Request $request){
        $request->validate([
            'term' => ['nullable', 'string'],
        ]);  
        $my_all_employee = json_decode(Auth::user()->user_employee);   
        $is_admin = Auth::user()->hasPermission('admin');
        $results = [
            ['id' => '', 'text' => 'Select Product']
        ]; 
       
        if($is_admin){ 
            $users = Customer::query()
                ->where(function ($query) use ($request) {
                    $term = $request->term;
                    $query->where('customer_id', 'like', "%{$term}%")
                        ->orWhere('name', 'like', "%{$term}%");
                })
                ->whereDoesntHave('salse')
                ->select('id', 'name', 'customer_id')
                ->limit(10)
                ->get();  
                
            foreach ($users as $user) {
                $results[] = [
                    'id' => $user->id,
                    'text' => "{$user->name} [{$user->customer_id}]"
                ]; 
            } 
        }else{
            $users = VisitAnalysis::where('status',0)->where('approve_by','!=',null)
            ->whereHas('customer',function($q) use($my_all_employee,$request){
                $q->whereIn('ref_id',$my_all_employee)
                ->where(function ($query) use ($request) {
                    $term = $request->term;
                    $query->where('customer_id', 'like', "%{$term}%")
                        ->orWhere('name', 'like', "%{$term}%");
                });
              })->get(); 
              foreach ($users as $user) {
                $results[] = [
                    'id' => $user->customer->id,
                    'text' => "{$user->customer->name} [{$user->customer->customer_id}]"
                ]; 
            }
        }  
       
        
        return response()->json([
            'results' => $results
        ]);
    } 

   
}
