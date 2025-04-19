<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class StudentStatusMail extends Mailable
{
    use Queueable, SerializesModels;

    public $student;
    public $statusMessage;

    public function __construct($student, $statusMessage)
    {
        $this->student = $student;
        $this->statusMessage = $statusMessage;
    }

    public function build()
    {
        return $this->subject('Student Status Update')
                    ->view('emails.status');
    }
}
