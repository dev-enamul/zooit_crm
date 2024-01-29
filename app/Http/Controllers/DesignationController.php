<?php

namespace App\Http\Controllers;

use App\Models\Commission;
use App\Models\Designation;
use App\Models\DesignationPermission;
use App\Models\Permission;
use Exception;
use Faker\Extension\Extension;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DesignationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $permissions = Permission::latest()->get();
        $commissions = Commission::where('status','1')->get();
        $datas = Designation::where('status',1)->get(); 
        return view('setting.designation.designation_list',compact('permissions','commissions','datas'));
    }
  
    public function store(Request $request)
    {
        $input =  $request->all();
        $input['created_by'] = Auth::user()->id; 
        Designation::create($input); 

        return redirect()->back()->with('success','Designation Created');
    }
   
    public function update(Request $request)
    {   
        $request->validate([
            'title' => 'required:max:45',
            'commission_id' => 'required', 
            'working_place' => 'required',
        ]);

       
        try{
            $input =  $request->all(); 
            Designation::find($request->id)->update($input); 
            return redirect()->back()->with('success','Designation Updated');
        }catch(Exception $e){
            return redirect()->back()->with('error',$e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    { 
        try{
            Designation::find($id)->delete();
            return response()->json(['success' => 'Designation deleted']);
        }catch(Exception $e){ 
            return response()->json(['error' => $e->getMessage()]); 
        }
        
    }

    public function designation_permission($id){
        $datas = Permission::where('status',1)->get();
        $designation = Designation::find($id);
        $selected = DesignationPermission::where('designation_id', $id)->pluck('permission_id')->toArray();
 
        return view('setting.designation.designation_permission',compact('datas','designation','selected'));
    }

    public function designation_permission_update(Request $request){ 

        $selected = DesignationPermission::where('designation_id', $request->designation_id)->delete(); 
        try{
            $permission = $request->permission;
            if(is_array($request->permission)){
                foreach($permission as $item){
                    DesignationPermission::create([
                        'designation_id' => $request->designation_id,
                        'permission_id'  => $item,
                    ]);
                }
            }
            return redirect()->back()->with('success','Successfully updated');
        }catch(Exception $e){
            return redirect()->back()->with('error',$e);
        }
        
         
    }
}
