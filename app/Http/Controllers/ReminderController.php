<?php

namespace App\Http\Controllers;

use App\Mail\ReminderNotification;
use App\Models\Borrow;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;

class ReminderController extends Controller
{
    public function sendReminder($id)
    {   
        //pali nashuku
        $borrow = Borrow::with('user', 'books')->find($id);

        if ($borrow && $borrow->user && Carbon::parse($borrow->due_date)->isPast() && $borrow->status !== 'Returned') {
            Mail::to($borrow->user->email)->send(new ReminderNotification($borrow));
            return redirect()->back()->with('message', 'Reminder notification sent successfully.');
        }

        return $this->handleErrors($borrow);
    }

    private function handleErrors($borrow)
    {
        if (!$borrow) {
            return redirect()->back()->with('error', 'Borrow record not found.');
        }

        if (!$borrow->user) {
            return redirect()->back()->with('error', 'User associated with borrow record not found.');
        }

        if (!Carbon::parse($borrow->due_date)->isPast()) {
            return redirect()->back()->with('error', 'Cannot send reminder. Due date has not yet passed.');
        }

        if ($borrow->status === 'Returned') {
            return redirect()->back()->with('error', 'Cannot send reminder. Book has already been returned.');
        }

        return redirect()->back()->with('error', 'Cannot send reminder.');
    }
}
