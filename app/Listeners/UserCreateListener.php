<?php

namespace App\Listeners;

use App\Jobs\UserReportingUpdate;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UserCreateListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(object $event): void
    {
        $my_all_employee = my_all_employee($event->user_id);
        $user_reporting = user_reporting($event->user_id);
        
        $users = array_merge($my_all_employee, $user_reporting);
        foreach($users as $user){
            UserReportingUpdate::dispatch($user);
        }  
    }
}
