<?php

namespace App\Http\Controllers;

use App\Models\CommissionDeductedSetting;
use Exception;
use Illuminate\Http\Request;

class CommissionDeductedController extends Controller
{ 
    public function index()
    { 
        $datas = CommissionDeductedSetting::where('status', 1)->get();
        return view('setting.commission_deducted_setting',compact('datas'));
    }
 
     
   
    public function store(Request $request)
    {
        $request->validate([
            'start_amount' => 'required',
            'end_amount' => 'required',
            'deducted' => 'required',
        ]);
       try{
        $data = new CommissionDeductedSetting();
        $data->start_amount = $request->start_amount;
        $data->end_amount = $request->end_amount;
        $data->deducted = $request->deducted;
        $data->save();
        return redirect()->back()->with('success', 'Commission Deducted Setting Created Successfully');
       }catch(Exception $e){
        return redirect()->back()->with('error', $e->getMessage());
       }
    }

   
    public function update(Request $request)
    {
        $request->validate([
            'start_amount' => 'required',
            'end_amount' => 'required',
            'deducted' => 'required',
        ]);
       try{
        $data = CommissionDeductedSetting::find($request->id);
        if(!$data){
            return redirect()->back()->with('error', 'Data Not Found');
        }  

        $data->start_amount = $request->start_amount;
        $data->end_amount = $request->end_amount;
        $data->deducted = $request->deducted;
        $data->save();
        return redirect()->back()->with('success', 'Commission Deducted Updated'); 
       }catch(Exception $e){ 
            return redirect()->back()->with('error', $e->getMessage());
       }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try{
            $data = CommissionDeductedSetting::find($id);
            if(!$data){
                return redirect()->back()->with('error', 'Data Not Found');
            }
            $data->delete();
                return response()->json(['success' => 'Commission Deducted Deleted Successfully']);
           }catch(Exception $e){
                return response()->json(['error' => $e->getMessage()]);
           }
    }
}
