<?php

namespace App\Http\Controllers;

use App\Enums\Priority;
use App\Enums\UnitFacility;
use App\Models\Negotiation;
use App\Models\NegotiationAnalysis;
use App\Models\Project;
use App\Models\ProjectUnit;
use App\Models\Unit;
use App\Models\UnitPrice;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SalseController extends Controller
{
    public function priority()
    {
        return Priority::values();
    }

    public function facility()
    {
        return UnitFacility::values();
    }

    public function index()
    {
        return view('salse.salse_list');
    }

    public function create(Request $request)
    {
        $title              = 'Sales Entry';
        $user_id            = Auth::user()->id; 
        $my_all_employee    = my_all_employee($user_id);
        $customers          = Negotiation::where('status',0)->where('approve_by','!=',null)->whereHas('customer',function($q) use($my_all_employee){
                                    $q->whereIn('ref_id',$my_all_employee);
                                })->get();
        $projects           = Project::where('status',1)->get(['name', 'id']);
        $projectUnits       = ProjectUnit::where('status', 1)->get(['name', 'id']);
        $employees          = User::whereIn('id', $my_all_employee)->get();
        $priorities         = $this->priority();
        $facilities         = $this->facility();
        $units              = Unit::all();
        $unit_prices        = UnitPrice::all();
        
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
            $selected_data['payment_duration'] = UnitPrice::find($neg_project->payment_duration);
            $selected_data['select_type']   = $neg_project->select_type;
            $selected_data['project_units'] = json_decode($neg_project->project_units);
            #$selected_data['regular_amount'] = json_decode($neg_project->project_units);
            $u_id= Unit::find($neg_project->unit_id);
            $selected_data['booking']  = $u_id->booking;
            $selected_data['down_payment']  = $u_id->down_payment;
            

            if (!is_array($selected_data['project_units'])) {
                $selected_data['project_units'] = [];
            }
        }

        return view('salse.salse_save', compact('facilities','unit_prices','units','selected_data','priorities','projects','projectUnits','customers','employees'));
    }

    public function store(Request $request)
    {
        //
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        //
    }

}
