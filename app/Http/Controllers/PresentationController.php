<?php

namespace App\Http\Controllers;

use App\Enums\Priority;
use App\Models\ApproveSetting;
use App\Models\Customer;
use App\Models\LeadAnalysis;
use App\Models\Presentation;
use App\Models\Profession;
use App\Models\Project;
use App\Models\Unit;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class PresentationController extends Controller
{
    public function priority()
    {
        return Priority::values();
    }
    
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
        $presentations = Presentation::whereHas('customer', function($q) use($user_employee){ 
            $q->whereIn('ref_id', $user_employee);
        }); 

         if(isset($request->profession) && !empty($request->profession)){
            $profession = (int)$request->profession;
            $presentations = $presentations->whereHas('customer', function($q) use($profession){ 
                $q->where('profession_id', $profession);
            });
         } 
         $presentations = $presentations->orderBy('id','desc')->get();  
         $filter =  $request->all();
        return view('presentation.presentation_list', compact('presentations','employee_data','professions','employees','filter'));
    }

    public function create(Request $request)
    {        
        $title = 'Presentation Entry';
        $user_id            = Auth::user()->id; 
        $my_all_employee    = my_all_employee($user_id);
        $priorities         = $this->priority();
        $projects           = Project::where('status',1)->select('id','name')->get();
        $units              = Unit::select('id','title')->get();

        $cstmrs             = LeadAnalysis::where('status',0)->where('approve_by','!=',null)->whereHas('customer',function($q) use($my_all_employee){
                                    $q->whereIn('ref_id',$my_all_employee);
                                })->get();
        $employees          = User::whereIn('id', $my_all_employee)->get();

        $selected_data = 
        [
            'employee' => Auth::user()->id,
            'priority' => Priority::Regular,
        ];
        if ($request->has('customer')) {
            $selected_data['customer'] = $request->customer;
        }
        return view('presentation.presentation_save',compact('title','cstmrs','priorities','projects','units','employees','selected_data'));
    }

    public function customer_data(Request $request){
        $lead_analysis  = LeadAnalysis::where('customer_id',$request->customer_id)->first();
        return response()->json($lead_analysis,200);
    }

    public function save(Request $request, $id = null)
    {
        $validator = Validator::make($request->all(), [
            'customer'   => 'required',
            'employee'   => 'required', 
            'priority'   => 'required',
            'project'    => 'required',
            'unit'       => 'required',
            'remark'     => 'nullable|string|max:255',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator)->with('error', $validator->errors()->first());
        }

        if (!empty($id)) {
            $presentation = Presentation::find($id);
            $presentation->update([
                'customer_id'   => $request->customer,
                'employee_id'   => $request->employee,
                'priority'      => $request->priority,
                'remark'        => $request->remark,
                'project_id'    => $request->project,
                'unit_id'       => $request->unit,
                'updated_by'    => auth()->id(),
                'updated_at'    => now(),
            ]);
            return redirect()->route('presentation.index')->with('success','Presemtation update successfully');

        } else {
            $presentation = new Presentation();
            $presentation->priority      = $request->priority;
            $presentation->remark        = $request->remark;
            $presentation->customer_id   = $request->customer;
            $presentation->employee_id   = $request->employee;    
            $presentation->project_id    = $request->project;    
            $presentation->unit_id       = $request->unit; 
            $approve_setting = ApproveSetting::where('name','presentation')->first();  
            $is_admin = Auth::user()->hasPermission('admin'); 
            if($approve_setting?->status == 0 || $is_admin){ 
                $presentation->approve_by = auth()->user()->id;
            }  
            $presentation->status        = 0;    
            $presentation->created_by    = auth()->id();
            $presentation->created_at    = now();
            $presentation->save();

            if($presentation) {
                $lead_analysis = LeadAnalysis::where('customer_id',$request->customer)->first();
                $lead_analysis->status = 1;
                $lead_analysis->save();
            }
            return redirect()->route('presentation.index')->with('success','Presentation create successfully');
        }
    }

    public function edit(string $id)
    {
        $title = 'Presentation Edit';
        $user_id   = Auth::user()->id; 
        $my_all_employee = my_all_employee($user_id);
        $customers = Customer::whereIn('ref_id', $my_all_employee)->get();
        $priorities = $this->priority();
        $projects = Project::where('status',1)->select('id','name')->get();
        $units          = Unit::select('id','title')->get();
        $presentation = Presentation::find($id);
        return view('presentation.presentation_save',compact('title','customers','priorities','projects','units','presentation'));
    }

    public function presentationDelete($id){
        try{ 
            $data  = Presentation::find($id);
            $data->delete();
            return response()->json(['success' => 'Presentation Deleted'],200);
        }catch(Exception $e){
            return response()->json(['error' => $e->getMessage()],500);
        }
    }

    public function presentationApprove(){ 
        $user_id        = Auth::user()->id; 
        $my_employee    = my_employee($user_id);
        $presentations  = Presentation::where('approve_by', null)->whereIn('employee_id',$my_employee)->orderBy('id','desc')->get(); 
        return view('presentation.presentation_approve', compact('presentations'));
    }

    public function presentationApproveSave(Request $request) {
        if($request->has('presentation_id') && $request->presentation_id !== '' & $request->presentation_id !== null) {
            DB::beginTransaction();
            try {
                foreach ($request->presentation_id as $key => $presentation_id) {
                    $lead = Presentation::where('id',$presentation_id)->first();
                    $lead->approve_by = Auth::user()->id;
                    $lead->save();
                }
                DB::commit();
                return redirect()->route('presentation.approve')->with('success', 'Status Updated Successfully');
            } catch (Exception $e) {
                DB::rollback();
                return redirect()->back()->withInput()->with('error', $e->getMessage());
            }
            
        } else {
            return redirect()->route('presentation.approve')->with('error', 'Something went wrong!');
        }

    }
}
