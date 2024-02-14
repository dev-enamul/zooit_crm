<?php

namespace App\Http\Controllers;

use App\Enums\Religion;
use App\Models\Customer;
use App\Models\Project;
use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LeadAnalysisController extends Controller
{

    public function index()
    {
        return view('lead_analysis.lead_analysis_list');
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
        $customers = Customer::whereIn('ref_id', $my_all_employee)->get();
        $projects = Project::where('status',1)->select('id','name')->get();
        $units          = Unit::select('id','title')->get();
        $religions = $this->religion();
        return view('lead_analysis.lead_analysis_save',compact('title','customers','projects','units','religions'));
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


    public function update(Request $request, string $id)
    {
        //
    }


    public function destroy(string $id)
    {
        //
    }
}
