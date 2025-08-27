<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\ProjectTeam;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ApiTaskController extends Controller
{
    public function projects()
    {
        $my_projects = ProjectTeam::with(['project.customer.user'])
            ->where('user_id', Auth::user()->id)
            ->get()
            ->map(function($team) {
                $project = $team->project;
                if (!$project) return null;

                return [
                    'project_id'     => $project->id,
                    'customer_name'  => $project->customer->user->name ?? null,
                    'project_status' => $project->project_status == 0 ? 'Running' : 'Complete',
                    'submit_date'    => $project->submit_date ?? null, 
                ];
            })
            ->filter();

        return response()->json([
            'success' => true,
            'data'    => $my_projects
        ]);
    }

    public function index(Request $request)
    {
        $query = Task::select(
            'id',
            'project_id',
            'title',
            'description',
            'priority',
            'estimated_time',
            'time_spent',
            'assign_by',
            'status'
        )
        ->where('assign_to', Auth::user()->id); 
        if ($request->has('project_id') && !empty($request->project_id)) {
            $query->where('project_id', $request->project_id);
        }

        $tasks = $query->orderByDesc('priority')->get()
            ->map(function($task) {
                $priorityMap = [
                    0 => 'Low',
                    1 => 'Medium',
                    2 => 'High',
                    3 => 'Urgent',
                    4 => 'Fire Urgent',
                ];

                $statusMap = [
                    0 => 'Pending',
                    1 => 'Completed',
                    2 => 'In Progress',
                ];

                return [
                    'id'             => $task->id,
                    'project_id'     => $task->project_id,
                    'title'          => $task->title,
                    'description'    => $task->description,
                    'priority'       => $priorityMap[$task->priority] ?? 'Unknown',
                    'estimated_time' => $task->estimated_time,
                    'time_spent'     => $task->time_spent,
                    'assign_by'      => $task->assign_by,
                    'status'         => $statusMap[$task->status] ?? 'Unknown',
                ];
            });

        return success_response($tasks, 'Tasks fetched successfully.');
    } 
 
    public function store(Request $request)
    {
        $data = $request->all();  
        if (!is_array($data) || empty($data)) {
            return error_response(null, 422, 'Invalid input format, array expected');
        }

        $rules = [
            '*.project_id'     => 'nullable|exists:projects,id',
            '*.title'          => 'required|string|max:255',
            '*.description'    => 'nullable|string',
            '*.priority'       => 'integer|min:0|max:4',
            '*.estimated_time' => 'nullable|integer|min:0',
            '*.time_spent'     => 'nullable|integer|min:0',
            '*.assign_to'      => 'nullable|exists:users,id', 
            '*.submit_time'    => 'nullable|date',
            '*.status'         => 'integer|min:0|max:2',
        ];

        $validator = Validator::make($data, $rules);

        if ($validator->fails()) {
            return error_response($validator->errors(), 422, 'Validation failed');
        } 
        $validated = $validator->validated(); 
        $now = now();
        foreach ($validated as &$task) {
            $task['created_at'] = $now;
            $task['updated_at'] = $now;
            $task['assign_by'] = Auth::user()->id;
        } 
        Task::insert($validated); 
        return success_response(null, 'Tasks created successfully.', 201);
    }

  
    public function update(Request $request, $id)
    {
        $task = Task::find($id);

        if (!$task) {
            return error_response(null, 404, 'Task not found.');
        }

        $validator = Validator::make($request->all(), [
            'project_id'     => 'nullable|exists:projects,id',
            'title'          => 'sometimes|required|string|max:255',
            'description'    => 'nullable|string',
            'priority'       => 'integer|min:0|max:4',
            'estimated_time' => 'nullable|integer|min:0',
            'time_spent'     => 'nullable|integer|min:0',
            'assign_to'      => 'nullable|exists:users,id',
            'assign_by'      => 'nullable|exists:users,id',
            'submit_time'    => 'nullable|date',
            'status'         => 'integer|min:0|max:2',
        ]);

        if ($validator->fails()) {
            return error_response($validator->errors(), 422, 'Validation failed');
        }

        $task->update($validator->validated());

        return success_response($task, 'Task updated successfully.');
    }

 
    public function destroy($id)
    {
        $task = Task::find($id);

        if (!$task) {
            return error_response(null, 404, 'Task not found.');
        }

        $task->delete();

        return success_response(null, 'Task deleted successfully.');
    }
}
