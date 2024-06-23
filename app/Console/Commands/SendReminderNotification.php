<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Mail\ReminderNotification;
use App\Models\User; // Ensure this import is correct

class SendReminderNotification extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notifications:send-reminder';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send reminder notifications to users about overdue books.';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // Logic to send reminder notifications
        // $users = \App\Models\User::whereHas('borrows', function ($query) {
            $users = User::whereHas('borrows', function ($query) {
            $query->where('status', 'borrowed')
                  ->where('due_date', '<=', now()->addDay()); // Adjust condition as needed
        })->get();

        foreach ($users as $user) {
            Mail::to($user->email)->send(new ReminderNotification());
        }

        $this->info('Reminder notifications sent successfully.');
        return 0;
    }
}
