<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\FollowUp;
use App\Models\Rejection;
use App\Models\User;
use App\Models\UserAddress;
use App\Models\UserContact;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ApiUserController extends Controller
{
    public function users() {
        $users = User::select('id', 'user_id', 'name', 'phone', 'profile_image')->paginate(20); 
        return response()->json([
            'success' => true,
            'message' => 'User list retrieved successfully',
            'data' => $users
        ]);
    }

    public function findUser(Request $request)
    {
     
        $user = User::where('phone', $request->phone)->first();
      
        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'User not found'
            ], 404);
        }
    
        $customer = Customer::where('user_id', $user->id)->first();
    
        $last_followup = null;
    
        if ($customer) {
            $followup = FollowUp::where('customer_id', $customer->id)->latest()->first();
            $last_followup = $followup ? $followup->remark : null;
        }
    
        $data = [
            'id' => $user->id,
            'user_id' => $user->user_id,
            'name' => $user->name,
            'profile_image' => $user->profile_image,
            'remark' => $last_followup,
        ];
    
        return response()->json([
            'success' => true,
            'message' => 'User info retrieved successfully',
            'data' => $data
        ]);
    } 


    public function save(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'        => 'required|string|max:255',
            'phone'       => 'required|string|max:25|unique:users,phone',
            'service_id'  => 'nullable|integer',
            'remark'      => 'nullable|string|max:500',
            'address'     => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()->first(),
                'errors'  => $validator->errors()
            ], 422);
        }

        DB::beginTransaction();

        try {
            $phone = get_phone($request->phone);

            $user = User::create([
                'name'       => $request->name,
                'phone'      => $phone,
                'password'   => bcrypt('123456'),
                'user_type'  => 3,
                'status'     => 1,
                'created_by' => auth()->id(),
            ]);

            UserContact::create([
                'user_id'    => $user->id,
                'name'       => $request->name,
                'type'       => 2,
                'phone'      => $phone,
                'created_at' => now(),
            ]);

            UserAddress::create([
                'user_id' => $user->id,
                'address' => $request->address,
            ]);

            Customer::create([
                'visitor_id'    => User::generateNextVisitorId(),
                'user_id'       => $user->id,
                'ref_id'        => auth()->id(),
                'service_id'    => $request->service_id,
                'find_media_id' => 4,
                'type'          => 2,
                'remark'        => $request->remark,
                'status'        => 0,
                'created_by'    => auth()->id(),
            ]);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'User has been saved successfully.'
            ]);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'success' => false,
                'message' => 'User not saved.',
                'error'   => $e->getMessage() // You can hide this in production
            ], 500);
        }
    }  

    public function followupSave(Request $request) {
        $validator = Validator::make($request->all(), [
            'user_id'                  => 'required',   
            'next_followup_date'        => 'required',
            'remark'                    => 'nullable',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator)->with('error', $validator->errors()->first());
        }
        $customer = Customer::where('user_id',$request->user_id)->first();

        if (!$customer) {
            return response()->json([
                'success' => false,
                'message' => 'Customer not found'
            ], 404);
        }

        $follow                     = new FollowUp();
        $follow->customer_id        = $customer->id;
        $follow->employee_id        = Auth::user()->id;
        $follow->purchase_possibility  = 0;  
        $follow->next_followup_date = $request->next_followup_date;
        $follow->remark             = $request->remark; 
        $follow->approve_by = auth()->user()->id; 
        $follow->created_by = auth()->id();
        $follow->created_at = now();
        $follow->status     = 0;
        $follow->save();   
        if ($follow) { 
            $customer->status =1;
            $customer->save(); 
            $rejection = Rejection::where('customer_id',$customer->id)->first();
            if($rejection){
                $rejection->status = 1;
                $rejection->save(); 
            }
            
        } 
        return response()->json([
            'success' => true,
            'message' => 'Followup Saved', 
        ], 500);
    }

    public function followup(FollowUp $model)
    {
        $today = now()->startOfDay();
        $future_date = now()->addDays(7)->endOfDay();

        $query = $model
            ->select('follow_ups.*')
            ->where('status', 0)
            ->where(function ($q) {
                $q->where('approve_by', '!=', null)
                ->orWhere('employee_id', Auth::id())
                ->orWhere('created_by', Auth::id());
            })
            ->where(function ($q) use ($today, $future_date) {
                $q->where('next_followup_date', '<', $today)
                ->orWhereBetween('next_followup_date', [$today, $future_date]);
            })
            ->with([
                'customer.service', // add this for service_name
                'customer.user',    // for name and profile_image
            ])
            ->join(
                DB::raw('(SELECT MAX(id) as latest_id FROM follow_ups GROUP BY customer_id) latest'),
                'follow_ups.id',
                '=',
                DB::raw('latest.latest_id')
            )
            ->orderBy('next_followup_date', 'asc');

        $paginated = $query->paginate(10);

        // transform only necessary fields
        $paginated->getCollection()->transform(function ($item) {
            return [
                'id' => @$item->customer->user_id,
                'name' => optional($item->customer->user)->name,
                'service_name' => optional($item->customer->service)->name,
                'profile_image' => optional($item->customer->user)->profile_image,
                'followupdate' => $item->next_followup_date,
            ];
        });

        return $paginated;
    } 
}
