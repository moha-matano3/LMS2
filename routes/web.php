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

route::get('/approve_book/{id}',[AdminController::class,'approve_book']);

route::get('/deny_book/{id}',[AdminController::class,'deny_book']);

route::get('/return_book/{id}',[AdminController::class,'return_book']);

route::get('/patron_requests',[HomeController::class,'patron_requests']);

route::get('/cancel_request/{id}',[HomeController::class,'cancel_request']);

route::get('/search_book',[HomeController::class,'search_book']);

route::get('/category_search/{id}',[HomeController::class,'category_search']);