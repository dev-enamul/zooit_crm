<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Project;
use App\Models\ProjectTeam;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProjectTeamController extends Controller
{
    public function show($id)
    { 
        $id = decrypt($id); 
        $project = DB::table('projects')
            ->join('customers', 'projects.customer_id', '=', 'customers.id')
            ->join('users', 'customers.user_id', '=', 'users.id')
            ->where('customers.id', $id)
            ->select('projects.id as id', 'users.name as customer_name')
            ->first();   
        $employees = User::where('user_type', 1)->where('status', 1)->get();
        $datas = ProjectTeam::with(['user'])
            ->where('project_id', $project->id)
            ->get()
            ->map(function($data) {
                return [
                    'id'            => $data->id, 
                    'name'          => $data->user->name ?? null,
                    'role'          => $data->role,
                    'is_leader'     => $data->is_leader,
                    'remark'        => $data->remark,
                ];
            });
 
        return view('team.team_list', compact('project', 'employees', 'datas'));
     
    }

    /**
     * Store a newly created project team.
     */
    public function store(Request $request)
    {  
        $validated = $request->validate([
            'project_id' => 'required|exists:projects,id',
            'user_id'    => 'required|exists:users,id',
            'role'       => 'nullable|string|max:255',
            'is_leader'  => 'boolean', 
            'remark'     => 'nullable|string',
        ]);
      
 
        $existingMember = ProjectTeam::where('project_id', $validated['project_id'])
            ->where('user_id', $validated['user_id'])
            ->first();
        if ($existingMember) {
            return redirect()->back()->with('error', 'This user is already a member of the project.');
        }
        ProjectTeam::create($validated);  
        return redirect()->back()->with('success', 'Project team member added successfully.');
    }

    /**
     * Display the specified project team.
     */
  

    /**
     * Update the specified project team.
     */
    public function update(Request $request, $id)
    {
        $team = ProjectTeam::findOrFail($id);

        $validated = $request->validate([
            'role'      => 'nullable|string|max:255',
            'is_leader' => 'boolean',
            'status'    => 'in:0,1',
            'remark'    => 'nullable|string',
        ]);

        $team->update($validated);

        return response()->json([
            'message' => 'Project team member updated successfully',
            'data'    => $team
        ]);
    }

    /**
     * Remove the specified project team.
     */
    public function destroy($id)
    {
        $team = ProjectTeam::findOrFail($id);
        $team->delete();

        return response()->json(['success' => 'Customer Deleted'], 200);
    }
}
