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

          <div class="col-md-3 col-sm-6">
        <div class="statistic-block block">
          <div class="progress-details d-flex align-items-end justify-content-between">
            <div class="title">
              <div class="icon"><i class="icon-clipboard"></i></div>
              <strong>Borrow Requests</strong>
            </div>
            <div class="number dashtext-5">{{}}</div> 
          </div>
          <div class="preview">
            <a href="/borrow-requests" class="tag">View Requests</a> 
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
