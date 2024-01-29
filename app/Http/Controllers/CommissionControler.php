<?php

namespace App\Http\Controllers;

use App\Models\Commission;
use App\Models\CommissionHolder;
use App\Models\Designation;
use Illuminate\Http\Request;

class CommissionControler extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $datas = Commission::where('status', 1)->latest()->get(); 
        return view('setting.commission',compact('datas'));
    }

    
    public function store(Request $request)
    { 
       try{
            $request->validate([
                'title' => 'required',
                'commission' => 'required'
            ]);

            $input = $request->all(); 
            $commission = Commission::create($input);  
            
            return redirect()->back()->with('success', 'Commission created');
       }catch(\Exception $e){
        dd($e->getMessage());
            return redirect()->back()->with('error', $e->getMessage());
       }
    }
 
 
    public function update(Request $request)
    {
        try{
            $request->validate([
                'title' => 'required',
                'commission' => 'required'
            ]);

            $input = $request->all(); 
            $commission = Commission::find($request->id);
            $commission->update($input);  
            return redirect()->back()->with('success', 'Commission updated');
       }catch(\Exception $e){
            return redirect()->back()->with('error', $e->getMessage());
       }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try{
            $commission = Commission::find($id);  
            $commission->delete();
            return response()->json(['success' => 'Commission deleted']);
       }catch(\Exception $e){ 
            return response()->json(['error' => $e->getMessage()]);
       }
    }
}
