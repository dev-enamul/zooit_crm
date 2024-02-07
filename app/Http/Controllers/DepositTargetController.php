<?php

namespace App\Http\Controllers;

use App\Models\DepositTarget;
use App\Models\Project;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DepositTargetController extends Controller
{
    public function target(){
        return view('target.deposit_target');
    }

    public function target_asign(){
        return view('target.deposit_target_asign');
    }

    public function target_asign_list(){
        return view('target.deposit_target_asign_list');
    }

    public function project_deposit_target(){ 
        $projects = Project::where('status', 1)->get();
     
        return view('target.project_deposit_target',compact('projects'));
    } 

    public function direct_deposit_target(){
        $my_employee = my_employee(auth()->user()->id);
        $employees = User::whereIn('id',$my_employee)->where('status',1)->get();  
        return view('target.direct_deposit_target',compact('employees'));
    }

    public function deposit_target_save(Request $request){
    
        DB::beginTransaction();
       try{
            $input = $request->all();
            $input['assign_by'] = auth()->user()->id;
            $deposit_target = DepositTarget::create($input); 

            if(isset($request->project_id) && count($request->project_id) > 0){
                foreach($request->project_id as $key => $project_id){
                    $project = Project::find($project_id);
                    if($project){
                        $deposit_target->projects()->create([
                            'project_id' => $project_id,
                            'new_unit' => $request->new_unit[$key],
                            'new_deposit' => $request->new_deposit[$key],
                            'existing_unit' => $request->existing_unit[$key],
                            'existing_deposit' => $request->existing_deposit[$key],
                        ]);
                    }
                }
            }
            DB::commit();
            return redirect()->back()->with('success','Deposit target assigned successfully');
       }catch(Exception $e){
            DB::rollBack();
            return redirect()->back()->with('error',$e->getMessage());
       }
    }
}
