<?php

namespace App\Http\Controllers;

use App\Enums\Priority;
use App\Enums\UnitFacility;
use App\Models\Customer;
use App\Models\NegotiationAnalysis;
use App\Models\Project;
use App\Models\ProjectUnit;
use App\Models\Unit;
use App\Models\UnitCategory;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExistingSalseController extends Controller
{
    public function priority()
    {
        return Priority::values();
    }

    public function facility()
    {
        return UnitFacility::values();
    }
    
    public function create(Request $request)
    {
        $title              = 'Sales Entry';
        $user_id            = Auth::user()->id; 
        $my_all_employee    = my_all_employee($user_id);
        $is_admin = Auth::user()->hasPermission('admin'); 
        if($is_admin){
            $customers = Customer::whereDoesntHave('salse')->select('id','customer_id','name')->get();
        }else{
            $customers          = NegotiationAnalysis::where('status',0)->where('approve_by','!=',null)->whereHas('customer',function($q) use($my_all_employee){
                $q->whereIn('ref_id',$my_all_employee);
            })->get();
            $customers = $customers->customer->select('id','customer_id','name');
        } 

        $projects           = Project::where('status',1)->get(['name', 'id']);
        $projectUnits       = ProjectUnit::where('status', 1)->get(['name', 'id']);
        $employees          = User::whereIn('id', $my_all_employee)->get();
        $priorities         = $this->priority();
        $facilities         = $this->facility();
        $units              = Unit::all(); 
        $unit_categories    = UnitCategory::all();
        
        $selected_data = 
        [
            'employee' => Auth::user()->id,
            'priority' => Priority::Regular,
        ];
        
        if ($request->has('customer')) {
            $selected_data['customer'] = $request->customer;

            $neg_project = NegotiationAnalysis::where('customer_id',$request->customer)->first();

            $selected_data['project'] = $neg_project->project_id;
            $selected_data['unit']  = $neg_project->unit_id; 
            $selected_data['select_type']   = 2;
            $selected_data['project_units'] = json_decode($neg_project->project_units); 
            $u_id= Unit::find($neg_project->unit_id);
            $selected_data['booking']  = $u_id->booking;
            $selected_data['down_payment']  = $u_id->down_payment; 

            if (!is_array($selected_data['project_units'])) {
                $selected_data['project_units'] = [];
            }
        }

        return view('salse.existing_salse_save', compact([
            'facilities', 
            'units',
            'selected_data',
            'priorities',
            'projects',
            'projectUnits',
            'customers',
            'employees',
            'unit_categories'
        ]));
    }
}
