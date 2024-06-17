<nav id="sidebar">
        <!-- Sidebar Header-->
        <div class="sidebar-header d-flex align-items-center">
          <div class="avatar"><img src="{{asset('../images/avatar.jpg')}}" alt="..." class="img-fluid rounded-circle"></div>
          <div class="title">
            <h1 class="h5">{{Auth::user()->name}}</h1>
            <p>Hekima Library Patron</p>
          </div>
        </div>
        <!-- Sidebar Navidation Menus--><span class="heading">Main</span>
        <ul class="list-unstyled">
                <li class="{{ request()->is('/home') ? 'active' : '' }}"><a href="/home"> <i class="icon-home"></i>Home </a></li>
                <li class="{{ request()->is('browse_books') ? 'active' : '' }}"><a href="{{url('browse_books')}}"><i class="fas fa-folder-open"></i>Browse Books</a></li>
                <li class="{{ request()->is('patron_requests') ? 'active' : '' }}"><a href="{{url('patron_requests')}}"><i class="fas fa-paper-plane"></i>My Requests</a></li>
        </ul>
      </nav>
