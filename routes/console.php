<?php

use Illuminate\Console\Scheduling\Schedule;
use App\Console\Commands\SendReminderNotification;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Mail;
use App\Mail\ReminderNotification;
use App\Models\User;
use Carbon\Carbon;

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

// Schedule the command
app(Schedule::class)->command('notifications:send-reminder')->daily();