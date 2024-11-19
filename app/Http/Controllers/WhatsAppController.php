<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Twilio\Rest\Client;
use Illuminate\Support\Facades\Validator;

class WhatsAppController extends Controller
{
    public function index() 
    { 
        return view('whatsapp'); 
    } 

    public function store(Request $request) 
    {  
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|integer|exists:users,id',  
            'message' => 'required|string|max:1000',  
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator)->with('error', $validator->errors()->first());
        } 
        
        $user = User::find($request->user_id);
        $number = $user->phone;  
        $number = preg_replace('/\D/', '', $number); 
        if (strlen($number) != 11) { 
            return back()->with(['error' => "Whatsapp number invalid"]); 
        }   
        $twilioSid = env('TWILIO_SID'); 
        $twilioToken = env('TWILIO_AUTH_TOKEN'); 
        $twilioWhatsAppNumber = env('TWILIO_WHATSAPP_NUMBER'); 
        $recipientNumber = "whatsapp:+88".$number;  
        $message = $request->message; 
        try {
            $twilio = new Client($twilioSid, $twilioToken); 
            $twilio->messages->create( 
                $recipientNumber, 
                [ 
                    "from" => $twilioWhatsAppNumber, 
                    "body" => $message, 
                ] 
            );  
            return back()->with(['success' => 'WhatsApp message sent successfully!']); 
        } catch (Exception $e) { 
            return back()->with(['error' => $e->getMessage()]); 
        }

    }
}
