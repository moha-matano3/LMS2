<nav id="sidebar">
        <!-- Sidebar Header-->
        <div class="sidebar-header d-flex align-items-center">
          <div class="avatar"><img src="{{ Auth::user()->profile_photo_url }}" alt="..." class="img-fluid rounded-circle"></div>
          <div class="title">
            <h1 class="h5">{{Auth::user()->name}}</h1>
            <p>Hekima Library Admin</p>
          </div>
        </div>
        <!-- Sidebar Navidation Menus--><span class="heading">Main</span>
        <ul class="list-unstyled">
            <li class="{{ request()->is('home') ? 'active' : '' }}">
                <a href="/home"><i class="icon-home"></i> Home </a>
            </li>
            <li>
                <a href="#exampledropdownDropdown" aria-expanded="false" data-toggle="collapse" class="{{ request()->is('category_page') || request()->is('display_category') ? '' : 'collapsed' }}">
                    <i class="fa fa-tag"></i> Category
                </a>
                <ul id="exampledropdownDropdown" class="collapse list-unstyled {{ request()->is('category_page') || request()->is('display_category') ? 'show' : '' }}">
                    <li class="{{ request()->is('category_page') ? 'active' : '' }}">
                        <a href="{{ url('category_page') }}">Add Category</a>
                    </li>
                    <li class="{{ request()->is('display_category') ? 'active' : '' }}">
                        <a href="{{ url('display_category') }}">Show Category</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#examplebookdropdownDropdown" aria-expanded="false" data-toggle="collapse" class="{{ request()->is('add_book') || request()->is('display_book') ? '' : 'collapsed' }}">
                    <i class="fa fa-book"></i> Books
                </a>
                <ul id="examplebookdropdownDropdown" class="collapse list-unstyled {{ request()->is('add_book') || request()->is('display_book') ? 'show' : '' }}">
                    <li class="{{ request()->is('add_book') ? 'active' : '' }}">
                        <a href="{{ url('add_book') }}">Add Book</a>
                    </li>
                    <li class="{{ request()->is('display_book') ? 'active' : '' }}">
                        <a href="{{ url('display_book') }}">Show Books</a>
                    </li>
                </ul>
            </li>
            <li class="{{ request()->is('borrow_request') ? 'active' : '' }}">
                <a href="{{ url('borrow_request') }}"><i class="fas fa-paper-plane"></i> Borrow Requests</a>
            </li>
<<<<<<< HEAD
=======
            <li class="{{ request()->is('extension_request') ? 'active' : '' }}">
                <a href="{{ url('extension_request') }}"><i class="fas fa-clock-o"></i> Extension Requests</a>
            </li>
            <li class="{{ request()->is('reservation_request') ? 'active' : '' }}">
                <a href="{{ url('reservation_request') }}"><i class="fas fa-calendar-check-o"></i> Reservation Requests</a>
            </li>
        </ul><span class="heading">Extras</span>
        <ul class="list-unstyled">
            <li class="{{ request()->is('extension_request') ? 'active' : '' }}">
                <a href="{{ route('profile.show') }}"> <i class="icon-settings"></i>Update Profile </a>
            </li>
>>>>>>> a20294a795d252514ff800654ae33511a366418c
        </ul>


      </nav>
