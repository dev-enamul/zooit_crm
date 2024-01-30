<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use Exception;
use Illuminate\Http\Request;

class BankController extends Controller
{ 
    public function index()
    {
        $datas = Bank::where('status', 1)->get();
        return view('setting.bank_list',compact('datas'));
    }
  
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'type' => 'required' 
        ]);
       try{
        $data = new Bank();
        $data->name = $request->name;
        $data->type = $request->type; 
        $data->save();
            return redirect()->back()->with('success', 'Bank Created Successfully');
       }catch(Exception $e){
            return redirect()->back()->with('error', $e->getMessage());
       }
    }

    
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required',
            'type' => 'required' 
        ]);
       try{
        $data = Bank::find($id);
        if(!$data){
            return redirect()->back()->with('error', 'Data Not Found');
        }   
        $data->name = $request->name;
        $data->type = $request->type; 
        $data->save();
        return redirect()->back()->with('success', 'Bank Updated'); 
       }catch(Exception $e){ 
            return redirect()->back()->with('error', $e->getMessage());
       }
    }

    
    public function destroy(string $id)
    {
        try{
            $data = Bank::find($id);
            if(!$data){
                return redirect()->back()->with('error', 'Data Not Found');
            }   
            $data->delete();
            return response()->json(['success' => 'Bank Deleted Successfully']); 
        }catch(Exception $e){ 
                return response()->json(['error' => $e->getMessage()]);
        }
    }
}
