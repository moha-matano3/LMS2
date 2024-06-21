<section class="no-padding-top no-padding-bottom">
          <div class="container-fluid">
            <div class="row">
              <div class="col-md-3 col-sm-6">
                <div class="statistic-block block">
                  <div class="progress-details d-flex align-items-end justify-content-between">
                    <div class="title">
                      <div class="icon"><i class="icon-user-1"></i></div><strong>No. of Members</strong>
                    </div>
                    <div class="number dashtext-1">{{$patron}}</div>
                  </div>
                </div>
              </div>
              <div class="col-md-3 col-sm-6">
                <div class="statistic-block block">
                  <div class="progress-details d-flex align-items-end justify-content-between">
                    <div class="title">
                      <div class="icon"><i class="icon-user-1"></i></div><strong>No. of Admins</strong>
                    </div>
                    <div class="number dashtext-2">{{$admin}}</div>
                  </div>
                </div>
              </div>
              <div class="col-md-3 col-sm-6">
                <div class="statistic-block block">
                  <div class="progress-details d-flex align-items-end justify-content-between">
                    <div class="title">
                      <div class="icon"><i class="icon-contract"></i></div><strong>Books Available</strong>
                    </div>
                    <div class="number dashtext-3">{{$book}}</div>
                  </div>
                </div>
              </div>
              <div class="col-md-3 col-sm-6">
                <div class="statistic-block block">
                  <div class="progress-details d-flex align-items-end justify-content-between">
                    <div class="title">
                      <div class="icon"><i class="icon-paper-and-pencil"></i></div><strong>Borrowed Books</strong>
                    </div>
                    <div class="number dashtext-4">{{$borrow}}</div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <section class="no-padding-top no-padding-bottom">
  <div class="container-fluid">
    <div class="row">
      
      <div class="col-md-6">
        <div class="statistic-block block">
          <div class="progress-details d-flex align-items-end justify-content-between">
            <div class="title">
              <div class="icon"><i class="icon-clipboard"></i></div>
              <strong>Borrow Requests</strong>
            </div>
          </div>
          
          <div class="borrow-request-preview">
            <table class="table">
              <thead>
                <tr>
                  <th>Book Title</th>
                  <th>Member Name</th>
                  <th>Status</th>
                </tr>
              </thead>
              <tbody>
                @foreach($borrowRequests as $request)
                  <tr>
                    <td>{{ $request->book_title }}</td>
                    <td>{{ $request->username }}</td>
                    <td>{{ $request->status }}</td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div><br>
          <div class="preview">
            <a href="{{ url('borrow_request') }}" class="tag">View All Borrow Requests</a> 
          </div>
        </div>
      </div>

      
      <div class="col-md-6">
        <div class="statistic-block block">
          <div class="progress-details d-flex align-items-end justify-content-between">
            <div class="title">
              <div class="icon"><i class="icon-clipboard"></i></div>
              <strong>Extension Requests</strong>
            </div>
          </div>
          
          <div class="borrow-request-preview">
            <table class="table">
              <thead>
                <tr>
                  <th>Book Title</th>
                  <th>Member Name</th>
                  <th>Status</th>
                  <th>Due Date</th>
                </tr>
              </thead>
              <tbody>
                @foreach($extensionRequests as $request)
                  <tr>
                    <td>{{ $request->book_title }}</td>
                    <td>{{ $request->username }}</td>
                    <td>{{ $request->status }}</td>
                    <td>{{ $request->due_date }}</td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div><br>
          <div class="preview">
            <a href="{{ url('extension_request') }}" class="tag">View All Extension Requests</a> 
          </div>
        </div>
      </div>
    </div>
  </div>
        
    </div>
    </div>
</section>
