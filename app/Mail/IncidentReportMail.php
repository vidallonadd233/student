<?php


namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class IncidentReportMail extends Mailable
{
    use Queueable, SerializesModels;

    public $report;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($report)
    {
        $this->report = $report;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.incident_report')
                    ->subject('New Incident Report')
                    ->with('report', $this->report);
    }
}
