<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class ScheduleNotification extends Notification
{
    use Queueable;

    private $schedule;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($schedule)
    {
        $this->schedule = $schedule;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail']; // You can also use 'database', 'broadcast', etc.
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('Notification for Student Number: ' . $this->schedule['student_number'])
                    ->line('Grade Level: ' . $this->schedule['grade_level'])
                    ->line('Age: ' . $this->schedule['age'])
                    ->line('Gender: ' . $this->schedule['gender'])
                    ->line('Time: ' . $this->schedule['time'])
                    ->line('Date: ' . $this->schedule['date'])
                    ->line('Description: ' . $this->schedule['description'])
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'student_number' => $this->schedule['student_number'],
            'grade_level' => $this->schedule['grade_level'],
            'age' => $this->schedule['age'],
            'gender' => $this->schedule['gender'],
            'time' => $this->schedule['time'],
            'date' => $this->schedule['date'],
            'description' => $this->schedule['description'],
        ];
    }
}
