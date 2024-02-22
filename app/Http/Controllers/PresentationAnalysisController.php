<?php

namespace App\Http\Controllers;

use App\Enums\Priority;
use App\Models\Customer;
use App\Models\Employee;
use App\Models\Freelancer;
use App\Models\Presentation;
use App\Models\Profession;
use App\Models\Project;
use App\Models\Unit;
use App\Models\User;
use App\Models\VisitAnalysis;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class PresentationAnalysisController extends Controller
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
        $visits = VisitAnalysis::whereHas('customer', function($q) use($user_employee){ 
            $q->whereIn('ref_id', $user_employee);
        }); 

         if(isset($request->profession) && !empty($request->profession)){
            $profession = (int)$request->profession;
            $visits = $visits->whereHas('customer', function($q) use($profession){ 
                $q->where('profession_id', $profession);
            });
         } 
         $visits = $visits->get();  
         $filter =  $request->all();
        return view('presentation_analysis.presentation_analysis_list', compact('visits','employee_data','professions','employees','filter'));
    }

    public function create()
    {        
        $title = 'Vist Analysis Entry';
        $user_id            = Auth::user()->id; 
        $my_all_employee    = my_all_employee($user_id);
        $customers          = Customer::whereIn('ref_id', $my_all_employee)->get();
        $freelancers        = User::where('user_type',2)->whereIn('ref_id',$my_all_employee)->get();
        $priorities         = $this->priority();
        $projects           = Project::where('status',1)->select('id','name')->get();
        $units              = Unit::select('id','title')->get();
        return view('presentation_analysis.presentation_analysis_save',compact('title','customers','priorities','projects','units','freelancers'));
    }

    public function save(Request $request, $id = null)
    {
        $validator = Validator::make($request->all(), [
            'freelancer'    => 'required|array',
            'freelancer.*'  => 'string',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator)->with('error', $validator->errors()->first());
        }

        if (!empty($id)) {
            $visit = VisitAnalysis::findOrFail($id);
            $projectsJson = json_encode($request->input('projects'));
            $visit->visitors = json_encode($request->input('freelancer'));
            $visit->projects = $projectsJson;
            $visit->customer_id = $request->customer_id;
            $visit->remark = $request->remark;
            $visit->updated_by = $request->updated_by;
            $visit->updated_at = $request->updated_at;
            $visit->status = 1;
            $visit->save();
            return redirect()->route('presentation_analysis.index')->with('success','Presemtation analysis update successfully');
        } else {
            $visit = new VisitAnalysis();
            $visit->visitors = json_encode($request->input('freelancer'));;
            $visit->projects = json_encode($request->input('projects'));;
            $visit->customer_id = $request->customer_id;
            $visit->employee_id = 1;    #dummy
            $visit->remark = $request->remark;
            $visit->created_by = auth()->id();
            $visit->created_at = now();
            $visit->status = 1; #dummy
            $visit->save();
            
            return redirect()->route('presentation_analysis.index')->with('success','Presentation analysis create successfully');
        }
    }

    public function edit(string $id)
    {
        $title = 'Vist Analysis Edit';
        $user_id            = Auth::user()->id; 
        $my_all_employee    = my_all_employee($user_id);
        $customers          = Customer::whereIn('ref_id', $my_all_employee)->get();
        $freelancers        = User::where('user_type',2)->whereIn('ref_id',$my_all_employee)->get();
        $priorities         = $this->priority();
        $projects           = Project::where('status',1)->select('id','name')->get();
        $units              = Unit::select('id','title')->get();
        $visit              = VisitAnalysis::findOrFail($id);
        return view('presentation_analysis.presentation_analysis_save',compact('title','customers','priorities','projects','units','visit','freelancers'));
    }

    public function presentationDelete($id){
        try{ 
            $data  = Presentation::find($id);
            $data->delete();
            return response()->json(['success' => 'Presentation Analysis Deleted'],200);
        }catch(Exception $e){
            return response()->json(['error' => $e->getMessage()],500);
        }
    }

    public function presentationAnalysisApprove(){ 
        $user_id        = Auth::user()->id; 
        $my_employee    = my_employee($user_id);
        $presentations  = VisitAnalysis::where('approve_by', null)->whereIn('employee_id',$my_employee)->orderBy('id','desc')->get(); 
        return view('presentation.presentation_analysis_approve', compact('presentations'));
    }

    public function presentationAnalysisApproveSave(Request $request) {
        if($request->has('presentation_id') && $request->presentation_id !== '' & $request->presentation_id !== null) {
            DB::beginTransaction();
            try {
                foreach ($request->presentation_id as $key => $presentation_id) {
                    $lead = Presentation::where('id',$presentation_id)->first();
                    $lead->approve_by = Auth::user()->id;
                    $lead->save();
                }
                DB::commit();
                return redirect()->route('presen')->with('success', 'Status Updated Successfully');
            } catch (Exception $e) {
                DB::rollback();
                return redirect()->back()->withInput()->with('error', $e->getMessage());
            }
            
        } else {
            return redirect()->route('presentation.approve')->with('error', 'Something went wrong!');
        }

    }
}
