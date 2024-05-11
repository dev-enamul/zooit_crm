<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use App\Models\NotificationUser;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index()
    { 
        $notifications = NotificationUser::where('user_id', auth()->user()->id)->latest()->paginate(10);
        return view('notification.notification_list', compact('notifications'));
    }

    public function read($id)
    {
        $notification = NotificationUser::find($id);
        $notification->read_at = now();
        $notification->save();
        if(isset($notification->notification->link)){
            return redirect($notification->notification->link);
        }else{
            return redirect()->back();
        }
    } 

    public function details($id)
    {
        try{
            $notification = Notification::find($id); 
            return view('notification.notification_details', compact('notification'));
        }catch(Exception $e){
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }
    
    public function update(Request $request, $id)
    {
        $notification = Notification::find($id);
        $notification->title = $request->title;
        $notification->content = $request->content;
        $notification->link = $request->link;
        $notification->save();
        return redirect()->back();
    }

    public function delete($id)
    {
        $notification = Notification::find($id);
        $notification->delete();
        return redirect()->back();
    }
    

    
    
}
