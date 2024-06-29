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
        label
        {
            display: inline-block;
            width: 200px;
        }
        .notify-container {
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

                            <h1 id="head_title"> Add a Book <h1><br>

                            <form method="post" action="{{url('book_add')}}" enctype="multipart/form-data">

                                @csrf

                                <div>
                                    <label> Book Title: </label>
                                    <input style="font-size: 15px; padding: 10px; width: 250px;" type="text" name="book_title" required><br><br>
                                </div>
                                <div>
                                    <label> Book Description: </label>
                                    <textarea style="font-size: 15px; padding: 10px; width: 250px;" type="text" name="desc" placeholder="Short description of book
                                    "required></textarea><br><br>
                                </div>
                                <div>
                                    <label> Book Author: </label>
                                    <input style="font-size: 15px; padding: 10px; width: 250px;" type="text" name="author_name" required> <br><br>
                                </div>
                                <div>
                                    <label> Price: </label>
                                    <input style="font-size: 15px; padding: 10px; width: 250px;" type="number" name="price" required> <br><br>
                                </div>
                                <div>
                                    <label> Quantity: </label>
                                    <input style="font-size: 15px; padding: 10px; width: 250px;" type="number" name="quantity" required> <br><br>
                                </div>
                                <div>
                                    <label> Shelf Placement: </label>
                                    <input style="font-size: 15px; padding: 10px; width: 250px;" type="text" name="shelf_place" required> <br><br>
                                </div>
                                <div>
                                    <label> Publisher Name: </label>
                                    <input style="font-size: 15px; padding: 10px; width: 250px;" type="text" name="publisher_name" value="{{ old('publisher_name') }}"><br><br>
                                </div>
                                <div>
                                    <label> Year: </label>
                                    <input style="font-size: 15px; padding: 10px; width: 250px;" type="number" name="year" value="{{ old('year') }}"><br><br>
                                </div>

                                <div>
                                    <label> Rating: </label>
                                    <select name="pg_rating" style="width: 250px;" required>
                                        <option> Select a rating </option>
                                        <option value="PG" {{ old('pg_rating') == 'PG' ? 'selected' : '' }}>PG</option>
                                        <option value="18+" {{ old('pg_rating') == '18+' ? 'selected' : '' }}>18+</option>
                                        <option value="R" {{ old('pg_rating') == 'R' ? 'selected' : '' }}>R</option>
                                    </select>
                                </div>
                                <div>
                                    <label> Category </label>
                                    <select name="category" style="width: 250px;"required>
                                        <option>Select a category</option>
                                        @foreach ($data as $data)
                                            <option value="{{$data->id}}">{{$data->category_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div>
                                    <label> Book Image: </label>
                                    <input style="font-size: 15px; padding: 10px; width: 250px;" type="file" name="book_img" required> <br><br>
                                </div>
                                <div>
                                    <label> Author Image: </label>
                                    <input style="font-size: 15px; padding: 10px; width: 250px;" type="file" name="author_img" required> <br><br>
                                </div>

                                <input class="btn btn-primary" type="submit" value="Add">
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

