<!DOCTYPE html>
<html>
  <head> 
    <title>Librarian Dash </title>
    
    @include('admin.layouts.head')
  </head>

  <body>

    <header class="header">   
      @include('admin.layouts.header')
    </header>

    <div class="d-flex align-items-stretch">

      <!-- Sidebar Navigation-->
      @include('admin.layouts.sidebar')
      <!-- Sidebar Navigation end-->

      <div class="page-content">
        <div class="page-header">
          <div class="container-fluid">
            <h2 class="h5 no-margin-bottom">Dashboard</h2>
          </div>
        </div>
        
        @include('admin.layouts.body')

        <footer class="footer">
          @include('admin.layouts.footer')
        </footer>

      </div>
    </div>
    
    @include('admin.layouts.script')

  </body>
</html>