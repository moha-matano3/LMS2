<!DOCTYPE html>
<html>
  <head> 
    @include('admin.layouts.head')

    <style>
        .add_form
        {
            margin: auto;
            text-align: center;
        }
        #head_title
        {
            font-size: 40px;
            font-weight: bold;
            padding: 30px;
            color: #fff;
        }
        .notify-container 
        {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 9999; /* Ensure it's above other elements */
        }
    </style>
    @notifyCss
  </head>

  <body>
        <header class="header">   
        @include('admin.layouts.header')
        </header>

        <div class="d-flex align-items-stretch">
            
            @include('admin.layouts.sidebar')

            <div class="page-content">
                <div class="page-header">
                    <div class="container-fluid">
                        <div class="add_form">

                            <div class="notify-container">
                               <x-notify::notify />
                            </div>

                            <h1 id="head_title"> Update Category <h1><br>

                            <form method="post" action="{{url('update_category',$data->id)}}">
                                @csrf
                                <label> Category Name: </label>
                                <input style="font-size: 15px; padding: 10px;" type="text" name="category_name" value="{{$data->category_name}}" required> <br><br>
                                <input class="btn btn-info" type="submit" value="Update">
                            </form>
                        </div>
                    </div>
                </div>
                <footer class="footer">
                @include('admin.layouts.footer')
                </footer>
            </div>
        </div>
        @include('admin.layouts.script')
        @notifyJs
    </body>
</html>