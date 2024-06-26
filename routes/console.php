<?php

use Illuminate\Console\Scheduling\Schedule;
use App\Console\Commands\SendReminderNotification;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Mail;
use App\Mail\ReminderNotification;
use App\Models\User;
use Carbon\Carbon;
use App\Console\Commands\SendReminders;


Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->describe('Display an inspiring quote');


Artisan::command('notifications:send-reminder', function () {
    $users = User::whereHas('borrows', function ($query) {
        $query->where('status', 'borrowed')
              ->where('due_date', '<=', now()->addDay());
    })->get();

    foreach ($users as $user) {
        Mail::to($user->email)->send(new ReminderNotification($user));
    }

    $this->info('Reminder notifications sent successfully.');
})->describe('Send reminder notifications to users whose borrowing period is almost up');

// Register the command(s)
Artisan::command('send:reminders', function () {
    $this->info('Sending daily reminders...');
    $this->call(SendReminders::class);
})->describe('Send daily reminders to users.');


// Schedule the command
app(Schedule::class)->command('notifications:send-reminder')->daily();

$schedule = new Schedule(app());
$schedule->command('send:reminders')
         ->daily();