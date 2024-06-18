<!DOCTYPE html>
<html>
  <head>
    @include('admin.layouts.head')

    <style>
      .cat_table
      {
        text-align: center;
        margin: auto;
        width: auto;
      }
      th
      {
        background: #b5406c;

      }
      .img_book
      {
        width: 80px;
        height: auto;
      }
      table
      {
        width: 100%;
      }


    </style>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

  </head>

  <body>

    <header class="header">
      @include('admin.layouts.header')
    </header>

    <div class="d-flex align-items-stretch">

      <!-- Sidebar Navigation-->
      @include('admin.layouts.sidebar')
      <!-- Sidebar Navigation end-->

      <div class="page-content">
        <div class="page-header">
          <div class="container-fluid">
            <div class="cat_table">

            <div>
              @if (session()->has('message'))
                <div class="alert alert-success">
                  {{session()->get('message')}}
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                </div>
              @endif
            </div>

            <div class="table-responsive">
                <table class="table">
                    <tr>
                        <th>Patron's Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Book Title</th>
                        <th>Book Image</th>
                        <th>Quantity</th>
                        <th>Request Status</th>
                        <th>Request date</th>
                        <th>Review date</th>
                        <th>Due date</th>
                        <th>Actions</th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                    </tr>
                    @foreach ($data as $borrow)
                    <tr>
                        <td>{{$borrow->user->name ?? ''}}</td>
                        <td>{{$borrow->user->email ?? ''}}</td>
                        <td>{{$borrow->user->phone ?? ''}}</td>
                        <td>{{$borrow->books->book_title ?? ''}}</td>
                        <td><img class="img_book" src="book/{{$borrow->books->book_img ?? ''}}"></td>
                        <td>{{$borrow->books->quantity ?? ''}}</td>
                        <td>{{$borrow->status ?? ''}}</td>
                        <td>{{$borrow->created_at ?? ''}}</td>
                        <td>{{$borrow->updated_at ?? ''}}</td>
                        <td>{{$borrow->due_date ?? ''}}</td>
                        <td><a class="btn-sm btn-primary" href="{{url('approve_book',$borrow->id)}}" title="Approve"><i class="fas fa-check"></i></a></td>
                        <td><a class="btn-sm btn-success" href="{{url('borrow_book',$borrow->id)}}" title="Borrow"><i class="fas fa-thumbs-up"></i></a></td>
                        <td><a class="btn-sm btn-warning" href="{{url('deny_book',$borrow->id)}}" title="Deny"><i class="fas fa-thumbs-down"></i></a></td>
                        <td><a class="btn-sm btn-secondary" href="{{url('return_book',$borrow->id)}}" title="Return"><i class="fas fa-undo"></i></a></td>
                    </tr>
                    @endforeach
                </table>
            </div>
            </div>
          </div>
        </div>

        <footer class="footer">
          @include('admin.layouts.footer')
        </footer>

      </div>
    </div>

    @include('admin.layouts.script')

  </body>
</html>
