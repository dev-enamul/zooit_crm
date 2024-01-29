<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use App\Models\UnitCategory;
use Exception;
use Illuminate\Http\Request;

class ProjectSettingController extends Controller
{
    public function unit_type(){ 
        $datas = Unit::where('status',1)->get();
        return view('setting.project.unit_type',compact('datas'));
    }

    public function unit_type_store(Request $request){
        try{
            $input = $request->all();
            Unit::create($input);
            return redirect()->back()->with('success', 'Unit Type Created');
        }catch(Exception $e){
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function unit_type_update(Request $request){
       try{
         
        $data = Unit::find($request->id);  
        $data->title = $request->title;
        $data->down_payment = $request->down_payment;
        $data->booking = $request->booking; 
        $data->save();
        return redirect()->back()->with('success', 'Unit Type Updated');
       }catch(Exception $e){
        return redirect()->back()->with('error', $e->getMessage());
       }

    }

    public function unit_type_delete($id){
        try{ 
            $data  = Unit::find($id);
            $data->delete();
            return response()->json(['success' => 'Unit Type Deleted'],200);
        }catch(Exception $e){
            return response()->json(['error' => $e->getMessage()],500);
        }
    }

    public function unit_category(){
        $datas = UnitCategory::where('status',1)->get();
        return view('setting.project.unit_category',compact('datas'));
    }  

    public function unit_category_store(Request $request){
        try{
            $input = $request->all();
            UnitCategory::create($input);
            return redirect()->back()->with('success', 'Unit Category Created');
        }catch(Exception $e){
            return redirect()->back()->with('error', $e->getMessage());
        } 
    }

    public function unit_category_update(Request $request){
        try{
            $data = UnitCategory::find($request->id);
            $data->title = $request->title;
            $data->description = $request->description;
            $data->save();
            return redirect()->back()->with('success', 'Unit Category Updated');
        }catch(Exception $e){
            return redirect()->back()->with('error', $e->getMessage());
        }
        
    }

    public function unit_category_delete($id){
        try{
            $data = UnitCategory::find($id);
            $data->delete();
            return response()->json(['success' => 'Unit Category Deleted'],200);
        }catch(Exception $e){
            return response()->json(['error' => $e->getMessage()],500);
        }
        
    }
}
