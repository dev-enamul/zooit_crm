<?php

namespace App\Http\Controllers;

use App\Models\BankDay;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;

class BankDayController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    { 
        $datas = BankDay::latest()->get();
        return view('setting.bank_day',compact('datas'));
    }

     
    public function store(Request $request)
    {
        try{
            $old_data =  BankDay::where('month',$request->month)->first();
            if($old_data != null){
                $old_data->month = $request->month; 
                $old_data->bank_day = json_encode($request->bank_day);  
                $old_data->save(); 
                return redirect()->back()->with('success','Bank Day Updated');
            }else{
                $bankDay = new BankDay(); 
                $bankDay->month = $request->month; 
                $bankDay->bank_day = json_encode($request->bank_day);  
                $bankDay->save(); 
                return redirect()->back()->with('success','Bank Day Created');
            }  
        }catch(Exception $e){
            return redirect()->back()->with('error',$e->getMessage());
        }
    }
  
 
    public function update(Request $request, string $id)
    {
        //
    }

 
    public function destroy(string $id)
    {
        try{
            $data = BankDay::find($id);
            $data->delete();
            return redirect()->back()->with('success','Bank Day Deleted');
        }catch(Exception $e){
            return redirect()->back()->with('error',$e);
        }
    }
}
