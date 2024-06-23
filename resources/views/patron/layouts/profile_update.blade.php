<!DOCTYPE html>
<html>
  <head>
    @include('patron.layouts.head')

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
        @include('patron.layouts.header')
        </header>

        <div class="d-flex align-items-stretch">

            @include('patron.layouts.sidebar')

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

                            <h1 id="head_title"> Update Profile <h1><br>

                            <form method="post" action="" enctype="multipart/form-data">

                                @csrf
                                @method('PUT')

                                <div>
                                    <label> Email: </label>
                                    <input style="font-size: 15px; padding: 10px; width: 250px;" id="email" type="email" name="email" :value="" required autocomplete="username" /> <br><br>
                                </div>
                                <div>
                                    <label> Phone: </label>
                                    <input style="font-size: 15px; padding: 10px; width: 250px;" id="phone" type="text" name="phone" :value="" required autocomplete="phone" /><br><br>
                                </div>
                                <div>
                                    <label> Address: </label>
                                    <input style="font-size: 15px; padding: 10px; width: 250px;" id="address" type="text" name="address" :value="}" required autocomplete="address" /><br><br>
                                </div>
                                <div>
                                    <label> Current Profile Photo: </label>
                                    <img class="img_book" src=""><br><br>
                                </div>
                                <div>
                                    <label> Update Profile Photo: </label>
                                    <input style="font-size: 15px; padding: 10px; width: 250px;" id="profile_photo" class="block mt-1 w-full" type="file" name="profile_photo" accept="image/jpeg,image/png,image/jpg,image/webp"/><br>
                                </div>

                                <input class="btn btn-primary" type="submit" value="Update Profile">
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

