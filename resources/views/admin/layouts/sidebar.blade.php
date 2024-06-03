<nav id="sidebar">
        <!-- Sidebar Header-->
        <div class="sidebar-header d-flex align-items-center">
          <div class="avatar"><img src="{{asset('../images/avatar.jpg')}}" alt="..." class="img-fluid rounded-circle"></div>
          <div class="title">
            <h1 class="h5">{{Auth::user()->name}}</h1>
            <p>Hekima Library Admin</p>
          </div>
        </div>
        <!-- Sidebar Navidation Menus--><span class="heading">Main</span>
        <ul class="list-unstyled">
                <li class="active"><a href="/home"> <i class="icon-home"></i>Home </a></li>
                <li><a href="#exampledropdownDropdown" aria-expanded="false" data-toggle="collapse"> <i class="fa fa-tags"></i> Category </a>
                  <ul id="exampledropdownDropdown" class="collapse list-unstyled ">
                    <li><a href="{{url('category_page')}}">Add Category</a></li>
                    <li><a href="{{url('display_category')}}">Show Category</a></li>
                  </ul>
                </li>
                <li><a href="{{url('add_book')}}"><i class="fas fa-book"></i>Add Book</a></li>
                <li><a href="{{url('display_book')}}"><i class="fa fa-book-open"></i>Show Books</a></li>
                <li><a href="{{url('borrow_request')}}"><i class="fas fa-paper-plane"></i>Borrow Requests</a></li>
        </ul>
      </nav>