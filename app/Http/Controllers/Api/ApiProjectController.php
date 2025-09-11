<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\ProjectTeam;
use App\Models\WorkTime;
use App\Services\ProjectService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ApiProjectController extends Controller
{
    public function projects()
    {
        $my_projects = ProjectTeam::with(['project.customer.user', 'project.tasks'])
            ->where('user_id', Auth::user()->id)
            ->get()
            ->map(function($team) {
                $project = $team->project;
                if (!$project) return null;

                $tasks = $project->tasks;
 
                $totalEstimated = $tasks->sum('estimated_time') / 60; // convert minutes to hours
 
                $completedHours = $tasks->where('status', 1)->sum('estimated_time') / 60;
 
                $actualProgress = $totalEstimated > 0 ? ($completedHours / $totalEstimated) * 100 : 0;
 
                $start = Carbon::parse($project->created_at);
                $end   = Carbon::parse($project->submit_date ?? now());
                $totalDays = max($start->diffInDays($end), 1);
                $daysPassed = $start->diffInDays(now());
                $expectedProgress = ($daysPassed / $totalDays) * 100;

                // Clamp values between 0-100
                $actualProgress = min(max($actualProgress, 0), 100);
                $expectedProgress = min(max($expectedProgress, 0), 100);

                return [
                    'project_id'           => $project->id,
                    'title'                => $project->title,
                    'customer_name'        => $project->customer->user->name ?? null,
                    'project_status'       => $project->project_status == 0 ? 'Running' : 'Complete',
                    'submit_date'          => get_date($project->submit_date),
                    'created_at'           => get_date($project->created_at),
                    'is_leader'            => $team->is_leader, 
                    'completed_hours'      => round($completedHours),
                    'estimated_hour'      => round($totalEstimated),
                    'actual_progress'      => round($actualProgress, 2),
                    'expected_progress'    => round($expectedProgress, 2),
                ];
            })
            ->filter();

        return success_response($my_projects, 'Projects fetched successfully.');
    }

    public function projectDetails($id, ProjectService $service)
    {
        $project = Project::with(['tasks.workTimes', 'projectTeams', 'customer'])->findOrFail($id);
        $data = $service->getProjectDetailsForCharts($project); 
        return success_response($data, 'Project details fetched successfully.');
    } 

 
    public function projectTeamDetails($id)
    {
        $project = Project::with(['tasks', 'projectTeams.user'])->findOrFail($id);
        $daysLeft = $project->submit_date ? now()->diffInDays($project->submit_date, false) : 0;

        $teamInfo = $project->projectTeams->map(function ($member) use ($project, $daysLeft) {
            $tasks = $project->tasks->where('assign_to', $member->user_id);

            $completed = $tasks->where('status', 1)->count();
            $remaining = $tasks->count() - $completed;

            $onTime = $tasks->filter(fn($t) => $t->time_spent && $t->time_spent <= $t->estimated_time)->count();
            $late = $completed - $onTime;

            $remainingEstimated = $tasks->where('status', '!=', 1)->sum('estimated_time') / 60;

            // Last 7 days worked hours for this member
            $last7Minutes = WorkTime::where('user_id', $member->user_id)
                ->where('project_id', $project->id)
                ->where('start_time', '>=', now()->subDays(7))
                ->sum('duration');
            $avgHoursPerDay = ($last7Minutes / 60) / 7;
            $possibleWorkHours = $avgHoursPerDay * $daysLeft;

            $possibleToCoverBacklog = ($avgHoursPerDay > 0 && $daysLeft > 0)
                ? ($avgHoursPerDay * $daysLeft >= $remainingEstimated)
                : null;

            $forecastExtra = $possibleWorkHours < $remainingEstimated
                ? $remainingEstimated - $possibleWorkHours
                : 0;

            return [
                'member_name' => $member->user->name,
                'total_tasks' => $tasks->count(),
                'completed_tasks' => $completed,
                'remaining_tasks' => $remaining,
                'on_time_tasks' => $onTime,
                'late_tasks' => $late,
                'possible_to_cover_backlog' => $possibleToCoverBacklog,
                'forecast_extra_time_needed' => round($forecastExtra, 2),
            ];
        });

        return success_response($teamInfo, 'Team details fetched successfully.');  
    }
 
    public function projectTaskDetails($id)
    {
        $project = Project::with('tasks')->findOrFail($id);

        $taskInfo = $project->tasks->map(function ($task) {
            $completedInTime = $task->status == 1 && $task->time_spent && $task->time_spent <= $task->estimated_time;

            return [
                'task_name' => $task->title,
                'status' => match($task->status) {
                    0 => 'Pending',
                    1 => 'Completed',
                    2 => 'In Progress',
                },
                'estimated_time_hours' => round($task->estimated_time / 60, 2),
                'time_spent_hours' => $task->time_spent ? round($task->time_spent / 60, 2) : 0,
                'completed_in_time' => $completedInTime,
                'submit_time' => $task->submit_time,
            ];
        });

        return success_response($taskInfo, 'Task details fetched successfully.'); 
    }
}
