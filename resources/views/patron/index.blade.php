<!DOCTYPE html>
<html>
  <head> 

  <title> Member Dash</title>
    @include('patron.layouts.head')
  </head>

  <body>

    <header class="header">   
      @include('patron.layouts.header')
    </header>

    <div class="d-flex align-items-stretch">

      <!-- Sidebar Navigation-->
      @include('patron.layouts.sidebar')
      <!-- Sidebar Navigation end-->

      <div class="page-content">
        <div class="page-header">
          <div class="container-fluid">
            <h2 class="h5 no-margin-bottom">Dashboard</h2>
          </div>
        </div>
        
      
        @include('patron.layouts.body') 

        <footer class="footer">
          @include('patron.layouts.footer')
        </footer>

      </div>
    </div>
    
    @include('patron.layouts.script')

  </body>
</html>