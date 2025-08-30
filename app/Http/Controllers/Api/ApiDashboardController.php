<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Task;
use App\Models\User;
use App\Models\WorkTime;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;

class ApiDashboardController extends Controller
{
    public function todayActivity()
    {
        $user = User::find(auth()->id());
        $today = now()->toDateString();

        $activities = $user->workTimes()
            ->whereDate('created_at', $today) // created_at দিয়ে filter
            ->latest('created_at')
            ->with(['project', 'task'])
            ->get()
            ->map(function($workTime) {
                $duration = $workTime->duration ?? 0;
                $hours = floor($duration / 60);
                $minutes = $duration % 60;
                $formattedDuration = sprintf("%02d:%02d", $hours, $minutes);

                return [
                    'project'    => $workTime->project ? $workTime->project->title : null,
                    'task'       => $workTime->task ? $workTime->task->title : null,
                    'start_time' => $workTime->start_time,
                    'end_time'   => $workTime->end_time,
                    'duration'   => $formattedDuration, // H:M format
                    'note'       => $workTime->note,
                ];
            });

        // Calculate total minutes from today's created data
        $totalMinutes = $user->workTimes()
        ->whereDate('created_at', $today)
        ->sum('duration');

        $hours = floor($totalMinutes / 60);
        $minutes = $totalMinutes % 60;
        $totalHoursFormatted = sprintf("%02d:%02d", $hours, $minutes);

        return response()->json([
            'success' => true,
            'data'    => $activities,
            'total_hours' => $totalHoursFormatted
        ]);
    }


    public function urgentTasks()
    {
        $userId = auth()->user()->id;
        $today = now();
        $dailyWorkHours = 8; 

        $tasks = \App\Models\Task::where('assign_to', $userId)
            ->whereIn('status', [0, 2]) 
            ->get()
            ->map(function ($task) use ($today, $dailyWorkHours) {
                $remainingHours = $task->estimated_time - ($task->time_spent ?? 0);

         
                $daysRemaining = $task->submit_time
                    ? max(0, $today->diffInDays(\Carbon\Carbon::parse($task->submit_time)))
                    : null;

    
                $critical = false;
 
                if (!$task->submit_time && !$task->project_id) {
                    $critical = true;
                }
 
                $requiredHoursPerDay = $daysRemaining ? ($remainingHours / $daysRemaining) : $remainingHours;
 
                if ($requiredHoursPerDay > $dailyWorkHours) {
                    $critical = true;
                }
 
                $urgencyScore = ($task->priority * 100) + $requiredHoursPerDay;
 
                if ($task->status == 0) {
                    $urgencyScore *= 1.2;
                }

                return [
                    'id'             => $task->id,
                    'title'          => $task->title,
                    'description'    => $task->description,
                    'priority'       => $task->priority,
                    'status'         => $task->status == 0 ? 'Pending' : 'In Progress',
                    'estimated_time' => $task->estimated_time,
                    'time_spent'     => $task->time_spent,
                    'submit_time'    => $task->submit_time,
                    'remaining_hours'=> $remainingHours,
                    'days_remaining' => $daysRemaining,
                    'urgency_score'  => $urgencyScore,
                    'critical'       => $critical
                ];
            })
            ->sort(function ($a, $b) {
          
                if ($b['urgency_score'] != $a['urgency_score']) {
                    return $b['urgency_score'] <=> $a['urgency_score'];
                }
            
                if ($a['submit_time'] && $b['submit_time']) {
                    return strtotime($a['submit_time']) <=> strtotime($b['submit_time']);
                }
                return 0;
            })
            ->values()
            ->map(function ($task, $index) {
                $task['serial'] = $index + 1;  
                return $task;
            });

        return response()->json([
            'success' => true,
            'data'    => $tasks
        ]);
    }

