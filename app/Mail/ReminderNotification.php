<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ReminderNotification extends Mailable
{
    use Queueable, SerializesModels;
       //my new latest mods
    public $user;

    /**
     * Create a new message instance.
     */
    public function __construct($user)
    {
        $this->user = $user;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Remindernotification',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.reminder_notification',
        );
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->from('matanomohamed3@gmail.com')
                    // ->to('gribzbadi@gmail.com','christabelmuhanda93@gmail.com','matanomohamed3@students.uonbi.ac.ke')
                    ->to($this->user->email)
                    ->subject('Dear member your time is almost up, please endeavour to return')
                    ->view('emails.reminder_notification')
                    ->with(['user' => $this->user]);
                    
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
