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
        $save_work = $this->endWorkSave($request->note);

        if($save_work){
            return success_response(null, 'Work ended successfully');
        } else {
            return error_response('Work end fail');
        }
    }

   


    public function UploadScreenshort(Request $request)
    {
        $user = Auth::user();
        $userId = $user->id;
        $userName = strtolower(str_replace(' ', '_', $user->name)); 

        // তারিখ অনুযায়ী year/month/day ফোল্ডার
        $year = now()->format('Y');
        $month = now()->format('m');
        $day = now()->format('d');

        // ফোল্ডার স্ট্রাকচার
        $folderPath = "screenshots/{$year}/{$month}/{$day}/{$userName}_{$userId}";

        // ফাইলের এক্সটেনশন
        $extension = $request->file('image')->getClientOriginalExtension();
 
        $fileName = time() . '.' . $extension;
 
        $path = $request->file('image')->storeAs($folderPath, $fileName, 'public');

     
        $screenshot = EmployeeScreenShort::create([
            'user_id' => $userId,
            'image' => $path, // শুধু relative path
        ]);

        $this->endWorkSave();
        return success_response(null, 'Screenshot uploaded successfully'); 
    }



    public function endWorkSave($note = null)
    {
        $userId = Auth::id();

        $workTime = WorkTime::where('user_id', $userId)
                            ->latest()
                            ->first();

        if(!$workTime){
            return false;  
        }

        $updated = $workTime->update([
            'note' => $note ?? $workTime->note,
            'end_time' => now(),
            'duration' => now()->diffInMinutes($workTime->start_time),
        ]);

        return $updated;  
    }


}
