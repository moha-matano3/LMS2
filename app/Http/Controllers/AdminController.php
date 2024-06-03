<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Category;
use App\Models\Books;
use App\Models\Borrow;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index() {

        if (Auth::id())
        {
            $user_type = Auth()->user()->usertype;

            if ($user_type == 'admin') {
                $patron = User::where('usertype','patron') -> count();
                $admin = User::where('usertype','admin') -> count();
                $book = Books::sum('quantity');
                $borrow = Borrow::where('status','Approved')->count();
                $return = Borrow::where('status','Returned')->count();
                return view('admin.index', compact('admin','patron','book','borrow','return'));
            }else if ($user_type == 'patron') {
                $data=Books::all();
                return view('patron.index',compact('data'));
            }else {
                return redirect()->back();
            }
        }
    }

    public function category_page()
    {
        return view('admin.layouts.category');
    }

    public function add_category(Request $request)
    {
        $data= new Category;
        $data->category_name = $request->category_name;
        $data->save();
        return redirect()->back()->with('message','Category added successfully');
    }

    public function display_category()
    {
        $category = Category::all();
        return view('admin.layouts.disp_category',compact('category'));
    }

    public function category_delete($id)
    {
        $category = Category::find($id);
        $category->delete();
        return redirect()->back()->with('message','category deleted successfully');
    }

    public function edit_category($id)
    {
        $data = Category::find($id);
        return view('admin.layouts.edit_category',compact('data'));
    }

    public function update_category(Request $request, $id)
    {
        $data= Category::find($id);
        $data->category_name = $request->category_name;
        $data->save();
        return redirect('/display_category')->with('message','Category updated successfully');
    }

    public function add_book()
    {
        $data = Category::all();
        return view ('admin.layouts.add_book',compact('data'));
    }

    public function book_add(Request $request)
    {
        $data = new Books;
        $data -> book_title = $request -> book_title;
        $data -> desc = $request -> desc;
        $data -> author_name = $request -> author_name;
        $data -> price = $request -> price;
        $data -> quantity = $request -> quantity;
        $data -> shelf_place = $request -> shelf_place;
        $data -> categories_id = $request -> category;
        $book_img = $request -> book_img;
            if ($book_img)
                {
                   $book_image_name = time().'.'.$book_img->getClientOriginalExtension();
                   $request->book_img->move('book',$book_image_name);
                   $data -> book_img = $book_image_name;
                }
        $author_img = $request -> author_img;
        if ($author_img)
            {
                $author_image_name = time().'.'.$author_img->getClientOriginalExtension();
                $request->author_img->move('author',$author_image_name);
                $data -> author_img = $author_image_name;
            }
        $data -> save();
        return redirect()->back();
    }

    public function display_book()
    {
        $book = Books::all();
        return view ('admin.layouts.disp_book',compact('book'));
    }

    public function book_delete($id)
    {
        $book = Books::find($id);
        $book->delete();
        return redirect()->back()->with('message','The title has been deleted successfully');
    }

    public function edit_book($id)
    {
        $data = Books::find($id);
        $category=Category::all();
        return view('admin.layouts.edit_book',compact('data','category'));
    }

    public function update_book(Request $request, $id)
    {
        $data= Books::find($id);
        $data -> book_title = $request -> book_title;
        $data -> desc = $request -> desc;
        $data -> author_name = $request -> author_name;
        $data -> price = $request -> price;
        $data -> quantity = $request -> quantity;
        $data -> shelf_place = $request -> shelf_place;
        $data -> categories_id = $request -> category;
        $book_img = $request -> book_img;
            if ($book_img)
                {
                   $book_image_name = time().'.'.$book_img->getClientOriginalExtension();
                   $request->book_img->move('book',$book_image_name);
                   $data -> book_img = $book_image_name;
                }
        $author_img = $request -> author_img;
        if ($author_img)
            {
                $author_image_name = time().'.'.$author_img->getClientOriginalExtension();
                $request->author_img->move('author',$author_image_name);
                $data -> author_img = $author_image_name;
            }
        $data->save();

        return redirect('/display_book')->with('message','Title has been updated successfully');
    }

    public function borrow_request()
    {
        $data = Borrow::all();
        return view('admin.layouts.borrow_requests', compact('data'));
    }

    public function approve_book($id)
    {
        $data = Borrow::find($id);
        $status = $data->status;
        if ($status == 'Approved') {
            return redirect()->back();
        }
        else {
            $data -> status = 'Approved';
            $data -> due_date = Carbon::now()->addDays(3);
            $data -> save();
            $book_id = $data->books_id;
            $book = Books::find($book_id);
            $book_quantity = $book->quantity - '1';
            $book->quantity = $book_quantity;
            $book->save();
            return redirect()->back()->with('message','Borrow request approved');
        }
    }

    public function deny_book($id)
    {
        $data = Borrow::find($id);
        $data -> status = 'Rejected';
        $data -> due_date = null;
        $data -> save();
        return redirect()->back()->with('message','Request rejected');
    }

    public function return_book($id)
    {
        $data = Borrow::find($id);
        $status = $data->status;
        if ($status == 'Returned') {
            return redirect()->back();
        }
        else {
            $data -> status = 'Returned';
            $data -> due_date = null;
            $data -> save();
            $book_id = $data->books_id;
            $book = Books::find($book_id);
            $book_quantity = $book -> quantity + '1';
            $book->quantity = $book_quantity;
            $book->save();
            return redirect()->back()->with('message','Book Returned');
        }
    }
}
