<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Books;
use App\Models\fines;
use App\Models\Borrow;
use App\Models\Category;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use App\Mail\ApprovalNotification;
use App\Mail\ReturnNotification;
use App\Mail\ReservationNotification;
use App\Mail\extensionNotification;
use App\Mail\DissapproveNotification;
use App\Mail\ExtensiondissaprovalNotification;

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
                $borrowRequests = Borrow::whereIn('status', ['Applied', 'Approved', 'Borrowed'])
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
            }elseif ($user_type == 'super') {
                $user = User::orderBy('name', 'asc')->get();
                return view('super.index', compact('user'));
            }
            else {
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
        notify()->success('Category added successfully');
        return redirect()->back();
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
        notify()->success('Category deleted successfully');
        return redirect()->back();
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
        notify()->success('Category updated successfully');
        return redirect('/display_category');
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
        notify()->success('Book added successfully');
        return redirect()->back();
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
        notify()->success('Title has been deleted successfully');
        return redirect()->back();
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
        $data -> publisher_name = $request -> publisher_name;
        $data -> year = $request -> year;
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
        notify()->success('Title has been updated successfully');
        return redirect('/display_book');
    }

    public function borrow_request()
    {
        $data = Borrow::where('status', '!=', 'Pending')->orderBy('created_at','desc')->get();
        return view('admin.layouts.borrow_requests', compact('data'));
    }

    public function extension_request()
    {
        $data = Borrow::where('extension_status', '!=', 'none')->orderBy('created_at','asc')->get();
        return view('admin.layouts.extension_requests', compact('data'));
    }

    public function reservation_request()
    {
        $data = Borrow::where('reservation_status', 'pending')
        ->orderBy('created_at', 'asc')
        ->orderBy('books_id', 'asc')
        ->get();
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
        // Send approval notification email
        Mail::to($data->user->email)->send(new ApprovalNotification($data));
        notify()->success('Borrow request approved');
        return redirect()->back();
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
            notify()->success('Requested Book has been borrowed');
            return redirect()->back();
        }
    }

    public function deny_book($id)
    {
        $data = Borrow::find($id);
        $data -> status = 'Rejected';
        $data -> due_date = null;
        $data -> save();
        notify()->success('Request rejected');
        return redirect()->back();
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
            Mail::to($data->user->email)->send(new ReturnNotification($data));
            notify()->success('Book Returned');
            return redirect()->back();
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
       Mail::to($borrow->user->email)->send(new extensionNotification($borrow));
       notify()->success('Extension approved');
       return redirect()->back();
    }
    public function checkPendingReservations($bookId)
    {
        return Borrow::where('books_id', $bookId)
            ->where('reservation_status', 'pending')
            ->count();
    }


    public function reject_extension($id)
    {
       $borrow = Borrow::find($id);
       $borrow->extension_status = 'Rejected';
       $borrow->save();
       Mail::to($borrow->user->email)->send(new ExtensiondissaprovalNotification($borrow));
       notify()->success('Extension rejected');
       return redirect()->back();
    }

    public function approve_reservation($id)
    {
        $borrow = Borrow::find($id);
        $book = $borrow->books;
        if ($book->quantity > 0) {

        // Update book quantity
        $book->quantity -= 1;
        $book->save();

            // Update reservation status
            $borrow->reservation_status = 'Accepted';
            $borrow->status = 'Approved';
            $borrow->save();
            Mail::to($borrow->user->email)->send(new ReservationNotification($borrow));
            notify()->success('Reservation accepted');
            return redirect()->back();
        } else {
            notify()->error('Book quantity is insufficient');
            return redirect()->back();
        }

    }

    public function reject_reservation($id)
    {
       $borrow = Borrow::find($id);
       $borrow->status = 'Rejected';
       $borrow->reservation_status = 'Rejected';
       $borrow->save();
       Mail::to($borrow->user->email)->send(new DissapproveNotification($borrow));
       notify()->warning('Reservation rejected');
       return redirect()->back();
    }

    public function updateRole(Request $request, $id)
    {

        $user = User::find($id);

        if ($user) {
            $user->usertype = $request->usertype;
            $user->save();
            notify()->success('User type has been updated successfully');
        } else {
            notify()->error('User not found');
        }
        return redirect('/home');
    }

    public function fines_page()
    {
        $fines = Borrow::where('due_date', '<', Carbon::now())->get();
        return view('admin.layouts.fine', compact('fines'));
    }

    public function calculateFine($id)
    {
        $fines = Borrow::findOrFail($id);
        $dueDate = Carbon::parse($fines->due_date);
        $today = Carbon::now();

        if ($today->gt($dueDate)) {
            $daysOverdue = $today->diffInDays($dueDate);
            $fineAmount = $daysOverdue * 200;
            $formattedFineAmount = number_format($fineAmount, 2);

            $fine = fines::updateOrCreate([
                'borrows_id' => $fines->id,
                'amount' => $fineAmount,
            ]);

            return response()->json(['amount' => $formattedFineAmount]);
        }

        return response()->json(['amount' => number_format(0, 2)]);
    }
}