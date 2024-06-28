<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\Borrow;
use Carbon\Carbon;

class ReminderNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $borrow;
    public $due_date;

    public function __construct(Borrow $borrow)
    {
        $this->borrow = $borrow;
        $this->due_date = new Carbon($borrow->due_date);
    }

    public function build()
    {
        return $this->view('emails.reminder_notification')
                    ->with([
                        'user' => $this->borrow->user,
                        'book' =>$this->borrow->books,
                        'due_date' => $this->due_date->format('M d, Y'),
                    ])
                    ->subject('Overdue Book Reminder');
    }
}



