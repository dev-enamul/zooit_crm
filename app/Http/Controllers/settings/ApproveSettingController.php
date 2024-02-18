<?php

namespace App\Http\Controllers\settings;

use App\Http\Controllers\Controller;
use App\Models\ApproveSetting;
use Exception;
use Illuminate\Http\Request;

class ApproveSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $datas = ApproveSetting::all();
        return view('setting.approve_setting',compact('datas'));
    }

    public function save(Request $request)
    { 
         try{
            $input = $request->all();
            $datas = ApproveSetting::all();
            foreach($datas as $data){
                $data->update(['status' => 0]);
            }  
            foreach($input as $key => $value){  
                $approve_setting = ApproveSetting::where('name',$key)->first();
                if($approve_setting){
                    $approve_setting->update(['status' => 1]);
                }
                
            }
            return redirect()->back()->with('success', 'Approve Setting Updated Successfully');
         }catch(Exception $e){
                return redirect()->back()->with('error', $e->getMessage());
         }
    }
}
