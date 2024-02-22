<?php

namespace App\Http\Controllers;

use App\Enums\Religion;
use App\Models\Customer;
use App\Models\Lead;
use App\Models\LeadAnalysis;
use App\Models\Profession;
use App\Models\Project;
use App\Models\Unit;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class LeadAnalysisController extends Controller
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
        $leads = LeadAnalysis::whereHas('customer', function($q) use($user_employee){ 
            $q->whereIn('ref_id', $user_employee);
        }); 

         if(isset($request->profession) && !empty($request->profession)){
            $profession = (int)$request->profession;
            $leads = $leads->whereHas('customer', function($q) use($profession){ 
                $q->where('profession_id', $profession);
            });
         } 
         $leads     = $leads->with('lead')->orderBy('id','desc')->get();  
         $filter    =  $request->all();
        return view('lead_analysis.lead_analysis_list',compact('leads','employee_data','professions','employees','filter'));
    }

    public function religion()
    {
        return Religion::values();
    }


    public function create()
    {
        $title = 'Lead Analysis Entry';
        $user_id   = Auth::user()->id; 
        $my_all_employee = my_all_employee($user_id);
        $cstmrs             = Lead::where('status',0)->where('approve_by','!=',null)->whereHas('customer',function($q) use($my_all_employee){
                                $q->whereIn('ref_id',$my_all_employee);
                            })->get();
        $projects = Project::where('status',1)->select('id','name')->get();
        $units          = Unit::select('id','title')->get();
        $religions = $this->religion();
        $employees          = User::whereIn('id', $my_all_employee)->get();

        return view('lead_analysis.lead_analysis_save',compact('title','cstmrs','projects','units','religions','employees'));
    }

    public function save(Request $request, $id = null)
    {
        $validator = Validator::make($request->all(), [
            'customer' => ['required', 'numeric'],
            'employee' => ['required', 'numeric'],
            'project' => ['required', 'numeric'],
            'unit' => ['required', 'numeric'],
            'hobby' => ['required', 'string', 'max:255'],
            'income_range' => ['required', 'numeric'],
            'religion' => ['required', 'numeric'],
            'profession_year' => ['required', 'numeric'],
            'customer_need' => ['required', 'string', 'max:255'],
            'tentative_amount' => ['required', 'numeric'],
            'facebook_id' => ['required', 'string', 'max:255'],
            'customer_problem' => ['required', 'string', 'max:255'],
            'refferal' => ['required', 'string', 'max:255'],
            'influencer' => ['required', 'string', 'max:255'],
            'family_member' => ['required', 'numeric'],
            'decision_maker' => ['required', 'string', 'max:255'],
            'previous_experiance' => ['required', 'string', 'max:255'],
            'instant_investment' => ['required', 'string', 'max:255'],
            'buyer' => ['required', 'string', 'max:255'],
            'area' => ['required', 'string', 'max:255'],
            'consumer' => ['required', 'string', 'max:255'],
        ]);
        
        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator)->with('error', $validator->errors()->first());
        }
        
        if (!empty($id)) {
            $cold_calling = LeadAnalysis::find($id);
            $cold_calling->update([
                'customer_id'   => $request->customer,
                'employee_id'   => $request->employee, 
                'project_id'   => $request->project,
                'unit_id'   => $request->unit,
                'hobby'   => $request->hobby,
                'income_range'   => $request->income_range,
                'religion'   => $request->religion,
                'profession_year'   => $request->profession_year,
                'customer_need'   => $request->customer_need,
                'tentative_amount'   => $request->tentative_amount,
                'facebook_id'   => $request->facebook_id,
                'customer_problem'   => $request->customer_problem,
                'refferal'   => $request->refferal,
                'influencer'   => $request->influencer,
                'family_member'   => $request->family_member,
                'decision_maker'   => $request->decision_maker,
                'previous_experience'   => $request->previous_experiance,
                'instant_investment'   => $request->instant_investment,
                'buyer'   => $request->buyer,
                'area'   => $request->area,
                'consumer'   => $request->consumer,
                'updated_by'    => auth()->id(),
                'updated_at'    => now(),
            ]);
            return redirect()->route('lead-analysis.index')->with('success','Lead Analysis update successfully');

        } else {
            $lead_analysis = LeadAnalysis::create([
                'customer_id'          => $request->customer,
                'employee_id'          => $request->employee, 
                'project_id'           => $request->project,
                'unit_id'              => $request->unit,
                'hobby'                => $request->hobby,
                'income_range'         => $request->income_range,
                'religion'             => $request->religion,
                'profession_year'      => $request->profession_year,
                'customer_need'        => $request->customer_need,
                'tentative_amount'     => $request->tentative_amount,
                'facebook_id'          => $request->facebook_id,
                'customer_problem'     => $request->customer_problem,
                'refferal'             => $request->refferal,
                'influencer'           => $request->influencer,
                'family_member'        => $request->family_member,
                'decision_maker'       => $request->decision_maker,
                'previous_experience'  => $request->previous_experience, 
                'instant_investment'   => $request->instant_investment,
                'buyer'                => $request->buyer,
                'area'                 => $request->area,
                'status'               => 0,    
                'consumer'             => $request->consumer,
                'created_by'           => auth()->id(),
                'created_at'           => now(),
            ]);
            return redirect()->route('lead-analysis.index')->with('success','Lead Analysis create successfully');
        }
    }

    public function edit(string $id)
    {
        $title = 'Lead Analysis Entry';
        $user_id   = Auth::user()->id; 
        $my_all_employee = my_all_employee($user_id);
        $cstmrs             = Lead::where('status',0)->where('approve_by','!=',null)->whereHas('customer',function($q) use($my_all_employee){
                                    $q->whereIn('ref_id',$my_all_employee);
                                })->get();

        $projects = Project::where('status',1)->select('id','name')->get();
        $units          = Unit::select('id','title')->get();
        $religions = $this->religion();
        $lead_analysis = LeadAnalysis::find($id);
        return view('lead_analysis.lead_analysis_save',compact('title','cstmrs','projects','units','religions','lead_analysis'));
    }

    public function leadAnalysisDelete($id){
        try{ 
            $data  = LeadAnalysis::find($id);
            $data->delete();
            return response()->json(['success' => 'Lead Analysis Deleted'],200);
        }catch(Exception $e){
            return response()->json(['error' => $e->getMessage()],500);
        }
    }

    public function getCustomerReligion($customerId)
    {
        $customer = Customer::findOrFail($customerId);
        $religionId = $customer->user->religion;
        $religionName = isset(Religion::values()[$religionId]) ? Religion::values()[$religionId] : 'Unknown';


        return response()->json(['religions' => [$religionId => $religionName]]);
    }

    public function leadAnalysisApprove(){ 
        $user_id        = Auth::user()->id; 
        $my_employee    = my_employee($user_id);
        $leads          = LeadAnalysis::where('approve_by', null)->whereIn('employee_id',$my_employee)->orderBy('id','desc')->get(); 
        return view('lead_analysis.lead_analysis_approve', compact('leads'));
    }

    public function leadAnalysisApproveSave(Request $request) {
        if($request->has('lead_id') && $request->lead_id !== '' & $request->lead_id !== null) {
            DB::beginTransaction();
            try {
                foreach ($request->lead_id as $key => $lead_id) {
                    $lead = LeadAnalysis::where('id',$lead_id)->first();
                    $lead->approve_by = Auth::user()->id;
                    $lead->save();
                }
                DB::commit();
                return redirect()->route('lead-analysis.approve')->with('success', 'Status Updated Successfully');
            } catch (Exception $e) {
                DB::rollback();
                return redirect()->back()->withInput()->with('error', $e->getMessage());
            }
            
        } else {
            return redirect()->route('lead-analysis.approve')->with('error', 'Something went wrong!');
        }

    }
}
