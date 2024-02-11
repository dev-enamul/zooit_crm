<?php

namespace App\Http\Controllers;

use App\Models\Task as ModelsTask;
use App\Models\TaskList;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Console\View\Components\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TaskController extends Controller
{
     
    public function my_task()
    {
        $old_tasks = TaskList::where('status',0)
                    ->whereHas('task',function($q){
                        $q->where('assign_to',auth()->user()->id);
                    })
                    ->where('time','<',today()) 
                    ->get(); 

        $today_tasks = ModelsTask::where('assign_to', auth()->user()->id)
                    ->whereDate('date', today())
                    ->first();
        return view('task.my_task',compact('today_tasks','old_tasks'));
    }

    public function task_complete(Request $request){
        $datas = new ModelsTask;
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
        $datas = $datas->where('assign_to',$user_id)->get(); 
        $my_employee = my_employee(auth()->user()->id);
        $employeies = User::whereIn('id',$my_employee)->where('status',1)->get();  
        return view('task.task_complete',compact('datas','employeies'));
    }

    public function assign_task_list(){
        $datas = ModelsTask::where('assign_by',auth()->user()->id)->get()->groupBy('assign_to'); 
        return view('task.assign_task_list',compact('datas'));
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
            $task = ModelsTask::create([
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
        $task = ModelsTask::find($id); 
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
}
