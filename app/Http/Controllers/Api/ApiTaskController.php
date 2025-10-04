<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\ProjectTeam;
use App\Models\Task;
use App\Models\User;
use App\Traits\PaginateTrait;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ApiTaskController extends Controller
{ 
    use PaginateTrait;

    public function index(Request $request)
    {
        $userId = Auth::id(); 

        $query = Task::with('project.projectTeams')
            ->select(
                'tasks.id',
                'tasks.project_id',
                'tasks.title',
                'tasks.description',
                'tasks.priority',
                'tasks.estimated_time',
                'tasks.time_spent',
                'tasks.assign_by',
                'tasks.assign_to',
                'tasks.status',
                'tasks.submit_time'
            )
            ->where(function($q) use ($userId) { 
                $q->where('assign_to', $userId) 
                  ->orWhere('assign_by', $userId) 
                  ->orWhereHas('project', function($projectQuery) use ($userId) {
                      $projectQuery->whereHas('projectTeams', function($teamQuery) use ($userId) {
                          $teamQuery->where('user_id', $userId)
                                    ->where('is_leader', true);
                      });
                  });
            });

        // 🔹 Filter by project
        if ($request->has('project_filter')) {
            if ($request->project_filter === 'without_project') {
                $query->whereNull('project_id');
            } elseif ($request->project_filter !== null) {
                $query->where('project_id', $request->project_filter);
            } 
        }

        // 🔹 Select only fields for dropdown
        if ($request->has('select_field') && $request->select_field) {
            $tasks = $query->select('id', 'title')
                        ->whereIn('status', [0,2])
                        ->get(); 
            return success_response($tasks, 'Tasks fetched successfully.');
        }

        // 🔹 Filter by status
        if ($request->has('status') && $request->status !== null) {
            $query->where('status', $request->status);
        }

        // 🔹 Filter by assign_by
        if ($request->has('assign_by') && $request->assign_by !== null) {
            $query->where('assign_by', $request->assign_by);
        } 

        // 🔹 Filter by assign_to
        if ($request->has('assign_to') && $request->assign_to !== null) {
            $query->where('assign_to', $request->assign_to);
        }

        // 🔹 Keyword search
        if ($request->has('keyword') && !empty($request->keyword)) {
            $keyword = $request->keyword;
            $query->where(function($q2) use ($keyword) {
                $q2->where('title', 'LIKE', "%{$keyword}%")
                   ->orWhere('description', 'LIKE', "%{$keyword}%");
            });
        }

        // ✅ Pagination
        $paginated = $this->paginateQuery($query->orderByDesc('priority'), $request);

        // Transform data
        $data = collect($paginated['data'])->map(function($task) use ($userId) { 
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

            // চেক ইউজার কি টিম লিডার ওই প্রজেক্টে
            $canManage = ($task->project 
                    && $task->project->projectTeams
                        ->where('user_id', $userId)
                        ->where('is_leader', true)
                        ->count() > 0)
                || $task->assign_by == $userId;

            return [
                'id'             => $task->id,
                'project_id'     => $task->project_id,
                'project'        => $task->project ? $task->project->title : null,
                'title'          => $task->title,
                'description'    => $task->description,
                'priority'       => $priorityMap[$task->priority] ?? 'Unknown',
                'priority_id'    => $task->priority,
                'estimated_time' => $task->estimated_time,
                'time_spent'     => $task->time_spent,
                'assign_by'      => $task->assign_by,
                'assign_to'      => $task->assign_to,
                'submit_time'    => $task->submit_time,
                'status'         => $statusMap[$task->status] ?? 'Unknown',
                'canManage'      => $canManage,
            ];
        })->values();

        return success_response([
            'data' => $data,
            'meta' => $paginated['meta']
        ], 'Tasks fetched successfully.');
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

        $rules = [
            'project_id'     => 'nullable|exists:projects,id',
            'title'          => 'sometimes|required|string|max:255',
            'description'    => 'nullable|string',
            'priority'       => 'integer|min:0|max:4',
            'estimated_time' => 'nullable|integer|min:0',
            'time_spent'     => 'nullable|integer|min:0',
            'assign_to'      => 'nullable|exists:users,id',
            'assign_by'      => 'nullable|exists:users,id',
            'submit_time'    => 'nullable|date',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return error_response($validator->errors(), 422, 'Validation failed');
        }
 
        $validatedData = $request->only(array_keys($rules));

        $task->update($validatedData);

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

    public function completedTask(Request $request)
    {
        $taskIds = $request->task_ids;   
        if (!$taskIds || !is_array($taskIds) || count($taskIds) === 0) {
            return error_response(null, 400, 'No task IDs provided.');
        } 
        $tasks = Task::whereIn('id', $taskIds)->get(); 
        if ($tasks->isEmpty()) {
            return error_response(null, 404, 'No tasks found for the given IDs.');
        } 
        $now = Carbon::now(); 
        Task::whereIn('id', $taskIds)->update([
            'status' => 1,
            'submit_time' => $now,
        ]);

        return success_response(null, 'Tasks marked as completed successfully.');
    }

    public function assignTask(Request $request)
    {
        $taskIds = $request->task_ids; // array of task IDs
        $employeeId = $request->employee_id; // single employee ID

        // Validate input
        if (!$taskIds || !is_array($taskIds) || count($taskIds) === 0) {
            return error_response(null, 400, 'No task IDs provided.');
        }

        if (!$employeeId) {
            return error_response(null, 400, 'No employee ID provided.');
        }

        $tasks = Task::whereIn('id', $taskIds)->get();

        if ($tasks->isEmpty()) {
            return error_response(null, 404, 'No tasks found for the given IDs.');
        }

        // Update assign_to for all selected tasks
        Task::whereIn('id', $taskIds)->update([
            'assign_to' => $employeeId,
        ]);

        return success_response(null, 'Tasks assigned successfully.');
    }


}
