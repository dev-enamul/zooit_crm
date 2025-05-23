<?php

namespace App\Http\Controllers;

use App\Enums\Priority;
use App\Enums\UnitFacility;
use App\Models\ApproveSetting;
use App\Models\Customer;
use App\Models\FollowUp;
use App\Models\Negotiation;
use App\Models\NegotiationAnalysis;
use App\Models\Notification;
use App\Models\Project;
use App\Models\ProjectProposal;
use App\Models\ProjectUnit;
use App\Models\Rejection;
use App\Models\Salse;
use App\Models\Unit;
use App\Models\UnitCategory;
use App\Models\UnitPrice;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class SalseController extends Controller
{ 
    public function index()
    {
        $my_all_employee = json_decode(Auth::user()->user_employee);
        $datas = Customer::whereNotNull('customer_id')->get(); 
        return view('salse.salse_list',compact('datas'));
    } 

    public function create(Request $request)
    {
        $title  = 'Sales Entry'; 
        $selected_data = [];
        if ($request->has('customer')) {
            $selected_data['customer'] = Customer::find($request->customer);
        } 
        return view('salse.salse_save',compact('selected_data'));
    }

    public function store(Request $request)
    {
        $rules = [
            'customer' => 'required|exists:customers,id', 
            'price' => 'required|numeric|min:0',
            'submit_date' => 'required|date', 
            'remark' => 'nullable|string|max:255',
        ];

        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator)->with('error', $validator->errors()->first());
        }

        $customer = Customer::find($request->customer);
        $followups = FollowUp::where('customer_id',$customer->id)->get();
        $project_proposal = ProjectProposal::where('customer_id',$customer->id)->where('is_active',true)->first();
        $customer->status = 1;
        $customer->customer_id = User::generateNextCustomerId();
        $customer->save();
        foreach($followups as $followup){
            $followup->status = 1;
            $followup->save();
        }  

        $project = new Project();
        $project->customer_id = $customer->id;
        $project->project_proposal_id = $project_proposal->id??null;
        $project->sales_by = Auth::user()->id;
        $project->price = $request->price;
        $project->submit_date = $request->submit_date;  
        $project->project_status = 0;
        $project->status = 1;
        $project->remark = $request->remark; 
        $project->save();  

         // update table data 
         if($project){
            $customer = Customer::find($request->customer);
            if($customer){
                $customer->status =1;
                $customer->save(); 
            }
            
            $followups = FollowUp::where('customer_id', $customer->id)->get(); 
            foreach($followups as $followup){
                $followup->status=1;
                $followup->save();
            }   

            $rejection = Rejection::where('customer_id', $customer->id)->first();
            if($rejection){
                $rejection->status = 1;
                $rejection->save(); 
            } 
        }

        return redirect()->route('salse.index')->with('success', 'Project created successfully.');
    }
   
}
