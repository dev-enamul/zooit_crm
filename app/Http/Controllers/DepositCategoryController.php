<?php

namespace App\Http\Controllers;

use App\Models\DepositCategory;
use Exception;
use Illuminate\Http\Request;

class DepositCategoryController extends Controller
{
    public function index(){
        $datas = DepositCategory::where('status',1)->get();
     
        return view('setting.deposit_category',compact('datas'));
    }

    public function store(Request $request){
        try{
            DepositCategory::create($request->all());
            return redirect()->back()->with('success', 'Deposit Category Created');
        }catch(Exception $e){ 
 
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function destroy($id){ 
        try{
            $data = DepositCategory::find($id);
            $data->delete();

            return redirect()->back()->with('success', 'Deposit Category Deleted');
        }catch(Exception $e){
            return redirect()->back()->with('error',$e->getMessage());
        };

    }
}
