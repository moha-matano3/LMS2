<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;

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

route::get('/approve_book/{id}',[AdminController::class,'approve_book']);

<<<<<<< HEAD
=======
route::get('/approve_extension/{id}',[AdminController::class,'approve_extension']);

route::get('/reject_extension/{id}',[AdminController::class,'reject_extension']);

>>>>>>> a20294a795d252514ff800654ae33511a366418c
route::get('/borrow_book/{id}',[AdminController::class,'borrow_book']);

route::get('/deny_book/{id}',[AdminController::class,'deny_book']);

route::get('/return_book/{id}',[AdminController::class,'return_book']);

route::get('/patron_requests',[HomeController::class,'patron_requests']);

Route::get('request_extension/{id}', [HomeController::class, 'request_extension'])->name('request_extension');

route::get('/cancel_request/{id}',[HomeController::class,'cancel_request']);

route::get('/search_book',[HomeController::class,'search_book']);

route::get('/category_search/{id}',[HomeController::class,'category_search']);

<<<<<<< HEAD
Route::get('/about', function () {return view('about');})->name('about');
=======


Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
>>>>>>> a20294a795d252514ff800654ae33511a366418c
