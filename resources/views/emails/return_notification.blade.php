<!DOCTYPE html>
<html>
<head>
    <title>Book Returned</title>
</head>
<body>
<h1>Dear {{ $user->name }},</h1>
    <p>Thank you for returning the book titled {{$book->book_title}}. We look forward to your next visit</p>
</body>
</html>
