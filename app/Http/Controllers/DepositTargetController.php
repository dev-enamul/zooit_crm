<?php

namespace App\Http\Controllers;

use App\Models\DepositTarget;
use App\Models\DepositTargetProject;
use App\Models\Notification;
use App\Models\Project;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DepositTargetController extends Controller
{
    public function my_target(Request $request){  
        $datas = DepositTarget::where('assign_to',auth()->user()->id); 

        if(isset($request->month) && $request->month != ''){ 
            $month = date('m',strtotime($request->month));
            $year = date('Y',strtotime($request->month)); 
            $datas = $datas->whereMonth('month',$month)->whereYear('month',$year);
        }else{
            $datas = $datas->whereMonth('month',date('m'))->whereYear('month',date('Y'));
        } 

        $datas = $datas->first(); 
        return view('target.deposit_target',compact('datas'));
    } 


    // Remain Deposit Target 
    public function remain_deposit_target(){
        $target = DepositTarget::where('assign_to',auth()->user()->id); 
        $asigned = DepositTarget::where('assign_by',auth()->user()->id); 

        if(isset($request->month) && $request->month != ''){
            $month = date('m',strtotime($request->month));
            $year = date('Y',strtotime($request->month)); 
            $target = $target->whereMonth('month',$month)->whereYear('month',$year);
            $asigned = $asigned->whereMonth('month',$month)->whereYear('month',$year);
        }else{
            $target = $target->whereMonth('month',date('m'))->whereYear('month',date('Y'));
            $asigned = $asigned->whereMonth('month',date('m'))->whereYear('month',date('Y'));
        }  
        $target = $target->first(); 
        $asigned = $asigned->get();
        return view('target.deposit_target_remain',compact('target','asigned'));
    }

    public function target_asign($id){ 
       try{
        $my_employee = my_employee(auth()->user()->id);
        $employees = User::whereIn('id',$my_employee)->where('status',1)->get();
        $target_project  = DepositTargetProject::find($id); 
        return view('target.deposit_target_asign',compact('target_project','employees'));
       }catch(Exception $e){
           return redirect()->back()->with('error',$e->getMessage());
       }
    } 
    
    public function target_asign_list(Request $request){
        $my_employee = my_employee(auth()->user()->id);  
        $selected = $request->month;  
        if(isset($selected) && $selected != ''){ 
            $month = date('m',strtotime($selected));
            $year = date('Y',strtotime($selected)); 
        }else{
            $month = date('m');
            $year = date('Y');
        } 

        $deposit_targets = DepositTarget::where('assign_by',Auth::user()->id)
                    ->whereMonth('month',$month)
                    ->whereYear('month',$year)
                    ->where('is_project_wise',1)
                    ->with('assignTo')
                    ->get();  

        $employees = User::whereIn('id',$my_employee)->where('status',1)->get(); 
        $projects = Project::where('status', 1)->get();
        return view('target.deposit_target_asign_list',compact('selected','projects','employees','deposit_targets'));
    }

    public function project_deposit_target(){
        $my_employee = my_employee(auth()->user()->id);
        $employees = User::whereIn('id',$my_employee)->where('status',1)->get();  
        $projects = Project::where('status', 1)->get(); 
        return view('target.project_deposit_target',compact('projects','employees'));
    } 

    // employee.projects
    public function employee_projects(Request $request){  
        $month = $request->month.'-'. 1; 
        $deposit = DepositTarget::where('assign_to',$request->employee_id)
            ->where('month',$month) 
            ->first(); 
        $projects = DepositTargetProject::where('deposit_target_id',$deposit->id)->get();
        return response()->json($projects);
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

                Notification::store([
                    'title' => 'Field Target Updated',
                    'content' => auth()->user()->name . ' has updated your field target',
                    'link' => route('my.deposit.target'),
                    'created_by' => auth()->user()->id,
                    'user_id' => [$request->assign_to]
                ]);

            }else{
                $deposit_target = DepositTarget::create($input); 
                Notification::store([
                    'title' => 'Field Target Assigned',
                    'content' => auth()->user()->name . ' has assigned you a field target',
                    'link' => route('my.deposit.target'),
                    'created_by' => auth()->user()->id,
                    'user_id' => [$request->assign_to]
                ]);
            }
           
            if(isset($request->project_id) && count($request->project_id) > 0){
                foreach($request->project_id as $key => $project_id){ 
        
                    $project = Project::find($project_id);
                    if($project){
                        DepositTargetProject::create([
                            'deposit_target_id' => $deposit_target->id,
                            'project_id' => $project_id,
                            'new_unit' => $request->new_unit[$key]??0,
                            'new_deposit' => $request->new_deposit[$key]??0,
                            'existing_unit' => $request->existing_unit[$key]??0,
                            'existing_deposit' => $request->existing_deposit[$key]??0,
                        ]);
                    }
                }
                
                $new_total_deposit = array_sum($request->new_deposit);
                $existing_total_deposit = array_sum($request->existing_deposit);
                $deposit_target->new_total_deposit = $new_total_deposit;
                $deposit_target->existing_total_deposit = $existing_total_deposit; 
                $deposit_target->is_project_wise = 1;
                $deposit_target->save();

            }    
            
            DB::commit();
            return redirect()->back()->with('success','Deposit target assigned successfully');
       }catch(Exception $e){  
            DB::rollBack();
            return redirect()->back()->with('error',$e->getMessage());
       }
    }
}
