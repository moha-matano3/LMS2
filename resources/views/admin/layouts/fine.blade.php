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
        .notify-container {
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

                        <div class="notify-container">
                            <x-notify::notify />
                        </div>

                        <!-- Filter Form -->
                        <div class="filter-form">
                            <form id="filterForm">
                                <input type="date" id="dueDate" name="dueDate" placeholder="Due Date">
                                <button type="button" onclick="filterTable()">Filter</button>
                            </form>
                        </div>

                        <div class="table-responsive">
                            <table class="table" id="borrowTable">
                                <thead>
                                    <tr>
                                        <th>Member's Name</th>
                                        <th>Book Title</th>
                                        <th>Due Date</th>
                                        <th>Fine Amount</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($fines as $fine)
                                        <tr>
                                            <td>{{ $fine->user->name }}</td>
                                            <td>{{ $fine->books->book_title }}</td>
                                            <td>{{ $fine->due_date }}</td>
                                            <td class="fine-amount">{{ $fine->amount ?? 'N/A' }}</td>
                                            <td>{{ $fine->is_paid ? 'Paid' : 'Unpaid' }}</td>
                                            <td>
                                                @if (!$fine->is_paid)
                                                    <button type="button" class="btn btn-primary calculate-fine" data-id="{{ $fine->id }}">
                                                        <i class="fas fa-check-circle"></i> Calculate Fine
                                                    </button>
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
            var table = document.getElementById('borrowTable').getElementsByTagName('tbody')[0];
            var tr = table.getElementsByTagName('tr');

            for (var i = 0; i < tr.length; i++) {
                var tdDueDate = tr[i].getElementsByTagName('td')[2];
                var showRow = true;

                if (tdDueDate) {
                    var rowDueDate = new Date(tdDueDate.innerHTML);
                    if (dueDate && rowDueDate.toDateString() !== dueDate.toDateString()) {
                        showRow = false;
                    }
                }

                tr[i].style.display = showRow ? '' : 'none';
            }
        }

        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('.calculate-fine').forEach(button => {
                button.addEventListener('click', function () {
                    var id = this.getAttribute('data-id');
                    var row = this.closest('tr');

                    fetch(`/calculateFine/${id}`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.amount) {
                            row.querySelector('.fine-amount').innerHTML = data.amount;
                        }
                    })
                    .catch(error => console.error('Error:', error));
                });
            });
        });
    </script>

    @notifyJs
</body>
</html>
