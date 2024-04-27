<?php

namespace App\Jobs;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class UserReportingUpdate implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public $user_id;
    public function __construct($user_id)
    {
        $this->user_id = $user_id;
    }

    /**
     * Execute the job.
     */
    public function handle():void 
    { 
        $my_all_employee = my_all_employee($this->user_id);
        $user_reporting = user_reporting($this->user_id); 
        User::where('id', $this->user_id)
            ->update(['user_reporting' => $user_reporting, 'user_employee' => $my_all_employee]);
  
    }
}
