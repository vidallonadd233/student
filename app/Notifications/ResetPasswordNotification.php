<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Auth\Notifications\ResetPassword as ResetPasswordNotificationBase;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Queue\SerializesModels;

class ResetPasswordNotification extends ResetPasswordNotificationBase
{
    public function toMail($notifiable)
    {
        $url = url(route('password.reset', [
            'token' => $this->token,
            'student_number' => $notifiable->student_number // Include the student number if needed
        ], false)); // false for absolute URL

        return (new MailMessage)
            ->subject('Reset Password Notification')
            ->line('You are receiving this email because we received a password reset request for your account.')
            ->action('Reset Password', $url)
            ->line('If you did not request a password reset, no further action is required.');
    }
}
