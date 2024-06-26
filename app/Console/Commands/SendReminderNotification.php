<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Borrow;
use App\Mail\ReminderNotification;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;

class SendReminders extends Command
{
    protected $signature = 'send:reminders';
    protected $description = 'Send reminders for overdue books';

    public function handle()
    {
        $overdueBorrows = Borrow::with('user', 'book')
            ->where('due_date', '<', Carbon::now())
            ->where('status', '!=', 'Returned')
            ->get();

        foreach ($overdueBorrows as $borrow) {
            Mail::to($borrow->user->email)->send(new ReminderNotification($borrow));
        }

        $this->info('Reminder notifications sent successfully.');
    }
}

