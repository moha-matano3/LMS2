<?php

namespace App\Http\Controllers;

use App\Mail\ReminderNotification;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;

class ReminderController extends Controller
{
    public function sendReminder($id)
    {
        $user = User::find($id);

        if ($user) {
            Mail::to($user->email)->send(new ReminderNotification($user));
            return redirect()->back()->with('message', 'Reminder notification sent successfully.');
        }

        return redirect()->back()->with('error', 'User not found.');
    }
}
