<!DOCTYPE html>
<html>
<head>
    <title>Book Application Approved</title>
</head>
<body>
<h1>Dear {{ $user->name }},</h1>
    <p>We are pleased to inform you that the book you requested a time extension for titled, "<b>{{$book->book_title}}</b>" has been approved 
        and the due date is now {{$due_date}}</p>
    <p>Please strive to meet the deadline</p>
    <p>Thank you!</p>
</body>
</html>
