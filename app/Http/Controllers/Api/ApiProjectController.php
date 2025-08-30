<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\ProjectTeam;
use App\Models\WorkTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApiProjectController extends Controller
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

        return success_response($my_projects, 'Projects fetched successfully.');
        
    }
    
    public function projectDetails($id)
    {
        $project = Project::with(['customer', 'tasks.workTimes'])->findOrFail($id);

        $totalTasks = $project->tasks->count();
        $completedTasks = $project->tasks->where('status', 1)->count();
        $remainingTasks = $totalTasks - $completedTasks;
        $completionPercent = $totalTasks > 0 ? round(($completedTasks / $totalTasks) * 100, 2) : 0;

        // Total estimated & spent in hours
        $totalEstimated = $project->tasks->sum('estimated_time'); // if DB in minutes, divide by 60
        $totalSpent = $project->tasks->sum('time_spent');         // if DB in minutes, divide by 60

        // Convert minutes to hours if necessary
        $totalEstimated = $totalEstimated / 60;
        $totalSpent = $totalSpent / 60;

        $extraTimeUsed = $totalSpent - $totalEstimated;

        $remainingEstimated = $project->tasks->where('status', '!=', 1)->sum('estimated_time') / 60;
        $daysLeft = $project->submit_date ? now()->diffInDays($project->submit_date, false) : 0;

        // Last 7 days actual worked hours
        $last7Minutes = $project->workTimes()
            ->where('start_time', '>=', now()->subDays(7))
            ->sum('duration'); // minutes
        $avgHoursPerDay = ($last7Minutes / 60) / 7;

        $possibleWorkHours = $avgHoursPerDay * $daysLeft;
        $forecastExtraTimeNeeded = $possibleWorkHours < $remainingEstimated
            ? $remainingEstimated - $possibleWorkHours
            : 0;

        // Progress tracking
        $daysPassed = now()->diffInDays($project->created_at);
        $totalDays = $project->submit_date ? $project->created_at->diffInDays($project->submit_date) : null;
        $expectedProgress = $totalDays > 0 ? round(($daysPassed / $totalDays) * 100, 2) : null;

        $possibleToCoverBacklog = ($avgHoursPerDay > 0 && $daysLeft > 0)
            ? ($avgHoursPerDay * $daysLeft >= $remainingEstimated)
            : null;

        $projectInfo = [
            'customer_name' => $project->customer->name ?? null,
            'project_title' => $project->title,
            'created_date' => $project->created_at->toDateString(),
            'submit_date' => $project->submit_date,
            'project_status' => $project->project_status == 0 ? 'Running' : 'Completed',
            'remark' => $project->remark,

            'total_tasks' => $totalTasks,
            'completed_tasks' => $completedTasks,
            'remaining_tasks' => $remainingTasks,
            'task_completion_percent' => $completionPercent,

            'total_estimated_hours' => round($totalEstimated, 2),
            'total_spent_hours' => round($totalSpent, 2),
            'extra_time_used' => round($extraTimeUsed, 2),
            'forecast_extra_time_needed' => round($forecastExtraTimeNeeded, 2),

            'expected_progress_till_today' => $expectedProgress,
            'on_track' => $expectedProgress ? $completionPercent >= $expectedProgress : null,
            'forecast_completion_possible' => $possibleToCoverBacklog,
        ];

        return success_response($projectInfo, 'Project details fetched successfully.'); 
    }

    // ---------------- Team Summary ----------------
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

    // ---------------- Task Summary ----------------
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
