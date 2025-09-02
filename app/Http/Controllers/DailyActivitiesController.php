<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\DailyActivitiesMail;
use Carbon\Carbon;

class DailyActivitiesController extends Controller
{
    /**
     * Send today's activities email to all employees
     */
    public function sendTodayActivitiesEmail($key)
    {
        return $this->sendActivitiesByDate($key, Carbon::now()->toDateString());
    }

    /**
     * Send next day's activities email to all employees
     */
    public function sendNextDayActivitiesEmail($key)
    {
        return $this->sendActivitiesByDate($key, Carbon::now()->addDay()->toDateString());
    }

    /**
     * Private function to send activities email for a specific date
     */
    private function sendActivitiesByDate($key, $date)
    {
        // Security check
        if($key !== env('DAILY_EMAIL_KEY')) {
            abort(403, 'Unauthorized');
        }

        $targetDate = Carbon::parse($date)->toDateString();

        // Get all employees (user_type = 1)
        $employees = DB::table('users')
                        ->where('user_type', 1)
                        ->get();

        foreach($employees as $employee) {

            // --- Followups ---
            $followups = DB::table('follow_ups')
                ->join('customers','follow_ups.customer_id','=','customers.id')
                ->join('users','customers.user_id','=','users.id')
                ->select(
                    'customers.id as customer_id',
                    'users.name as customer_name',
                    DB::raw("'Followup' as type"),
                    'follow_ups.next_followup_date as event_datetime',
                    'users.phone as phone_number',
                    DB::raw("NULL as location"),
                    DB::raw("NULL as meeting_id")
                )
                ->whereDate('follow_ups.next_followup_date', $targetDate)
                ->where('customers.ref_id', $employee->id)
                ->where('follow_ups.status', 0)
                ->get();

            // --- Meetings ---
            $meetings = DB::table('meetings')
                ->join('customers','meetings.customer_id','=','customers.id')
                ->join('users','customers.user_id','=','users.id')
                ->select(
                    'customers.id as customer_id',
                    'users.name as customer_name',
                    DB::raw("'Meeting' as type"),
                    'meetings.date_time as event_datetime',
                    DB::raw("NULL as phone_number"),
                    'meetings.title as location',
                    'meetings.id as meeting_id'
                )
                ->whereDate('meetings.date_time', $targetDate)
                ->where('meetings.created_by', $employee->id)
                ->where('meetings.status', 0)
                ->get();

            // Merge and sort by datetime
            $activities = $followups->merge($meetings)->sortBy('event_datetime')->values();

            // Send email if any activity exists
            if($activities->count() > 0) { 
                Mail::to($employee->email)
                    ->send(new DailyActivitiesMail($employee, $activities, $targetDate));
            }
        }

        return response()->json([
            'message' => "Activities email sent successfully for date: {$targetDate}"
        ]);
    }
}
