<?php

namespace App\Http\Controllers;

use App\Models\Unit;
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
        $data->upate($request->all());
        return redirect()->back()->with('success', 'Unit Type Updated');
       }catch(Exception $e){
        return redirect()->back()->with('error', $e->getMessage());
       }

    }

    public function unit_type_delete($id){
        try{
            $data  = Unit::find($id);
            $data->delete();
        }catch(Exception $e){
            return redirect()->back()->with('error',$e->getMessage());
        }
    }

    public function unit_category(){
        return view('setting.project.unit_category');
    }  

    public function unit_category_create(){

    }

    public function unit_category_update(){
        
    }

    public function unit_category_delete(){
        
    }
}
