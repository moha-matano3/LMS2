<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .notify-container {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 9999; /* Ensure it's above other elements */
        }
    </style>
    @notifyCss
</head>
<body>
<div class="container">
    <h1>Manage Users</h1>

    <div class="notify-container">
        <x-notify::notify />
    </div>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Phone Number</th>
                <th>Address</th>
                <th>User Type</th>
                <th>Actions</th>
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
                        <form id="updateRole-{{ $user->id }}" action="{{ url('updateRole', $user->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <select name="usertype" class="form-control" onchange="confirmation(event, 'Change users role?', '{{ $user->id }}')">
                                <option value="patron" {{ $user->usertype == 'patron' ? 'selected' : '' }}>Patron</option>
                                <option value="admin" {{ $user->usertype == 'admin' ? 'selected' : '' }}>Admin</option>
                                <option value="super" {{ $user->usertype == 'super' ? 'selected' : '' }}>Super</option>
                            </select>
                        </form>
                    </td>
                    <td>
                        <a class="btn-sm btn-success" href="#" onclick="confirmation(event, 'Change users role?', '{{ url('updateRole', $user->id) }}')" title="update">
                            <i class="fas fa-thumbs-up"></i>
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div> 


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
    @notifyJs
</body>
</html>