<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Service;
use App\Models\User;
use App\Models\UserAddress;
use App\Models\UserContact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LeadStoreController extends Controller
{
    public function services()
    { 
        $services = Service::select('id', 'service as title')->get();
        return response()->json([
            'status' => 'success',
            'data' => $services
        ]);
    }

    public function saveLead(Request $request)
    { 
        $validator = Validator::make($request->all(), [
            'name'         => 'required|string|max:255',
            'phone'        => 'required|string|max:15|unique:users,phone',
            'email'        => 'nullable|email|max:255|unique:user_contacts,email',
            'service_id'   => 'required|exists:services,id',
            'message'      => 'nullable|string|max:1000',
        ]);
         
        if ($validator->fails()) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Validation failed.',
                'errors'  => $validator->errors()
            ], 422);
        }
 
        $user = User::create([
            'name'           => $request->name,
            'phone'          => get_phone($request->phone),
            'password'       => bcrypt('123456'), 
            'user_type'      => 3, 
            'status'         => 1,
            'created_by'     => 2,
        ]);
 
        UserContact::create([
            'user_id'        => $user->id,
            'name'           => $request->name, 
            'phone'          => get_phone($request->phone),
            'email'          => $request->email,
            'created_at'     => now(), 
        ]);  

        Customer::create([
            'visitor_id'     => User::generateNextVisitorId(),
            'user_id'        => $user->id,  
            'service_id'     => $request->service_id,
            'find_media_id'  => 4, 
            'remark'         => $request->message,
            'status'         => 0,
            'created_by'     => 2,
        ]);
 
        return response()->json([
            'status'  => 'success',
            'message' => 'Thank you for submitting your information. Our team will contact you shortly.',
        ], 201);
    }

}
