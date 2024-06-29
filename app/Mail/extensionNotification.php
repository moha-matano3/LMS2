<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class extensionNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $borrow;

    /**
     * Create a new message instance.
     *
     * @param  mixed  $borrow
     * @return void
     */
    public function __construct($borrow)
    {
        $this->borrow = $borrow;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Time Extension Approval')
                    ->view('emails.extension_notification')
                    ->with([
                        'user' => $this->borrow->user,
                        'book' => $this->borrow->books,
                        'due_date' => $this->borrow->due_date->format('M d, Y H:i:s'),
                        
                    ]);
    }
}
