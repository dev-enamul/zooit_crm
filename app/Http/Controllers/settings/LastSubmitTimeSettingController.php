<?php

namespace App\Http\Controllers\settings;

use App\Http\Controllers\Controller;
use App\Models\SubmitTime;
use Exception;
use Illuminate\Http\Request;

class LastSubmitTimeSettingController extends Controller
{
    public function index(){ 
        $data = SubmitTime::first();
        return view('setting.last_submit_time', compact('data'));
    }

    public function update(Request $request){ 
        try{
           $request->validate([
                'submit_time' => 'required|date_format:H:i',
            ]);  
            $old = SubmitTime::first();
            if($old){
                $old->update($request->all());
                return redirect()->back()->with('success', 'Submit time updated successfully');
            }else{
                $input = $request->all();
                $time = new SubmitTime($input); 
                $time->save();  
                return redirect()->back()->with('success', 'Submit time updated successfully');
            } 
        }catch(Exception $e){ 
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
