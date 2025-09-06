<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider; 
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
     

    use AuthenticatesUsers;

     
    protected $redirectTo ='/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    { 
 
        $request->validate([
            'phone'    => 'required|exists:users,phone',
            'password' => 'required|string',
        ]);
    
        $credentials = $request->only('phone', 'password');
        $remember = $request->has('remember');

        $user = User::where('phone', $request->phone)->first();
        if($user->user_type!=1){
            return redirect()->route('login')->with('error', 'This user is not allowed to login here.');
        }
    
        if (Auth::attempt($credentials, $remember)) {
            return redirect()->route('index');
        }
    
        return redirect()->route('login')->with('error', 'Invalid phone or password');
    }

   

   
}
