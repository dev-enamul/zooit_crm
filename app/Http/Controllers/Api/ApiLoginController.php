<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ApiLoginController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'phone' => 'required',
            'password' => 'required'
        ]);

        $credentials = [
            'phone' => $request->phone,
            'password' => $request->password,
        ];

        if (Auth::attempt($credentials)) {
            $user = Auth::user(); 
            $token = $user->createToken('api-token')->plainTextToken;

            $userDetails = [
                'id' => $user->id,
                'user_id' => $user->user_id,
                'name' => $user->name,
                'phone' => $user->phone,
                'profile_image' => $user->profile_image,
            ];

            return response()->json([
                'success' => true,
                'message' => 'Login successful',
                'user' => $userDetails,
                'token' => $token,
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Invalid login credentials'
            ], 401);
        }
    }  
    
    public function logout(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:users,id',
        ]);

        try {
            $user = User::find($request->id); 
            if ($user) { 
                $user->tokens()->delete(); 
                return response()->json([
                    'success' => true,
                    'message' => 'Logout successful for user id: ' . $user->id,
                ]);
            }

            return response()->json([
                'success' => false,
                'message' => 'User not found',
            ], 404);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function changePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'old_password' => 'required|string',
            'password' => 'required|string|min:8',
            'confirm_password' => 'required|string|same:password'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $user = User::find(Auth::user()->id);

        if (!Hash::check($request->old_password, $user->password)) {
            return error_response(null,404,'Old password does not match.');
        }

        $user->password = Hash::make($request->password);
        $user->save();
        return success_response('Password changed successfully.'); 
    }
}
