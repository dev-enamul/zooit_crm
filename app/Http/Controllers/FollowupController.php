<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\ProjectUnit;
use App\Models\Unit;
use App\Models\UnitPrice;
use Exception;
use Illuminate\Http\Request;

class FollowupController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('followup.followup_list');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $projects = Project::where('status',1)->get(['name', 'id']);
        $projectUnits = ProjectUnit::where('status', 1)->get(['name', 'id']);
        return view('followup.followup_save',compact('projects','projectUnits'));
    }
    
    public function projectDurationTypeName(Request $request)
    {
        try {
            $project = Project::find($request->id);
            
            if (!$project) {
                throw new Exception("Project not found");
            }
    
            $unit_type = Unit::where('status', 1)->get(['title', 'id']);
            $project_unit = ProjectUnit::where('project_id', $project->id)->first();
            $payment_durations = UnitPrice::where('project_unit_id', $project_unit->id)->get();

            $formatted_payment_durations = $payment_durations->map(function ($payment_duration) {
                return [
                    'id' => $payment_duration->id,
                    'payment_duration' => $payment_duration->payment_duration,
                    'on_choice_price' => $payment_duration->on_choice_price,
                    'lottery_price' => $payment_duration->lottery_price,
                ];
            });
    
            $response_data = [
                'unit_type' => $unit_type,
                'project_unit' => $project_unit,
                'payment_duration' => $formatted_payment_durations,
            ];
    
            return response()->json($response_data);
        } catch (Exception $e) {
            return response()->json(["error" => $e->getMessage()], 404);
        }
    }
    

}
