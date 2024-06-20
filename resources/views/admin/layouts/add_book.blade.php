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

                            <div>
                                @if (session()->has('message'))
                                    <div class="alert alert-success">
                                        {{session()->get('message')}}
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                                    </div>
                                @endif
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
                                    <textarea style="font-size: 15px; padding: 10px; width: 250px;" type="text" name="desc" placeholder="Description of book (20 words Max.)"required></textarea><br>
                                </div>
                                <div>
                                    <label> Book Author: </label>
                                    <input style="font-size: 15px; padding: 10px; width: 250px;" type="text" name="author_name" required> <br>
                                </div>
                                <div>
                                    <label> Price: </label>
                                    <input style="font-size: 15px; padding: 10px; width: 250px;" type="number" name="price" required> <br>
                                </div>
                                <div>
                                    <label> Quantity: </label>
                                    <input style="font-size: 15px; padding: 10px; width: 250px;" type="number" name="quantity" required> <br>
                                </div>
                                <div>
                                    <label> Shelf Placement: </label>
                                    <input style="font-size: 15px; padding: 10px; width: 250px;" type="text" name="shelf_place" required> <br>
                                </div>
<<<<<<< HEAD

=======
                                <div>
                                    <label> Publication: </label>
                                    <input style="font-size: 15px; padding: 10px; width: 250px;" type="text" name="publication" value="{{ old('publication') }}"><br>
                                </div>
>>>>>>> 77892e75226f90fd3341628a54bbd19a90a7c50f
                                <div>
                                    <label> Publisher Name: </label>
                                    <input style="font-size: 15px; padding: 10px; width: 250px;" type="text" name="publisher_name" value="{{ old('publisher_name') }}"><br>
                                </div>
                                <div>
                                    <label> Year: </label>
                                    <input style="font-size: 15px; padding: 10px; width: 250px;" type="number" name="year" value="{{ old('year') }}"><br>
                                </div>
<<<<<<< HEAD

                                <div>
                                    <label> Rating: </label>
                                    <select name="pg_rating" style="width: 250px;" required>
                                        <option> Select a rating </option>
=======
                                <div>
                                    <label> Editor: </label>
                                    <input style="font-size: 15px; padding: 10px; width: 250px;" type="text" name="editor" value="{{ old('editor') }}"><br>
                                </div>
                                <div>
                                    <label> PG Rating: </label>
                                    <select name="pg_rating" style="width: 250px;" required>
>>>>>>> 77892e75226f90fd3341628a54bbd19a90a7c50f
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
                                    <input style="font-size: 15px; padding: 10px; width: 250px;" type="file" name="book_img" required> <br>
                                </div>
                                <div>
                                    <label> Author Image: </label>
                                    <input style="font-size: 15px; padding: 10px; width: 250px;" type="file" name="author_img" required> <br>
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
    </body>
</html>

