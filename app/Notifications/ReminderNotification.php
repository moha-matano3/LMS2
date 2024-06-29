<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ReminderNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct()
    {
        //
    }

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
        ->subject('Reminder: Return Borrowed Book')
        ->line('Dear member,')
        ->line('Your borrowed book is due soon. Please return it to the library.')
        ->action('View Library', url('/'))
        ->line('Thank you for using our library services.');
    }


    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
