<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\EmployeeScreenShort;
use App\Models\WorkTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApiEmployeeWorktingTimeController extends Controller
{
    public function startWork(Request $request)
    {
        $userId = Auth::user()->id;
        WorkTime::create([
            'user_id' => $userId,
            'project_id' => $request->project_id,
            'task_id' => $request->task_id,
            'note' => $request->note,
            'start_time' => now(),
        ]); 

        if(isset($request->task_id)){
            $task = \App\Models\Task::find($request->task_id);
            if($task && $task->status == 0){
                $task->update(['status' => 2]);
            }
        }
        return success_response(null, 'Work started successfully'); 
    }

    public function endWork(Request $request)
    {
        $userId = Auth::id();
        $workTime = WorkTime::where('user_id', $userId)
                            ->whereNull('end_time')
                            ->latest()
                            ->first();

        $workTime->update([
            'note' => $request->note,
            'end_time' => now(),
            'duration' => now()->diffInMinutes($workTime->start_time),
        ]); 
        return success_response(null, 'Work ended successfully');   
    }

    public function UploadScreenshort(Request $request)
    {
        $userId = Auth::user()->id; 
        $path = $request->file('image')->store('screenshots', 'public'); 
        $fullUrl = asset('storage/' . $path);

        $screenshot = EmployeeScreenShort::create([
            'user_id' => $userId,
            'image' => $fullUrl,
        ]);

        return success_response(null, 'Screenshot uploaded successfully'); 
    }
}
