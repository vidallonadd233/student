<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ScheduleCreatedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $schedule;

    /**
     * Create a new message instance.
     */
    public function __construct($schedule)
    {
        $this->schedule = $schedule;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->subject('New Schedule Created')
                    ->view('emails.schedule_created')
                    ->with([
                        'student_number' => $this->schedule['student_number'],
                        'grade_level' => $this->schedule['grade_level'],
                        'date' => $this->schedule['date'],
                        'time' => $this->schedule['time'],
                        'description' => $this->schedule['description'],
                    ]);
    }
}
