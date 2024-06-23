<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Books;
use App\Models\Borrow;
use App\Models\Category;
use App\Models\User;

use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        return view('welcome');
    }

    public function browse_books()
    {
        $data = Books::all();
        $category = Category::orderBy('category_name', 'asc')->get();
        return view ('patron.layouts.browse_books',compact('data','category'));
    }
    public function borrow_books($id)
    {
        $user_id = Auth::id();
        $existing_borrow = Borrow::where('users_id', $user_id)
                              ->where('books_id', $id)
                              ->whereIn('status', ['Approved', 'Applied', 'Borrowed'])
                              ->first();

        if ($existing_borrow) {
            //  return redirect()->back()->with('message', 'You have already requested or borrowed this book.');
             notify()->error('You have already requested or borrowed this book.');
             return redirect()->back();
        }
        else {
            $data = Books::find($id);
            $book_id = $id;
            $quantity = $data -> quantity;
            if ($quantity >= '1') {
                if (Auth::id()) {
                    $user_id = Auth::user()->id;
                    $borrow = new Borrow;
                    $borrow -> books_id = $book_id;
                    $borrow -> users_id = $user_id;
                    $borrow -> status = 'Applied';
                    $borrow -> due_date;
                    $borrow -> save();
                    notify()->success('Request sent to Admin');
                    return redirect() -> back(); 
                    
                }
                else {
                    return redirect('/login');
                }
            }
            else {
                return redirect() -> back() -> with('message','Not Enough books, kindly wait');
            }
        }
    }

    public function patron_requests()
    {
        if (Auth::id()) {
            $user_id = Auth::user()->id;
            $data = Borrow::where('users_id','=',$user_id)->get();
            return view ('patron.layouts.patron_requests', compact('data'));
        }
    }

    public function cancel_request($id)
    {
        $data = Borrow::find($id);
        $data -> delete();
        return redirect() -> back() -> with('message','Request cancelled successfully');
    }
    public function request_extension($id)
    {
       $borrow = Borrow::find($id);
       $borrow->extension_status = 'pending';
       $borrow->save();
       return redirect()->back()->with('message', 'Extension request sent to Admin');
    }


    public function search_book(Request $request)
    {
        $category = Category::all();
        $search = $request -> search;
        $data = Books::where('book_title','LIKE','%'.$search.'%')->orWhere('author_name','LIKE','%'.$search.'%')->get();
        return view('patron.layouts.browse_books',compact('data','category'));
    }
    public function category_search($id)
    {
        $category = Category::all();
        $data = Books::where('categories_id',$id)->get();
        return view ('patron.layouts.browse_books',compact('data','category'));
    }

}
