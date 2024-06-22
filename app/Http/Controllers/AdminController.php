<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Books;
use App\Models\Borrow;
use App\Models\Category;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

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
                $borrow = Borrow::where('status','Borrowed')->count();
                $return = Borrow::where('status','Returned')->count();
                $borrowRequests = Borrow::whereIn('status', ['Applied', 'Approved'])
                                        ->join('books', 'borrows.books_id', '=', 'books.id')
                                        ->join('users', 'borrows.users_id', '=', 'users.id')
                                        ->select('books.book_title as book_title', 'users.name as username', 'borrows.status')
                                        ->get();
                $extensionRequests = Borrow::whereIn('extension_status', ['Pending'])
                                        ->join('books as b', 'borrows.books_id', '=', 'b.id')
                                        ->join('users as u', 'borrows.users_id', '=', 'u.id')
                                        ->select('b.book_title as book_title', 'u.name as username', 'borrows.status', 'borrows.due_date')
                                        ->get();
                return view('admin.index', compact('admin','patron','book','borrow','return','borrowRequests','extensionRequests'));
            }else if ($user_type == 'patron') {
                $data=Books::all();
                $latestBooks = Books::orderBy('created_at', 'desc')->take(3)->get();
                return view('patron.index',compact('data','latestBooks'));
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
        $category = Category::orderBy('category_name', 'asc')->get();
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
        // Validate input
        $validator = Validator::make($request->all(), [
            'book_title' => 'required|string|max:255',
            'book_img' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'desc' => 'required|string',
            'author_name' => 'required|string|max:255',
            'author_img' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'price' => 'required|integer',
            'quantity' => 'required|integer',
            'shelf_place' => 'required|string|max:255',
            'publisher_name' => 'nullable|string|max:255',
            'year' => 'nullable|integer',
            'pg_rating' => 'required|in:PG,18+,R',
            'category' => 'required|exists:categories,id',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Handle file uploads
        $book_img = $request->file('book_img');
        $author_img = $request->file('author_img');

        $book = new Books;
        $book->book_title = $request->input('book_title');
        $book->desc = $request->input('desc');
        $book->author_name = $request->input('author_name');
        $book->price = $request->input('price');
        $book->quantity = $request->input('quantity');
        $book->shelf_place = $request->input('shelf_place');
        $book->publisher_name = $request->input('publisher_name');
        $book->year = $request->input('year');
        $book->pg_rating = $request->input('pg_rating');
        $book->categories_id = $request->input('category');

        if ($book_img) {
            $book_image_name = time().'.'.$book_img->getClientOriginalExtension();
            $book_img->move('book', $book_image_name);
            $book->book_img = $book_image_name;
        }

        if ($author_img) {
            $author_image_name = time().'.'.$author_img->getClientOriginalExtension();
            $author_img->move('author', $author_image_name);
            $book->author_img = $author_image_name;
        }

        $book->save();

        return redirect()->back()->with('message', 'Book added successfully!');
    }

    public function display_book()
    {
        $book = Books::orderBy('shelf_place', 'asc')->get();
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
        $data = Borrow::where('status', '!=', 'Pending')->get();
        return view('admin.layouts.borrow_requests', compact('data'));
    }

    public function extension_request()
    {
        $data = Borrow::where('extension_status', '!=', 'none')->get();
        return view('admin.layouts.extension_requests', compact('data'));
    }

    public function reservation_request()
    {
        $data = Borrow::where('reservation_status', 'pending')->orderBy('created_at', 'desc')->get();
        return view('admin.layouts.reservation_requests', compact('data'));
    }

    public function approve_book($id)
    {
        $data = Borrow::find($id);
        $data -> status = 'Approved';
        $data -> save();
        $book_id = $data->books_id;
        $book = Books::find($book_id);
        $book_quantity = $book->quantity - '1';
        $book->quantity = $book_quantity;
        $book->save();
        return redirect()->back()->with('message','Borrow Request approved');
    }

    public function borrow_book($id)
    {
        $data = Borrow::find($id);
        $status = $data->status;
        if ($status == 'Borrowed') {
            return redirect()->back();
        }
        else {
            $data -> status = 'Borrowed';
            $data -> due_date = Carbon::now()->addWeek(1);
            $data -> save();
            return redirect()->back()->with('message','Request Book has been borrowed');
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
    public function approve_extension($id)
    {
       $borrow = Borrow::find($id);
       $borrow->extension_status = 'Accepted';
       $dueDate = Carbon::parse($borrow->due_date);

       // Add 3 days to the due_date
       $borrow->due_date = $dueDate->addDays(3);
       $borrow->save();
       return redirect()->back()->with('message', 'Extension approved');
    }

    public function reject_extension($id)
    {
       $borrow = Borrow::find($id);
       $borrow->extension_status = 'Rejected';
       $borrow->save();
       return redirect()->back()->with('message', 'Extension rejected');
    }

    public function approve_reservation($id)
    {
       $borrow = Borrow::find($id);
       $book = $borrow->books;
       if ($book->quantity > 0) {

        // Update book quantity
        $book->quantity -= 1;

        // Update reservation status
        $borrow->reservation_status = 'Accepted';
        $borrow->status = 'Approved';
        $borrow->save();

        return redirect()->back()->with('message', 'Reservation accepted.');
    } else {
        return redirect()->back()->with('message', 'Book quantity is insufficient.');
    }

    }

    public function reject_reservation($id)
    {
       $borrow = Borrow::find($id);
       $borrow->status = 'Rejected';
       $borrow->reservation_status = 'Rejected';
       $borrow->save();
       return redirect()->back()->with('message', 'Reservation rejected');
    }


  /*  public function reserveBook($id)
    {
        $user = auth()->user();
        $book = Books::find($id);
        $reservation = Reservation::create([
            'book_id' => $book->id,
            'user_id' => $user->id,
            'status' => 'Pending',
        ]);

        return redirect()->back()->with('message', 'Reservation request submitted.');
    }


    public function manageReservations()
    {
        $reservations = Reservation::with(['book', 'user'])->where('status', 'Pending')->orderBy('created_at')->get();
        return view('admin.layouts.reservation_requests', compact('reservations'));
    }


    public function acceptReservation($id)
    {
        // Find the reservation by id
        $reservation = Reservation::findOrFail($id);

        // Check if the book exists and has quantity > 0
        $book = Books::findOrFail($reservation->book_id);

        if ($book->quantity > 0) {
            // Create a borrow request
            Borrow::create([
                'book_id' => $book->id,
                'user_id' => $reservation->user_id,
                'status' => 'Approved'
            ]);

            // Update book quantity
            $book->quantity -= 1;
            $book->save();

            // Update reservation status
            $reservation->status = 'Accepted';
            $reservation->save();

            return redirect()->back()->with('message', 'Reservation accepted.');
        } else {
            return redirect()->back()->with('message', 'Book quantity is insufficient.');
        }
    }

    public function rejectReservation($id)
    {
        $reservation = Reservation::find($id);
        $reservation->status = 'Rejected';
        $reservation->save();

        return redirect()->back()->with('message', 'Reservation rejected.');
    } */
}
