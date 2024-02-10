<?php

namespace App\Http\Controllers;

use App\Models\DepositTarget;
use App\Models\DepositTargetProject;
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

    public function target_asign_list(Request $request){ 

        // $datas = DepositTargetProject::where('assign_by',auth()->user()->id);
        // if(isset($request->month) && $request->month != ''){ 
        //     $month = date('m',strtotime($request->month));
        //     $year = date('Y',strtotime($request->month)); 
        //     $datas = $datas->whereMonth('month',$month)->whereYear('month',$year);
        // }else{
        //     $datas = $datas->whereMonth('month',date('m'))->whereYear('month',date('Y'));
        // }
        // $datas = $datas->get(); 

        $my_employee = my_employee(auth()->user()->id);
        $employees = User::whereIn('id',$my_employee)->where('status',1)->get();   
        $selected = $request->month; 

        $projects = Project::where('status', 1)->get();
        return view('target.deposit_target_asign_list',compact('selected','projects','employees'));
    }

    public function project_deposit_target(){ 
        $my_employee = my_employee(auth()->user()->id);
        $employees = User::whereIn('id',$my_employee)->where('status',1)->get();  
        $projects = Project::where('status', 1)->get();
     
        return view('target.project_deposit_target',compact('projects','employees'));
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
            $input['month'] = $request->month.'-'. 1; 
            $old_deposit_target = DepositTarget::where('assign_to',$request->assign_to)->where('month',$input['month'])->first();
            if($old_deposit_target){
                $old_deposit_target->update($input);
                $deposit_target = $old_deposit_target;
                if(isset($deposit_target->depositTargetProjects) && $deposit_target->depositTargetProjects->count() > 0){
                    $deposit_target->depositTargetProjects->each(function($depositTargetProject) {
                        $depositTargetProject->delete();
                    });
                }
            }else{
                $deposit_target = DepositTarget::create($input); 
            }
           
            if(isset($request->project_id) && count($request->project_id) > 0){
                foreach($request->project_id as $key => $project_id){ 
        
                    $project = Project::find($project_id);
                    if($project){
                        DepositTargetProject::create([
                            'deposit_target_id' => $deposit_target->id,
                            'project_id' => $project_id,
                            'new_unit' => $request->new_unit[$key],
                            'new_deposit' => $request->new_deposit[$key],
                            'existing_unit' => $request->existing_unit[$key],
                            'existing_deposit' => $request->existing_deposit[$key],
                        ]);
                    }
                }
            }   
            $deposit_target->new_total_deposit = DepositTargetProject::where('deposit_target_id',$deposit_target->id)->sum('new_deposit');
            $deposit_target->existing_total_deposit = DepositTargetProject::where('deposit_target_id',$deposit_target->id)->sum('existing_deposit');
            $deposit_target->save();
            DB::commit();
            return redirect()->back()->with('success','Deposit target assigned successfully');
       }catch(Exception $e){  
            DB::rollBack();
            return redirect()->back()->with('error',$e->getMessage());
       }
    }
}
