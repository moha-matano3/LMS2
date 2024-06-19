<!DOCTYPE html>
<html>
  <head>
    @include('patron.layouts.head')

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
        width: auto;
      }
      .timer {
        color: #000;
        background-color: #fff;
        padding: 5px 10px;
        border-radius: 5px;
      }
      .timer.expired {
        color: #fff;
        background-color: #ff0000;
      }
    </style>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

  </head>

  <body>

    <header class="header">
      @include('patron.layouts.header')
    </header>

    <div class="d-flex align-items-stretch">

      <!-- Sidebar Navigation-->
      @include('patron.layouts.sidebar')
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
                        <th>Book Title</th>
                        <th>Book Image</th>
                        <th>Status</th>
                        <th>Request Date</th>
                        <th>Due Date</th>
                        <th>Timer</th>
                        <th>Cancel Request</th>
                    </tr>
                    @foreach ($data as $data)
                    <tr>
                        <td>{{$data->books->book_title}}</td>
                        <td><img class="img_book" src="book/{{$data->books->book_img}}"></td>
                        <td>{{$data->status}}</td>
                        <td>{{$data->created_at}}</td>
                        <td>{{$data->due_date}}</td>
                        <td><span class="timer" data-due="{{$data->due_date}}"></span></td>
                        <td>
                          @if ($data -> status == 'Applied' || $data -> status == 'Approved')
                            <a href="{{url('cancel_request',$data->id)}}" class="btn btn-danger">Cancel</a>
                            @else
                            <p>Cannot Cancel request</p>
                          @endif
                        </td>
                    </tr>
                    @endforeach
                </table>
            </div>
            </div>
          </div>
        </div>

        <footer class="footer">
          @include('patron.layouts.footer')
        </footer>

      </div>
    </div>

    @include('patron.layouts.script')


    <script>
      document.addEventListener('DOMContentLoaded', function() {
        var timers = document.querySelectorAll('.timer');
        timers.forEach(function(timer) {
          var dueDate = timer.getAttribute('data-due');
          if (dueDate) {
            dueDate = new Date(dueDate).getTime();
            var x = setInterval(function() {
              var now = new Date().getTime();
              var distance = dueDate - now;
              if (distance >= 0) {
                var days = Math.floor(distance / (1000 * 60 * 60 * 24));
                var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                var seconds = Math.floor((distance % (1000 * 60)) / 1000);
                timer.innerHTML = days + "d " + hours + "h " + minutes + "m " + seconds + "s ";
              } else {
                clearInterval(x);
                timer.innerHTML = "Beyond Time limit";
                timer.classList.add('expired');
              }
            }, 1000);
          }
        });
      });
    </script>


  </body>
</html>