    public function cardData(Request $request)
    {
        $userId = auth()->user()->id; 
        try {
            if ($request->start_date && $request->end_date) {
                $start_date = Carbon::parse($request->start_date);
                $end_date = Carbon::parse($request->end_date);
            } else {
                // Default to current month
                $start_date = Carbon::now()->startOfMonth();
                $end_date = Carbon::now()->endOfMonth();
            }
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Invalid date format.'], 400);
        }

        // Ensure start_date <= end_date
        if ($start_date->gt($end_date)) {
            [$start_date, $end_date] = [$end_date, $start_date];
        }

        // Fetch tasks in date range
        $tasks = Task::where('assign_to', $userId)
            ->whereBetween('created_at', [$start_date, $end_date])
            ->get();

        $totalTasks = $tasks->count();
        $completedTasks = $tasks->where('status', 1)->count();
        $pendingTasks = $tasks->where('status', 0)->count();
        $inProgressTasks = $tasks->where('status', 2)->count();

        // Completed within estimated time
        $completedOnTime = $tasks->filter(function ($task) {
            return $task->status == 1 && $task->time_spent !== null && $task->estimated_time !== null && $task->time_spent <= $task->estimated_time;
        })->count();

        $completedLate = $completedTasks - $completedOnTime;

        // Fetch work times
        $workTimes = WorkTime::where('user_id', $userId)
            ->whereBetween('start_time', [$start_date, $end_date])
            ->get();

        $totalMinutes = $workTimes->sum(fn($wt) => $wt->duration ?? 0);
        $hours = floor($totalMinutes / 60);
        $minutes = $totalMinutes % 60;
        $totalHoursFormatted = "{$hours}h {$minutes}m";

        // Days worked vs idle
        $allDays = CarbonPeriod::create($start_date, $end_date);
        $workedDays = $workTimes->groupBy(fn($wt) => Carbon::parse($wt->start_time)->format('Y-m-d'))->count();
        $totalDays = iterator_count($allDays);
        $idleDays = $totalDays - $workedDays;

        $data = [
            'total_tasks' => $totalTasks,
            'completed_tasks' => $completedTasks,
            'pending_tasks' => $pendingTasks,
            'in_progress_tasks' => $inProgressTasks,
            'completed_on_time' => $completedOnTime,
            'completed_late' => $completedLate, 
            'total_hours_worked' => $totalHoursFormatted,
            'total_days' => $totalDays,
            'worked_days' => $workedDays,
            'idle_days' => $idleDays,
        ];

        return success_response($data, 'Card data fetched successfully.');
    }  
    public function workSummary(Request $request)
    {
        $userId = auth()->user()->id;

        // Last 30 days
        $end_date = Carbon::now()->endOfDay();
        $start_date = Carbon::now()->subDays(29)->startOfDay();

        // Fetch work times
        $workTimes = WorkTime::where('user_id', $userId)
            ->whereBetween('start_time', [$start_date, $end_date])
            ->get();

        // Group by date
        $grouped = $workTimes->groupBy(function ($item) {
            return Carbon::parse($item->start_time)->format('Y-m-d');
        });

        // Prepare summary
        $summary = [];
        $period = \Carbon\CarbonPeriod::create($start_date, $end_date);

        foreach ($period as $date) {
            $dateStr = $date->format('Y-m-d');
            $entries = $grouped->get($dateStr, collect());

            $totalMinutes = $entries->sum(fn($wt) => $wt->duration ?? 0);
            $hours = floor($totalMinutes / 60);
            $minutes = $totalMinutes % 60;
            $totalTime = $totalMinutes > 0 ? "{$hours}h {$minutes}m" : null;

            // Unique project titles as comma-separated string
            $projects = $entries->map(fn($wt) => $wt->project ? $wt->project->title : null)
                                ->filter()
                                ->unique()
                                ->values()
                                ->implode(', ');

            $summary[] = [
                'date' => $dateStr,
                'total_time' => $totalTime,
                'projects' => $projects,
            ];
        }

        // Reverse summary so latest date comes first
        $summary = array_reverse($summary);

        return success_response($summary, 'Work summary for last 30 days fetched successfully.');
    }



}
