<!DOCTYPE html>
<html>
<head>
    <title>Book Reservation Approved</title>
</head>
<body>
<h2>Dear {{ $user->name }},</h2>
    <p>We are pleased to inform you that the book you reserved, "<b>{{$book->book_title}}</b>" has been approved and is now available for 
        collection from our mobile library service. Our mobile library will be visiting your area soon, making it convenient for you 
        to pick up your reserved book
    </p>
    <p>Please make sure to bring your library card or any identification when collecting your book</p>
    <p>Thank you!</p>
</body>
</html>
