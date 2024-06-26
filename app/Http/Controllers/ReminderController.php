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

<<<<<<< HEAD
        if ($borrow && $borrow->user && Carbon::parse($borrow->due_date)->isPast() && $borrow->status !== 'Borrowed') {
=======
        if ($borrow && $borrow->user && Carbon::parse($borrow->due_date)->isPast() && $borrow->status === 'Borrowed') {
>>>>>>> ef2b1542b84d1829287b5efb862973746e3b1e6e
            Mail::to($borrow->user->email)->send(new ReminderNotification($borrow));
            notify()->success('Reminder notification sent successfully.');
            return redirect()->back();
        }
        return $this->handleErrors($borrow);
    }

    private function handleErrors($borrow)
    {
        if (!$borrow) {
            notify()->error('Borrow record not found.');
            return redirect()->back();
        }

        if (!$borrow->user) {
            notify()->error('User associated with borrow record not found..');
            return redirect()->back();
        }

        if (!Carbon::parse($borrow->due_date)->isPast()) {
            notify()->error('Cannot send reminder. Due date has not yet passed.');
            return redirect()->back();
        }

        if ($borrow->status === 'Returned') {
            notify()->error('Cannot send reminder. Book has already been returned..');
            return redirect()->back();
        }
        notify()->error('Cannot send reminder.');
        return redirect()->back();
    }
}
