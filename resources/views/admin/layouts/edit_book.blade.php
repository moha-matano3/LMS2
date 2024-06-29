<!DOCTYPE html>
<html>
  <head> 
    @include('admin.layouts.head')

    <title> Edit book </title>

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
        label
        {
            display: inline-block;
            width: 200px;
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

                            <h1 id="head_title"> Update Book <h1><br>

                            <form method="post" action="{{url('update_book',$data->id)}}" enctype="multipart/form-data">
                                @csrf
                                <label> Book Title: </label>
                                <input style="font-size: 15px; padding: 10px;" type="text" name="book_title" value="{{$data->book_title}}"> <br><br>
                                <label> Book Description: </label>
                                <textarea style="font-size: 15px; padding: 10px;" name="desc">{{$data->desc}}</textarea><br><br>
                                <label> Book Author: </label>
                                <input style="font-size: 15px; padding: 10px;" type="text" name="author_name" value="{{$data->author_name}}"> <br><br>
                                <label> Price: </label>
                                <input style="font-size: 15px; padding: 10px;" type="text" name="price" value="{{$data->price}}"> <br><br>
                                <label> Quantity: </label>
                                <input style="font-size: 15px; padding: 10px;" type="text" name="quantity" value="{{$data->quantity}}"> <br><br>
                                <label> Shelf placement: </label>
                                <input style="font-size: 15px; padding: 10px;" type="text" name="shelf_place" value="{{$data->shelf_place}}"> <br><br>
                                <label> Category </label>
                                    <select name="category" style="width: 250px;">
                                        <option value="{{$data->categories_id}}">{{$data->categories->category_name}}</option>
                                        @foreach ($category as $category)
                                            <option value="{{$category->id}}">{{$category->category_name}}</option>
                                        @endforeach
                                    </select><br><br>
                                <label> Publisher Name: </label>
                                <input style="font-size: 15px; padding: 10px;" type="text" name="publisher_name" value="{{$data->publisher_name}}"> <br><br>
                                <label> Year: </label>
                                <input style="font-size: 15px; padding: 10px;" type="text" name="year" value="{{$data->year}}"> <br><br>
                                <label> Current Book Image: </label>
                                <img class="img_book" src="/book/{{$data->book_img}}"><br><br>
                                <label> Update Book Image: </label>
                                <input style="font-size: 15px; padding: 10px; width: 250px;" type="file" name="book_img"> <br>
                                <label> Current Author Image: </label>
                                <img style="width: 50px;" src="/author/{{$data->author_img}}"><br><br>
                                <label> Update Author Image: </label>
                                <input style="font-size: 15px; padding: 10px; width: 250px;" type="file" name="author_img"> <br>

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