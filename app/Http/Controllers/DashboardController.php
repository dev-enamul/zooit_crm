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
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class DashboardController extends Controller
{ 


    public function index()
    {  
        $hour = date('G'); 
        if ($hour >= 5 && $hour < 12) {
            $greeting = 'Good morning';
        } elseif ($hour >= 12 && $hour < 18) {
            $greeting = 'Good afternoon';
        } else {
            $greeting = 'Good evening';
        }

        $today = now()->toDateString();
        $authId = auth()->id();

        // --- Followups ---
        $followups = DB::table('follow_ups')
            ->join('customers', 'follow_ups.customer_id', '=', 'customers.id')
            ->join('users', 'customers.user_id', '=', 'users.id')
            ->select(
                'customers.id as customer_id',
                'users.name as customer_name',
                DB::raw("'Followup' as type"),
                'follow_ups.next_followup_date as event_datetime',
                'users.phone as phone_number', // ✅ get phone from users table
                'customers.purchase_possibility',
                DB::raw("NULL as location"),
                DB::raw("NULL as meeting_id")
            )
            ->whereDate('follow_ups.next_followup_date', '>=', $today)
            ->where('customers.ref_id', $authId)
            ->where('follow_ups.status', 0); // ✅ show only if status = 0

        // --- Meetings ---
        $meetings = DB::table('meetings')
            ->join('customers', 'meetings.customer_id', '=', 'customers.id')
            ->join('users', 'customers.user_id', '=', 'users.id')
            ->select(
                'customers.id as customer_id',
                'users.name as customer_name',
                DB::raw("'Meeting' as type"),
                'meetings.date_time as event_datetime',
                DB::raw("NULL as phone_number"), // meetings may not have phone
                'customers.purchase_possibility',
                'meetings.title as location',
                'meetings.id as meeting_id'
            )
            ->whereDate('meetings.date_time', '>=', $today)
            ->where('meetings.created_by', $authId)
            ->where('meetings.status', 0);  

        // Merge followups and meetings
        $data = $followups->unionAll($meetings)->get();

        $data = collect($data)->map(function ($item) {
            $dt = Carbon::parse($item->event_datetime);
            return [
                'customer_id' => $item->customer_id,
                'customer_name' => $item->customer_name,
                'type' => $item->type,
                'date' => $dt->toDateString(),
                'time' => $dt->format('H:i'),
                'location' => $item->location,
                'phone_number' => $item->phone_number, // from users.phone
                'purchase_possibility' => $item->purchase_possibility,
                'meeting_id' => $item->meeting_id,
            ];
        });

        // Separate today's data
        $todayData = $data->where('date', $today);

        if ($todayData->count() > 0) { 
            $futureData = $data->where('date', '>', $today)->sortBy('date')->take(10);
            $finalData = $todayData->merge($futureData)->values();
        } else { 
            $finalData = $data->sortBy('date')->take(10)->values();
        }  

        $datas = $finalData;  
        return view('index', compact('greeting', 'datas'));
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
