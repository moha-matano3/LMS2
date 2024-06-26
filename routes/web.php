<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Mail;
use App\Mail\ReminderNotification;
use App\Http\Controllers\ReminderController;


route::get('/',[HomeController::class,'index']);

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/welcome', function () {
        return view('welcome');
    })->name('welcome');
});

Route::get('/send-reminder/{id}', [ReminderController::class, 'sendReminder'])->name('send.reminder');

Route::get('/send-reminder-notification/{id}', [ReminderController::class, 'sendReminder'])->name('send-reminder-notification');

Route::get('/send-reminder-notification', function () {
    Mail::send(new ReminderNotification());
    return view('welcome');
});

route::get('/home',[AdminController::class,'index']);

route::get('/category_page',[AdminController::class,'category_page']);

route::post('/add_category',[AdminController::class,'add_category']);

route::get('/display_category',[AdminController::class,'display_category']);

route::get('/category_delete/{id}',[AdminController::class,'category_delete']);

route::get('/edit_category/{id}',[AdminController::class,'edit_category']);

route::post('/update_category/{id}',[AdminController::class,'update_category']);

route::get('/add_book',[AdminController::class,'add_book']);

route::post('/book_add',[AdminController::class,'book_add']);

route::get('/display_book',[AdminController::class,'display_book']);

route::get('/book_delete/{id}',[AdminController::class,'book_delete']);

route::get('/edit_book/{id}',[AdminController::class,'edit_book']);

route::post('/update_book/{id}',[AdminController::class,'update_book']);

route::get('/browse_books',[HomeController::class,'browse_books']);

route::get('/borrow_books/{id}',[HomeController::class,'borrow_books']);

route::get('/borrow_request',[AdminController::class,'borrow_request']);

route::get('/extension_request',[AdminController::class,'extension_request']);

route::get('/reservation_request',[AdminController::class,'reservation_request']);

/*route::get('/reservation_request',[AdminController::class,'manageReservations']);

Route::get('reserve_book/{id}', [AdminController::class, 'reserveBook'])->name('reserve_book');
Route::get('accept_reservation/{id}', [AdminController::class, 'acceptReservation'])->name('accept_reservation');
Route::get('reject_reservation/{id}', [AdminController::class, 'rejectReservation'])->name('reject_reservation'); */


route::get('/approve_book/{id}',[AdminController::class,'approve_book']);

route::get('/approve_extension/{id}',[AdminController::class,'approve_extension']);

route::get('/reject_extension/{id}',[AdminController::class,'reject_extension']);

route::get('/approve_reservation/{id}',[AdminController::class,'approve_reservation']);

route::get('/reject_reservation/{id}',[AdminController::class,'reject_reservation']);

route::get('/borrow_book/{id}',[AdminController::class,'borrow_book']);

route::get('/deny_book/{id}',[AdminController::class,'deny_book']);

route::get('/return_book/{id}',[AdminController::class,'return_book']);

route::get('/patron_requests',[HomeController::class,'patron_requests']);

Route::get('request_extension/{id}', [HomeController::class, 'request_extension'])->name('request_extension');

Route::get('request_reservation/{id}', [HomeController::class, 'request_reservation'])->name('request_reservation');

route::get('/cancel_request/{id}',[HomeController::class,'cancel_request']);

route::get('/search_book',[HomeController::class,'search_book']);

route::get('/category_search/{id}',[HomeController::class,'category_search']);

Route::get('/about', function () {return view('about');})->name('about');

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});


// new route im adding
Route::get('/send-reminder/{id}', [ReminderController::class, 'sendReminder'])->name('send.reminder');
Route::get('/about', function () {return view('about');})->name('about');


Route::post('/updateRole/{id}', [AdminController::class, 'updateRole'])->name('updateRole');