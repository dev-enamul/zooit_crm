<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index()
    { 
        $notifications = Notification::where('user_id', auth()->user()->id)->orWhere('user_id',null)->paginate(10);
        return view('notification.notification_list', compact('notifications'));
    }

    public function read($id)
    {
        $notification = Notification::find($id);
        $notification->read_at = now();
        $notification->save();
        return redirect()->back();
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
