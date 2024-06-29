<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ReservationNotification extends Mailable
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
        return $this->subject('Book Reservation confirmation')
                    ->view('emails.reservation_notification')
                    ->with([
                        'user' => $this->borrow->user,
                        'book' => $this->borrow->books,
                        
                    ]);
    }
}
