<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Notification extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'content', 'link','created_by','updated_by','deleted_by'];

    public function users()
    {
        return $this->belongsToMany(User::class, 'notification_users', 'notification_id', 'user_id')->withPivot('read_at');
    }
    
    public function notification_users()
    {
        return $this->hasMany(NotificationUser::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public static function store($data){
        $notification = new Notification();
        $notification->title = $data['title']??null;
        $notification->content = $data['content']??null;
        $notification->link = $data['link']??null;
        $notification->created_by = $data['created_by']??Auth::user()->id;
        $notification->save();
        foreach($data['user_id'] as $user_id){
            $notification_user = new NotificationUser();
            $notification_user->notification_id = $notification->id;
            $notification_user->user_id = $user_id;
            $notification_user->save(); 
        }
        if($notification->link==null){
            $notification->link = route('notification.details', $notification->id);
            $notification->save();
        }
    }
}
