<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>

    <style>
         *
        {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
        }
        .navbar
        {
            background: #3b3b3f;
            text-align: center;
        }
        .navbar ul
        {
            display: inline-flex;
            list-style: none;
        }
        .navbar ul li 
        {
            width: 200px;
            margin: 15px;
            padding: 15px;
        }
        .navbar ul li a
        {
            text-decoration: none;
            color: #faf9f6;
        }
        .navbar ul li:hover
        {
            background: #000;
            border-radius: 5px
        }
        .subMenu 
        {
            display: none;
        }
        .navbar ul li:hover .subMenu 
        {
            display: block;
            position: absolute;
            background: #3b3b3f;
            margin-top: 15px;
            margin-left: -15px;
        }
        .navbar ul li:hover .subMenu ul
        {
            display: block;
            margin: 10px;
        }
        .navbar ul li:hover .subMenu ul li
        {
            width: 150px;
            padding: 15px;
            border-radius: 5px;
            text-align: left;
        }
    </style>
</head>
<body>
    <div class ="navbar">
        <ul>
            <li> <a href=""> Home </a></li>
            <li> <a href=""> About </a></li>
            <li> <a href=""> Profile </a>
                <div class="subMenu">
                    <ul>
                        @if(Route::has('register'))
                            @auth
                            @else
                                <li><a href="{{ route('register') }}"> Register </a></li>
                                @if(Route::has('login'))
                                    <li><a href="{{ route('login') }}"> Login </a></li>
                                @endif
                            @endauth
                        @endif
                    </ul>
                </div>
            </li>
        </ul>
    </div>

    <div style="background: rgba(0, 0, 0, 0.5); color: #faf9f6; font-size: 50px; margin: 0; padding: 0; text-align: center; position: absolute; top: 30%; left: 50%; transform: translateX(-50%);">
            <h1><b>Hekima Community Library</b></h1>
    </div>
    <div>
        <img src="{{URL('images/lib.jpg')}}" alt="" width="auto" height="auto">
    </div>
</body>
</html>