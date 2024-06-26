<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
        .notify-container
          {
              position: fixed;
              top: 20px;
              right: 20px;
              z-index: 9999; /* Ensure it's above other elements */
          }

      </style>
          <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
          <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    @notifyCss

</head>
<body>
<div class="container">
    <h1>Manage Users</h1>

    <div class="notify-container">
        <x-notify::notify />
    </div>

    <div class="table-responsive">
      <table class="table" id="borrowTable">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Phone Number</th>
                <th>Address</th>
                <th>User Type</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach($user as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->phone }}</td>
                    <td>{{ $user->address }}</td>
                    <td>
                        <form id="updateRoleForm{{ $user->id }}" action="{{ url('updateRole', $user->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <select name="usertype" class="form-control" onchange="confirmRoleChange(event, '{{ $user->id }}', this)">
                                <option value="patron" {{ $user->usertype == 'patron' ? 'selected' : '' }}>Patron</option>
                                <option value="admin" {{ $user->usertype == 'admin' ? 'selected' : '' }}>Admin</option>
                                <option value="super" {{ $user->usertype == 'super' ? 'selected' : '' }}>Super</option>
                            </select>
                        </form>
                    </td>

                </tr>
            @endforeach
        </tbody>
    </table>
    </div>
</div>

<script>
    function confirmRoleChange(event, userId, element) {
        event.preventDefault();
        console.log('confirmRoleChange called'); // Debug log
        Swal.fire({
            title: 'Change user role?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, proceed!'
        }).then((result) => {
            console.log('SweetAlert result:', result); // Debug log
            if (result.isConfirmed) {
                console.log('Form will be submitted'); // Debug log
                document.getElementById('updateRoleForm' + userId).submit();
            } else {
                console.log('Action canceled'); // Debug log
                // Revert the select value to its previous state if user cancels
                element.value = element.querySelector('option[selected]').value;
            }
        });
    }
</script>



    @notifyJs
</body>
</html>