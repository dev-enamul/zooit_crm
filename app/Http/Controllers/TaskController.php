<?php

namespace App\Http\Controllers;

use App\Models\Task as TaskModel;
use App\Models\TaskList;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TaskController extends Controller
{
     
    public function my_task(Request $request)
    {
        if(isset($request->date) && $request->date != ''){
            $date = Carbon::parse($request->date);
        }else{
            $date = Carbon::now();
        }

        $old_tasks = TaskList::where('status',0)
                    ->whereHas('taskModel',function($q){
                        $q->where('assign_to',auth()->user()->id);
                    })
                    ->where('time','<',$date) 
                    ->get(); 

        // $today_tasks = ModelsTask::where('assign_to', auth()->user()->id)
        //             ->whereDate('date', $date)
        //             ->first();

        $today_tasks = TaskList::whereHas('taskModel',function($q){
                        $q->where('assign_to',auth()->user()->id);
                    })
                    ->whereDate('time', $date) 
                    ->get();
        $selected_date = $date->format('Y-m-d');
      

        return view('task.my_task',compact('today_tasks','old_tasks','selected_date'));
    }  
    
    public function task_complete(Request $request){
        $datas = new TaskModel;
        if(isset($request->date) && $request->date != ''){
            $dateRange = explode(' - ', $request->date);
            $startDate = Carbon::createFromFormat('m/d/Y', $dateRange[0])->startOfDay();
            $endDate = Carbon::createFromFormat('m/d/Y', $dateRange[1])->endOfDay();
            $datas = $datas->whereBetween('date',[$startDate,$endDate]);
        }

        if(isset($request->employee) && $request->employee != ''){
            $user_id = $request->employee;
        }else{
            $user_id = auth()->user()->id;
        }
        $user = User::find($user_id);
        $datas = $datas->where('assign_to',$user_id)->get(); 
        $my_employee = my_employee(auth()->user()->id);
        $employeies = User::whereIn('id',$my_employee)->where('status',1)->get();  
        return view('task.task_complete',compact('datas','employeies','user'));
    }

    public function assign_task_list(Request $request){ 
        if(isset($request->date) && $request->date != ''){
            $date = Carbon::parse($request->date);
        }else{
            $date = Carbon::now();
        }
        $datas = TaskList::whereHas('taskModel',function($q){
                        $q->where('assign_by',auth()->user()->id);
                    })
                    ->whereDate('time', $date)
                    ->get();
         $selected_date = $date->format('Y-m-d');
        return view('task.assign_task_list',compact('datas','selected_date'));
    }

    public function assign_task(){
        $my_employee = my_employee(auth()->user()->id);
        $employeies = User::whereIn('id',$my_employee)->where('status',1)->get(); 
        return view('task.assign_task',compact('employeies'));
    }

    public function task_save(Request $request)
    {
        $request->validate([
            'assign_to' => 'required',
            'date' => 'required',
            'task.*' => 'required',
            'time.*' => 'required',
            
        ]); 
          
        try{ 
            $task = TaskModel::create([
                'assign_to' => $request->assign_to,
                'assign_by' => auth()->user()->id,
                'date' => $request->date,
                // 'submit_time' => $request->date.' '. $request->submit_time,
            ]); 
            foreach($request->task as $key => $task_list){
                TaskList::create([
                    'task_id' => $task->id,
                    'task' => $task_list,
                    'time' => $request->date.' '. $request->time[$key],
                    'status' => 0,
                ]);
            }   
            return redirect()->back()->with('success', 'Task assigned successfully');
        }catch(Exception $e){ 
            dd($e->getMessage());
            return redirect()->back()->with('error', $e->getMessage());
        }

    } 

    public function task_details($id)
    {
        $task = TaskModel::find($id); 
        return view('task.task_details',compact('task'));
    } 


    public function submit_task($id)
    {
        $task = TaskList::find($id);
        $task->status = 1;
        $task->save();
        return redirect()->back()->with('success', 'Task submitted');
    }

    public function reject_task($id){
        $task = TaskList::find($id);
        $task->status = 2;
        $task->save();
        return redirect()->back()->with('success', 'Task rejected');

    }

    public function taskReport($slug, Request $request)
    {
        // Find project by slug with customer and user relationship
        $project = \App\Models\Project::with('customer.user')->where('slug', $slug)->first();
        
        if (!$project) {
            abort(404, 'Project not found');
        }
        
        $statusFilter = $request->get('status', 'all'); // all, 0, 1, 2
        
        // Base query - filter by project
        $tasksQuery = TaskModel::where('project_id', $project->id);
        
        // Apply status filter
        if ($statusFilter !== 'all') {
            $tasksQuery->where('status', $statusFilter);
        }
        
        // Pagination
        $perPage = 15;
        $tasks = $tasksQuery->orderBy('created_at', 'desc')->paginate($perPage);
        $tasks->appends(['status' => $statusFilter])->setPath(route('task.report', ['slug' => $slug]));
        
        // Statistics - only for this project
        $totalTasks = TaskModel::where('project_id', $project->id)->count();
        $completedTasks = TaskModel::where('project_id', $project->id)->where('status', 1)->count();
        $remainTasks = TaskModel::where('project_id', $project->id)->where('status', '!=', 1)->count();
        
        // Last 7 days completed - only for this project
        $last7DaysCompleted = TaskModel::where('project_id', $project->id)
            ->where('status', 1)
            ->where('created_at', '>=', Carbon::now()->subDays(7))
            ->count();
        
        // Last 1 month completed - only for this project
        $lastMonthCompleted = TaskModel::where('project_id', $project->id)
            ->where('status', 1)
            ->where('created_at', '>=', Carbon::now()->subMonth())
            ->count();
        
        // Progress calculation based on estimated_time (hours) - only for this project
        $totalHours = TaskModel::where('project_id', $project->id)
            ->whereNotNull('estimated_time')
            ->sum('estimated_time');
        $completedHours = TaskModel::where('project_id', $project->id)
            ->where('status', 1)
            ->whereNotNull('estimated_time')
            ->sum('estimated_time');
        
        $progressPercentage = $totalHours > 0 
            ? round(($completedHours / $totalHours) * 100, 2) 
            : 0;
        
        // Handle AJAX request
        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'tasks' => $tasks->map(function($task, $index) use ($tasks) {
                    return [
                        'number' => $tasks->firstItem() + $index,
                        'title' => $task->title,
                        'description' => $task->description,
                        'status' => $task->status,
                        'description_short' => \Illuminate\Support\Str::limit($task->description ?? '', 60)
                    ];
                }),
                'pagination' => [
                    'has_pages' => $tasks->hasPages(),
                    'current_page' => $tasks->currentPage(),
                    'last_page' => $tasks->lastPage(),
                    'on_first_page' => $tasks->onFirstPage(),
                    'has_more_pages' => $tasks->hasMorePages(),
                    'previous_page_url' => $tasks->previousPageUrl(),
                    'next_page_url' => $tasks->nextPageUrl(),
                    'url_range' => $tasks->getUrlRange(1, $tasks->lastPage())
                ],
                'empty' => $tasks->count() === 0
            ]);
        }
        
        return view('task.task_report', compact(
            'project',
            'totalTasks',
            'completedTasks',
            'remainTasks',
            'last7DaysCompleted',
            'lastMonthCompleted',
            'progressPercentage',
            'totalHours',
            'completedHours',
            'tasks',
            'statusFilter'
        ));
    }


}
