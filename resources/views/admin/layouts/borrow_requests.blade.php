<!DOCTYPE html>
<html>
<head>
    @include('admin.layouts.head')

    <style>
      .cat_table {
        text-align: center;
        margin: auto;
        width: 100%;
      }
      th {
        background: #b5406c;
        color: white;
      }
      .img_book {
        width: 80px;
        height: auto;
      }
      table {
        width: 100%;
      }
      .filter-form {
        margin-bottom: 20px;
        text-align: center;
      }
      .filter-form input,
      .filter-form select {
        margin: 5px;
        padding: 5px;
        border-radius: 5px;
        border: 1px solid #ccc;
      }
      .filter-form button {
        padding: 5px 10px;
        border-radius: 5px;
        border: none;
        background-color: #b5406c;
        color: #fff;
        cursor: pointer;
      }
      .btn-sm:disabled {
        pointer-events: none;
        opacity: 0.5;
        color: #aaa; /* Optional: change the color to a lighter grey */
      }
      @media (max-width: 768px) {

        .filter-form input,
        .filter-form select,
        .filter-form button {
          width: 100%;
          margin: 5px 0;
        }

      }

    </style>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
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
                    <div class="cat_table">

                        <div>
                            @if (session()->has('message'))
                                <div class="alert alert-success">
                                    {{ session()->get('message') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                                </div>
                            @endif
                        </div>

                        <!-- Filter Form -->
                        <div class="filter-form">
                            <form id="filterForm">
                                <input type="date" id="dueDate" name="dueDate" placeholder="Due Date">
                                <select id="status" name="status">
                                    <option value="">Select Status</option>
                                    <option value="Pending">Pending</option>
                                    <option value="Approved">Approved</option>
                                    <option value="Borrowed">Borrowed</option>
                                    <option value="Rejected">Rejected</option>
                                    <option value="Returned">Returned</option>
                                </select>
                                <button type="button" onclick="filterTable()">Filter</button>
                            </form>
                        </div>

                        <div class="table-responsive">
                            <table class="table" id="borrowTable">
                                <thead>
                                  <tr>
                                      <th>Patron's Name</th>
                                      <th>Email</th>
                                      <th>Phone</th>
                                      <th>Book Title</th>
                                      <th>Book Image</th>
                                      <th>Quantity</th>
                                      <th>Request Status</th>
                                      <th>Request date</th>
                                      <th>Review date</th>
                                      <th>Due date</th>
                                      <th>Actions</th>
                                      <th></th>
                                      <th></th>
                                      <th></th>
                                      <th></th>
                                  </tr>
                                </thead>
                                <tbody>
                                @foreach ($data as $borrow)
                                <tr>
                                    <td>{{ $borrow->user->name ?? '' }}</td>
                                    <td>{{ $borrow->user->email ?? '' }}</td>
                                    <td>{{ $borrow->user->phone ?? '' }}</td>
                                    <td>{{ $borrow->books->book_title ?? '' }}</td>
                                    <td><img class="img_book" src="book/{{ $borrow->books->book_img ?? '' }}"></td>
                                    <td>{{ $borrow->books->quantity ?? '' }}</td>
                                    <td>{{ $borrow->status ?? '' }}</td>
                                    <td>{{ $borrow->created_at ?? '' }}</td>
                                    <td>{{ $borrow->updated_at ?? '' }}</td>
                                    <td>{{ $borrow->due_date ?? '' }}</td>
                                    <td>
                                        @if($borrow->status == 'Approved' || $borrow->status == 'Borrowed' || $borrow->status == 'Rejected' || $borrow->status == 'Returned')
                                            <a class="btn-sm btn-primary disabled" href="#" title="Approve" disabled>
                                                <i class="fas fa-check"></i>
                                            </a>
                                        @else
                                            <a class="btn-sm btn-primary" href="#" onclick="confirmation(event, 'Are you sure you want to approve this book?', '{{ url('approve_book', $borrow->id) }}')" title="Approve">
                                                <i class="fas fa-check"></i>
                                            </a>
                                        @endif
                                    </td>

                                    <td>
                                        @if($borrow->status == 'Borrowed' || $borrow->status == 'Rejected' || $borrow->status == 'Returned' || $borrow->status == 'Applied')
                                            <a class="btn-sm btn-success disabled" href="#" title="Borrow" disabled>
                                                <i class="fas fa-thumbs-up"></i>
                                            </a>
                                        @else
                                            <a class="btn-sm btn-success" href="#" onclick="confirmation(event, 'Are you sure you want to borrow this book?', '{{ url('borrow_book', $borrow->id) }}')" title="Borrow">
                                                <i class="fas fa-thumbs-up"></i>
                                            </a>
                                        @endif
                                    </td>

                                    <td>
                                        @if($borrow->status == 'Rejected' || $borrow->status == 'Borrowed' || $borrow->status == 'Returned')
                                            <a class="btn-sm btn-warning disabled" href="#" title="Deny" disabled>
                                                <i class="fas fa-thumbs-down"></i>
                                            </a>
                                        @else
                                            <a class="btn-sm btn-warning" href="#" onclick="confirmation(event, 'Are you sure you want to deny this book?', '{{ url('deny_book', $borrow->id) }}')" title="Deny">
                                                <i class="fas fa-thumbs-down"></i>
                                            </a>
                                        @endif
                                    </td>

                                    <td>
                                        @if($borrow->status == 'Rejected' || $borrow->status == 'Returned' || $borrow->status == 'Approved' || $borrow->status == 'Applied')
                                            <a class="btn-sm btn-secondary disabled" href="#" title="Return" disabled>
                                                <i class="fas fa-undo"></i>
                                            </a>
                                        @else
                                            <a class="btn-sm btn-secondary" href="#" onclick="confirmation(event, 'Are you sure you want to return this book?', '{{ url('return_book', $borrow->id) }}')" title="Return">
                                                <i class="fas fa-undo"></i>
                                            </a>
                                        @endif
                                    </td>




                                </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <footer class="footer">
                @include('admin.layouts.footer')
            </footer>

        </div>
    </div>

    @include('admin.layouts.script')

    <script>
      function filterTable() {
        var dueDate = document.getElementById('dueDate').value ? new Date(document.getElementById('dueDate').value) : null;
        var status = document.getElementById('status').value;
        var table = document.getElementById('borrowTable').getElementsByTagName('tbody')[0];
        var tr = table.getElementsByTagName('tr');

        for (var i = 0; i < tr.length; i++) {
          var tdDueDate = tr[i].getElementsByTagName('td')[9];
          var tdStatus = tr[i].getElementsByTagName('td')[6];
          var showRow = true;

          if (tdDueDate) {
            var rowDueDate = new Date(tdDueDate.innerHTML);
            if (dueDate && rowDueDate.toDateString() !== dueDate.toDateString()) {
              showRow = false;
            }
          }

          if (tdStatus) {
            var rowStatus = tdStatus.innerHTML.trim();
            if (status && status !== rowStatus) {
              showRow = false;
            }
          }

          tr[i].style.display = showRow ? '' : 'none';
        }
      }
    </script>

<script>
    function confirmation(event, message, url) {
        event.preventDefault();
        Swal.fire({
            title: message,
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, proceed!'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = url;
            }
        });
    }
</script>


</body>
</html>

