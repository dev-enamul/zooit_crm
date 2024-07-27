<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\SubProject;
use Exception;
use Illuminate\Http\Request;

class SubProductController extends Controller
{
    public function index(){
        $datas = SubProject::where('status',1)->get();
        $projects = Project::where('status',1)->select('id','name')->get(); 
        return view('product.sub_product_list',compact('datas','projects'));
    } 

    public function store(Request $request){
       try{
        $input = $request->all();  
        SubProject::create($input);
        return redirect()->back()->with('success', 'Sub Product Created Success');
       }catch(Exception $e){
        return redirect()->back()->with('error',$e->getMessage());
       }
    }

    // public function create(Request $request, string $id)
    // { 
    //    try{ 
    //     $input = $request->all();
    //     SubProject::create($input); 
    //     return redirect()->back()->with('success', 'Sub Product Created');
    //    }catch(Exception $e){ 
    //         return redirect()->back()->with('error', $e->getMessage());
    //    }
    // }

    public function update(Request $request, string $id)
    { 
       try{
        $data = SubProject::find($id);
        if(!$data){
            return redirect()->back()->with('error', 'Data Not Found');
        }  
        $input = $request->all();
        $data->update($input);
        return redirect()->back()->with('success', 'Bank Updated');
       }catch(Exception $e){ 
            return redirect()->back()->with('error', $e->getMessage());
       }
    }



    public function destroy(string $id)
    {
        try{
            $data = SubProject::find($id);
            if(!$data){
                return redirect()->back()->with('error', 'Data Not Found');
            }   
            $data->delete();
            return response()->json(['success' => 'Product Deleted Successfully']); 
        }catch(Exception $e){ 
                return response()->json(['error' => $e->getMessage()]);
        }
    }

    public function get_subproject(Request $request){
        $sub_project = SubProject::where('project_id',$request->id)->select('id','name')->get();
        return response($sub_project); 
    }
}
