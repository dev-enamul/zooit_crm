<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Carbon\Carbon;

class DailyActivitiesMail extends Mailable
{
    use Queueable, SerializesModels;

    public $employee;
    public $activities;
    public $date; // For subject

    /**
     * Create a new message instance.
     *
     * @param $employee
     * @param $activities
     * @param string $date  (YYYY-MM-DD)
     */
    public function __construct($employee, $activities, $date)
    {
        $this->employee = $employee;
        $this->activities = $activities;
        $this->date = Carbon::parse($date)->toDateString();
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // Decide subject based on date
        $today = Carbon::now()->toDateString();
        if ($this->date == $today) {
            $subject = "Today's Jobs";
        } else {
            $subject = "Tomorrow's Jobs";
        }

        return $this->subject($subject)
                    ->view('emails.daily_activities')
                    ->with([
                        'employee' => $this->employee,
                        'activities' => $this->activities,
                        'date' => $this->date
                    ]);
    }
}
