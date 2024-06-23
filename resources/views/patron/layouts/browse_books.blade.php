<!DOCTYPE html>
<html>
  <head> 

    <base href="/public">
    @include('patron.layouts.head')

    <style>
        .wrap {
            margin: 50px auto 0 auto;
            width: auto;
            flex-wrap: wrap;
            display: flex;
            gap: 20px;
            align-items: space-around;
            max-width: 1200px;
        }
        .tile {
            width: 300px;
            height: 420px;
            margin: 10px;
            display: inline-block;
            background-size: cover;
            position: relative;
            cursor: pointer;
            transition: all 0.4s ease-out;
            box-shadow: 0px 35px 77px -17px rgba(0,0,0,0.44);
            overflow:hidden;
            color:white;
            font-family:'Roboto';
            
            }
            .tile img
            {
            height:100%;
            width:100%;
            position:absolute;
            top:0;
            left:0;
            z-index:0;
            transition: all 0.4s ease-out;
            }
            .tile .text
            {
            position:absolute;
            padding:30px;
            height:calc(100% - 60px);
            }
            .tile h1
            {
            
            font-weight:300;
            margin:0;
            text-shadow: 2px 2px 10px rgba(0,0,0,0.3);
            }
            .tile h3
            {
            font-weight:100;
            margin:20px 0 0 0;
            font-style:italic;
            transform: translateX(200px);
        }
        .tile p {
            font-weight: 150;
            margin: 20px 0 0 0;
            line-height: 25px;
            transform: translateX(-200px);
            transition-delay: 0.2s;
        }
        .tile.disabled {
            opacity: 0.3; /* Reduced opacity */
            pointer-events: none; /* Disable pointer events */
        }
        .button {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #b5406c;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            cursor: pointer;
            transform: translateY(50px);
            opacity: 0;
            transition: all 0.6s ease-in-out;
        }
        .button:hover {
            color: #000;
            text-decoration: none;
        }
        .animate-text {
            opacity: 0;
            transition: all 0.6s ease-in-out;
        }
        .tile:hover {
            box-shadow: 0px 35px 77px -17px rgba(0, 0, 0, 0.64);
            transform: scale(1.05);
        }
        .tile:hover img {
            opacity: 0.2;
        }
        .tile:hover .animate-text {
            transform: translateX(0);
            opacity: 1;
        }
        .tile:hover .button {
            transform: translateY(0);
            opacity: 1;
            }
            .tile:hover span
            {
            opacity:1;
            transform:translateY(0px);
            }
            @media (max-width: 700px) {
                .wrap {
                    flex-direction: grid;
                    width: auto;
                }
            }
        </style>
  </head>

  <body>

    <header class="header">   
      @include('patron.layouts.header')
    </header>

    <div class="notify-container">
        <x-notify::notify />
    </div>
    
    <div class="d-flex align-items-stretch">
        <!-- Sidebar Navigation-->
        @include('patron.layouts.sidebar')
        <!-- Sidebar Navigation end-->

      <div class="page-content">
        <div class="page-header">
          <div class="container-fluid">
            <div>
              @if (session()->has('message'))
                      <div class="alert alert-success">
                      {{session()->get('message')}}
                      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                  </div>
              @endif
            </div>
            <!-- Categories dropdown    -->
            <div class="list-inline-item dropdown">
              <a id="languages" rel="nofollow" data-filter="#" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link language dropdown-toggle"><span class="d-none d-sm-inline-block">All Category</span></a>
              <div aria-labelledby="languages" class="dropdown-menu">
                @foreach ($category as $category)
                  <a href="{{url('category_search',$category->id)}}" class="dropdown-item"><span>{{$category->category_name}}</span></a>
                @endforeach
              </div>
            </div>
            <div class="wrap">
                @foreach ($data as $data)
                    <div class="tile"> 
                        <img src="book/{{$data->book_img}}">
                        <div class="text">
                            <h1>{{$data->book_title}}</h1>
                            <h3 class="animate-text">{{$data->author_name}}</h3>
                            <p class="animate-text">{{$data->desc}}</p>
                            <a href="{{url('borrow_books',$data->id)}}" class=" btn-sm button animate-text">Request</a>
                        </div>
                    </div>
                @endforeach
            </div>

           </div>
        </div>
        
       

        <footer class="footer">
          @include('patron.layouts.footer')
        </footer>

      </div>
    </div>

    @include('patron.layouts.script')
    @notifyJs
</body>
</html>
