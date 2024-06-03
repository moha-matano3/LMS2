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
    </style>

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
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

            <table class="table">
                <tr>
                    <th>Category Name</th>
                    <th></th>
                    <th></th>
                </tr>
                @foreach ($category as $cat)
                <tr>
                    <td>{{$cat->category_name}}</td>
                    <td><a onclick="confirmation(event)" class="btn btn-danger" href="{{url('category_delete',$cat->id)}}">Delete</a></td>
                    <td><a class="btn btn-info" href="{{url('edit_category',$cat->id)}}">Edit</a></td>
                </tr>
                @endforeach
            </table>

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
            title: "Are you sure you want to delete the Category?",
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

  </body>
</html>