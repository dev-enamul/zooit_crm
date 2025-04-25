<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
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

            // Sanctum Token
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
                'token' => $token, // Valid Sanctum token
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Invalid login credentials'
            ], 401);
        }
    }

}
