<?php

namespace App\Http\Controllers;
  
use App\Models\Bank;
use App\Models\ColdCalling;
use App\Models\Customer;
use App\Models\Deposit;
use App\Models\DepositTarget;
use App\Models\Designation;  
use App\Models\District;
use App\Models\Division;
use App\Models\FieldTarget; 
use App\Models\Lead;  
use App\Models\Prospecting;
use App\Models\TaskList;
use App\Models\Union;
use App\Models\Upazila;
use App\Models\User;
use App\Models\Village; 
use Carbon\Carbon;  
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class DashboardController extends Controller
{
    // public function index(NegotiationAnalysisDataTable $dataTable, Request $request)
    // { 
    //     $title = 'Negotiation Analysis'; 
    //     $date = $request->date??null;
    //     $status = $request->status??0;
    //     $start_date = Carbon::parse($date ? explode(' - ',$date)[0] : date('Y-m-01'))->format('Y-m-d');
    //     $end_date = Carbon::parse($date ? explode(' - ',$date)[1] : date('Y-m-t'))->format('Y-m-d'); 
    //     $employee = $request->employee??null;
    //     $employee = $employee ? User::find($employee)?? User::find(auth()->user()->id) :  User::find(auth()->user()->id);
    //     return $dataTable->render('displaydata', compact('title','employee','status','start_date','end_date'));
    // }  



    public function index(){   
        date_default_timezone_set('Asia/Dhaka');
        $hour = date('G');  
        if ($hour >= 5 && $hour < 12) {
            $greeting = 'Good morning';
        } elseif ($hour >= 12 && $hour < 18) {
            $greeting = 'Good afternoon';
        } else {
            $greeting = 'Good evening';
        }           
        return view('index',compact(['greeting']));
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
        
        // $user_reporting = ReportingUser::latest()->first();
        // dd($user_reporting);

        exec('composer update');
        dd('Yes');
        
        // Artisan::call('db:seed');  
        // Artisan::call('migrate');
        // Artisan::call('storage:link');
        
        // Artisan::call('cache:clear');
        // Artisan::call('config:clear');
        // Artisan::call('route:clear');
        // Artisan::call('view:clear');
        // Artisan::call('clear-compiled'); 
        // Artisan::call('optimize:clear');
        
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

    public function bypass($id){
       
        $id = decrypt($id);
        $user = User::find($id);
        
        Auth::login($user);
        return redirect()->route('index');
    }
}
