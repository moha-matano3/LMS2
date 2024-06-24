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
        width: 100px;
        height: auto;
      }
      .notify-container 
        {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 9999; /* Ensure it's above other elements */
        }
    </style>

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    @notifyCss
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

              <div class="notify-container">
                <x-notify::notify />
              </div>

            <div class= "table-responsive">
              <table class="table">
                <thead>
                  <tr>
                        <th>Title</th>
                        <th>Book Image</th>
                        <th>Description</th>
                        <th>Author</th>
                        <th>Author Image</th>
                        <th>PG Rating</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Category</th>
                        <th>Publisher</th>
                        <th>Year</th>
                        <th>Shelf placement</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                  @foreach ($book as $book)
                    <tr>
                        <td style="font-weight: bold;">{{$book->book_title}}</td>
                        <td><img class="img_book" src="book/{{$book->book_img}}"></td>
                        <td>{{$book->desc}}</td>
                        <td>{{$book->author_name}}</td>
                        <td><img class="img-thumbnail" src="author/{{$book->author_img}}"></td>
                        <td>{{$book->pg_rating}}</td>
                        <td>{{$book->price}}</td>
                        <td>{{$book->quantity}}</td>
                        <td>{{$book->categories->category_name}}</td>
                        <td>{{$book->publisher_name}}</td>
                        <td>{{$book->year}}</td>
                        <td>{{$book->shelf_place}}</td>
                        <td><a onclick="confirmation(event)" class="btn btn-danger" href="{{url('book_delete',$book->id)}}">Delete</a></td>
                        <td><a class="btn btn-info" href="{{url('edit_book',$book->id)}}">Edit</a></td>
                    </tr>
                    @endforeach
                </tbody>

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

    <script>
      function confirmation(ev) {
        ev.preventDefault();
        var urlToRedirect = ev.currentTarget.getAttribute('href');
        console.log(urlToRedirect);

        swal({
            title: "Are you sure you want to delete this title?",
            text: "You will not be able to revert this...",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }).then((willDelete) => {
            if (willDelete) {
                window.location.href = urlToRedirect;
            }
        });
      }

    </script>

    @include('admin.layouts.script')
      @notifyJs
  </body>
</html>
