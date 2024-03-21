<?php

namespace App\Http\Controllers;

use App\DataTables\CustomersDataTable;
use App\DataTables\EmployeesDataTable;
use App\DataTables\FreelancersDataTable;
use App\DataTables\UsersDataTable;
use App\Models\Area;
use App\Models\Bank;
use App\Models\ColdCalling;
use App\Models\Customer;
use App\Models\Deposit;
use App\Models\DepositTarget;
use App\Models\Designation;
use App\Models\DesignationPermission;
use App\Models\Task as ModelsTask;
use App\Models\District;
use App\Models\Division;
use App\Models\FieldTarget;
use App\Models\FollowUpAnalysis;
use App\Models\Freelancer;
use App\Models\Lead;
use App\Models\LeadAnalysis;
use App\Models\NegotiationAnalysis;
use App\Models\Prospecting;
use App\Models\TaskList;
use App\Models\Union;
use App\Models\Upazila;
use App\Models\User;
use App\Models\Village;
use App\Models\Zone;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class DashboardController extends Controller
{
    // public function create(CustomersDataTable $dataTable)
    // { 
    //     return $dataTable->render('displaydata');
    // }  

    public function index(){  
        $data = User::where('phone','01701203070')->first();
        if(isset($data) && $data != null){
            $data->user_id = 'EMP-000007';
            $data->save();
        }
        $user= User::find(Auth::id());
        if($user->user_type==1){
            $user->e = $user->employee;
            $designations = $user->employee->designation_id;
        }else if($user->user_type==2){
            $designations = $user->freelancer->designation_id;
        }  
        $old_tasks = TaskList::where('status',0)
                    ->whereHas('task',function($q){
                        $q->where('assign_to',auth()->user()->id);
                    })
                    ->where('time','<',today()) 
                    ->get(); 

        $today_tasks = ModelsTask::where('assign_to', auth()->user()->id)
                    ->whereDate('date', today())
                    ->first();
                    
        $field_target = FieldTarget::where('assign_to', auth()->user()->id)
                    ->whereMonth('month', today())
                    ->whereYear('month', today())
                    ->first();  
        $deposit_target = DepositTarget::where('assign_to', auth()->user()->id)
            ->whereMonth('month', today())
            ->whereYear('month', today()) 
            ->first();
        if($deposit_target && $deposit_target == null){
            if($deposit_target->is_project_wise==0){
                $deposit_target = $deposit_target->project->selectRaw('sum(new_deposit) + sum(existing_deposit) as total_deposit')->total_deposit;
            }else{
                $deposit_target = $deposit_target->selectRaw('new_total_deposit + existing_total_deposit as total_deposit')->total_deposit;
            } 
        }else{
            $deposit_target = 0;
        }
        
                
        $total_day = Carbon::now()->daysInMonth; 
        $today_target['freelancer'] = round($field_target?->customer/$total_day??0,1); 
        $today_target['customer'] = round($field_target?->customer/$total_day??0,1);
        $today_target['prospecting'] = round($field_target?->prospecting/$total_day??0,1);
        $today_target['cold_calling'] = round($field_target?->cold_calling/$total_day??0,1);
        $today_target['lead'] = round($field_target?->lead/$total_day??0,1);
        $today_target['lead_analysis'] = round($field_target?->lead_analysis/$total_day??0,1);
        $today_target['follow_up_analysis'] = round($field_target?->follow_up_analysis/$total_day??0,1);
        $today_target['negotiation_analysis'] = round($field_target?->negotiation_analysis/$total_day??0,1);
        $today_target['deposit'] = round($deposit_target/$total_day??0,1);



        // achivement   
        $my_all_employee = my_all_employee(auth()->user()->id); 
        
        $monthly_achive['freelancer'] = User::whereIn('ref_id',$my_all_employee)
            ->where('user_type',2)
            ->where('approve_by','!=',null)
            ->whereMonth('created_at',today())
            ->whereYear('created_at',today())
            ->count();

        $monthly_achive['customer'] = Customer::whereIn('ref_id',$my_all_employee)
            ->where('approve_by','!=',null)
            ->whereMonth('created_at',today())
            ->whereYear('created_at',today())
            ->count();
            
        $monthly_achive['prospecting'] = Prospecting::whereIn('employee_id',$my_all_employee)
            ->where('approve_by','!=',null)
            ->whereMonth('created_at',today())
            ->whereYear('created_at',today())
            ->count();

        $monthly_achive['cold_calling'] = ColdCalling::whereIn('employee_id',$my_all_employee)
            ->where('approve_by','!=',null)
            ->whereMonth('created_at',today())
            ->whereYear('created_at',today())
            ->count(); 

        $monthly_achive['lead'] = Lead::whereIn('employee_id',$my_all_employee)
            ->where('approve_by','!=',null)
            ->whereMonth('created_at',today())
            ->whereYear('created_at',today())
            ->count(); 

        $monthly_achive['lead_analysis'] = LeadAnalysis::whereIn('employee_id',$my_all_employee)
            ->where('approve_by','!=',null)
            ->whereMonth('created_at',today())
            ->whereYear('created_at',today())
            ->count();

        $monthly_achive['follow_up_analysis'] = FollowUpAnalysis::whereIn('employee_id',$my_all_employee)
            ->where('approve_by','!=',null)
            ->whereMonth('created_at',today())
            ->whereYear('created_at',today())
            ->count();
        
        $monthly_achive['negotiation_analysis'] = NegotiationAnalysis::whereIn('employee_id',$my_all_employee)
            ->where('approve_by','!=',null)
            ->whereMonth('created_at',today())
            ->whereYear('created_at',today())
            ->count();

        $monthly_achive['deposit']= Deposit::whereHas('customer',function($q) use($my_all_employee){
                $q->whereIn('ref_id',$my_all_employee);
            })
            ->where('approve_by','!=',null)
            ->whereMonth('created_at',today())
            ->whereYear('created_at',today())
            ->count();

        // Daily Achive 
        $today_achive['freelancer'] = User::whereIn('ref_id',$my_all_employee)
            ->where('user_type',2)
            ->where('approve_by','!=',null)
            ->whereDate('created_at',today()) 
            ->count();

        $today_achive['customer'] = Customer::whereIn('ref_id',$my_all_employee)
            ->where('approve_by','!=',null)
            ->whereDate('created_at',today()) 
            ->count();
            
        $today_achive['prospecting'] = Prospecting::whereIn('employee_id',$my_all_employee)
            ->where('approve_by','!=',null)
            ->whereDate('created_at',today()) 
            ->count();

        $today_achive['cold_calling'] = ColdCalling::whereIn('employee_id',$my_all_employee)
            ->where('approve_by','!=',null)
            ->whereDate('created_at',today()) 
            ->count(); 

        $today_achive['lead'] = Lead::whereIn('employee_id',$my_all_employee)
            ->where('approve_by','!=',null)
            ->whereDate('created_at',today()) 
            ->count(); 

        $today_achive['lead_analysis'] = LeadAnalysis::whereIn('employee_id',$my_all_employee)
            ->where('approve_by','!=',null)
            ->whereDate('created_at',today()) 
            ->count();

        $today_achive['follow_up_analysis'] = FollowUpAnalysis::whereIn('employee_id',$my_all_employee)
            ->where('approve_by','!=',null)
            ->whereDate('created_at',today()) 
            ->count();
        
        $today_achive['negotiation_analysis'] = NegotiationAnalysis::whereIn('employee_id',$my_all_employee)
            ->where('approve_by','!=',null)
            ->whereDate('created_at',today()) 
            ->count();

        $today_achive['deposit']= Deposit::whereHas('customer',function($q) use($my_all_employee){
                $q->whereIn('ref_id',$my_all_employee);
            })
            ->where('approve_by','!=',null)
            ->whereDate('created_at',today()) 
            ->count();
        
    date_default_timezone_set('Asia/Dhaka');
    $hour = date('G'); 

        if ($hour >= 5 && $hour < 12) {
            $greeting = 'Good morning';
        } elseif ($hour >= 12 && $hour < 18) {
            $greeting = 'Good afternoon';
        } else {
            $greeting = 'Good evening';
        } 
 
                    
        return view('index',compact([
            'today_tasks',
            'old_tasks',
            'field_target',
            'total_day',
            'designations',
            'today_target',
            'today_achive',
            'monthly_achive',
            'deposit_target',
            'greeting'
        ]));
    }

    public function id(){ 
        $designations = Designation::all();
        $divisions = Division::all();
        $districts = District::all();
        $upazilas = Upazila::all();
        $unions = Union::all();
        $vilages = Village::all();
        $banks = Bank::where('status',1)->get();
        $mobile_banks = Bank::where('status',2)->get(); 
        return view('ids',compact([
            'designations',
            'divisions',
            'districts',
            'upazilas',
            'unions',
            'vilages',
            'banks',
            'mobile_banks' 
        ]));
    }

    public function migrate_fresh(){  
        // exec('composer update');
        // Artisan::call('migrate:fresh');
        // Artisan::call('db:seed');  
        Artisan::call('migrate');
        return redirect()->route('index');
    }

    public function change_password(Request $request)
    { 
        $validate = Validator::make($request->all(), [
            'old_password' => 'required',
            'password'     => 'required|confirmed',
        ]); 
        if($validate->fails()){
            return redirect()->back()->with('error',$validate->errors()->first());
        } 
        $user = User::find(auth()->id());  
        if (password_verify($request->old_password, $user->password)) {
            $user->password = bcrypt($request->password);
            $user->save(); 
            return redirect()->back()->with('success', 'Password changed successfully');
        }
    
        return redirect()->back()->with('error', 'Invalid old password');
    }
}
