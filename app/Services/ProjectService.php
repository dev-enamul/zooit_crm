<?php

namespace App\Services;

use App\Models\Project;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class ProjectService
{
    public function getProjectDetailsForCharts(Project $project)
    {
        $user = Auth::user();

        // Leader check
        $teamRecord = $project->projectTeams()->where('user_id', $user->id)->first();
        $isLeader = $teamRecord && $teamRecord->is_leader;

        // Tasks filter
        $tasks = $this->getTasksByRole($project, $user->id, $isLeader);

        // Basic project info
        $basicInfo = [
            'customer_name'  => $project->customer->name ?? null,
            'project_title'  => $project->title,
            'created_date'   => get_date($project->created_at),
            'submit_date'    => get_date($project->submit_date),
            'project_status' => $project->project_status == 0 ? 'Running' : 'Completed',
            'remark'         => $project->remark,
        ];

        // Charts
        $chartProgress = $this->calculateProgressLine($project, $tasks);
        $chartPie      = $this->calculatePieData($project, $tasks);
        $chartLast7    = $this->calculateLast7Days($tasks);
        $chartNext7    = $this->calculateNext7Days($project, $tasks);

        return array_merge($basicInfo, [
            'chart_progress' => $chartProgress,
            'chart_pie'      => $chartPie,
            'chart_last7'    => $chartLast7,
            'chart_next7'    => $chartNext7,
        ]);
    }

    protected function getTasksByRole(Project $project, $userId, $isLeader)
    {
        return $isLeader
            ? $project->tasks
            : $project->tasks->filter(fn($t) => $t->assign_to == $userId);
    }

    // Progress line (extra hours already spent)
    protected function calculateProgressLine(Project $project, $tasks)
    {
        $start = Carbon::parse($project->created_at);
        $end   = Carbon::parse($project->submit_date);

        $totalEstimated = $tasks->sum('estimated_time') / 60;
        $totalActual    = $tasks->where('status', 1)->sum('actual_time') / 60;
        $extraHours     = max(0, $totalActual - $totalEstimated);

        $points = [];
        $interval = 7;
        $days = $start->diffInDays($end);
        $days = $days > 0 ? $days : 1;

        for ($i = 0; $i <= $days; $i += $interval) {
            $date = $start->copy()->addDays($i);
            if ($date > $end) $date = $end;

            $expectedHours = ($i / $days) * $totalEstimated;
            $expectedPercent = $totalEstimated > 0 ? ($expectedHours / $totalEstimated) * 100 : 0;

            $actualHours = ($i / $days) * $totalActual;
            $actualPercent = $totalEstimated > 0 ? ($actualHours / $totalEstimated) * 100 : 0;

            $points[] = [
                'date' => get_date($date),
                'expected_hours' => round($expectedHours, 2),
                'expected_percent' => round($expectedPercent, 2),
                'actual_hours' => round($actualHours, 2),
                'actual_percent' => round($actualPercent, 2),
                'extra_hours' => round($extraHours * ($i / $days), 2),
            ];
        }

        return $points;
    }

    // Pie chart including expected completed hours
    protected function calculatePieData(Project $project, $tasks)
    {
        $plannedHours   = $tasks->sum('estimated_time') / 60;
        $completedHours = $tasks->where('status', 1)->sum('estimated_time') / 60;
        $actualHours    = $tasks->where('status', 1)->sum('actual_time') / 60;
        $extraHours     = max(0, $actualHours - $completedHours);
        $remainingHours = $tasks->where('status','!=',1)->sum('estimated_time') / 60;

        // expected completed hours until today
        $start = Carbon::parse($project->created_at);
        $end   = Carbon::parse($project->submit_date);
        $totalDays = $start->diffInDays($end);
        $passedDays = $start->diffInDays(now());
        $progressRatio = $totalDays > 0 ? ($passedDays / $totalDays) : 0;
        $expectedCompleted = $plannedHours * $progressRatio;

        return [
            'planned_hours' => round($plannedHours, 2),
            'completed_hours' => round($completedHours, 2),
            'remaining_hours' => round($remainingHours, 2),
            'extra_hours' => round($extraHours, 2),
            'expected_completed_hours' => round($expectedCompleted, 2),
        ];
    }

    // Last 7 days (currently total actual, can improve with daily work log if available)
    protected function calculateLast7Days($tasks)
    {
        $last7 = [];
        $totalActual = $tasks->where('status',1)->sum('actual_time') / 60;
        $perDayTarget = $totalActual / 7;

        for ($i = 6; $i >= 0; $i--) {
            $day = now()->subDays($i);
            $completedToday = $tasks->where('status',1)->sum('actual_time') / 60;

            $last7[] = [
                'date' => get_date($day),
                'target_hours' => round($perDayTarget, 2),
                'actual_hours' => round($completedToday, 2),
            ];
        }

        return $last7;
    }

    // Next 7 days target (future estimation, Friday off)
    protected function calculateNext7Days(Project $project, $tasks)
    {
        $remainingEstimated = $tasks->where('status','!=',1)->sum('estimated_time') / 60;

        // ratio based future extra prediction
        $totalEstimatedCompleted = $tasks->where('status',1)->sum('estimated_time') / 60;
        $totalActualCompleted    = $tasks->where('status',1)->sum('actual_time') / 60;
        $ratio = ($totalEstimatedCompleted > 0) ? ($totalActualCompleted / $totalEstimatedCompleted) : 1;

        $futureExtra = ($remainingEstimated * $ratio) - $remainingEstimated;
        $remainingTotal = $remainingEstimated + max(0, $futureExtra);

        // next 7 days with Friday off
        $next7 = [];
        $workingDays = 0;

        // count working days (excluding Friday)
        for ($i = 1; $i <= 7; $i++) {
            $date = now()->addDays($i);
            if ($date->isFriday()) continue;
            $workingDays++;
        }

        $perDayTarget = $workingDays > 0 ? $remainingTotal / $workingDays : 0;

        for ($i = 1; $i <= 7; $i++) {
            $date = now()->addDays($i);
            $target = $date->isFriday() ? 0 : $perDayTarget;

            $next7[] = [
                'date' => get_date($date),
                'target_hours' => round($target, 2),
            ];
        }

        return $next7;
    }
}
