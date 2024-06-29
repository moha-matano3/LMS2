<!DOCTYPE html>
<html>
<head>
    <title>Book Returned</title>
</head>
<body>
<h2>Dear {{ $user->name }},</h2>
    <p>Thank you for returning the book titled <b>{{$book->book_title}}</b>. We look forward to your next visit</p>
</body>
</html>
