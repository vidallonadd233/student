<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class StudentRegisteredMail extends Mailable
{
    use Queueable, SerializesModels;

    public $student;
    public function __construct($student)
    {

       $this->student = $student;


    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Student Registered Mail',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.student_registered', // ✅
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }



    public function build()
    {
        return $this->subject('Welcome to Our Platform!')
                    ->view('emails.student_registered') // ✅ Matches Blade file name
                    ->with([
                        'student_number' => $this->student->student_number ?? 'N/A',
                        'age' => $this->student->age ?? 'N/A',
                        'gender' => $this->student->gender ?? 'N/A'
                    ]);
    }

}
