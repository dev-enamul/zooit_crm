<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\EmployeeScreenShort;
use App\Models\WorkTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApiEmployeeWorktingTimeController extends Controller
{
    public function startWork()
    {
        $userId = Auth::user()->id;  

        WorkTime::create([
            'user_id' => $userId,
            'start_time' => now(),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Work started successfully'
        ]);  
    }

    public function endWork(Request $request)
    {
        $userId = Auth::id();
        $workTime = WorkTime::where('user_id', $userId)
                            ->whereNull('end_time')
                            ->latest()
                            ->first(); 

        $workTime->update([
            'end_time' => now(),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Work ended successfully.'
        ]);   
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

        return response()->json([
            'success' => true,
            'message' => 'Screenshot uploaded successfully.'
        ]);
    }
}
