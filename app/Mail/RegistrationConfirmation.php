<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use App\Models\Teacher;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class RegistrationConfirmation extends Mailable
{
    use Queueable, SerializesModels;

    public $teacher;

    public function __construct(Teacher $teacher)
    {
        $this->teacher = $teacher;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Registration Confirmation',
        );
    }

    /**
     * Get the message content definition.
     */

     public function build()
     {
         return $this->view('emails.registration_confirmation') // Specify the view for the email
                     ->with([
                         'teacherName' => $this->teacher->name, // Pass the teacher's name to the view
                     ]);
     }

    public function content(): Content
    {
        return new Content(
            view: 'view.name',
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
}
