<!DOCTYPE html>
<html>
<head>
    <title>Book Reservation Request</title>
</head>
<body>
<h1>Dear {{ $user->name }},</h1>
    <p>Thank you for your interest in reserving the book titled "<b>{{$book->book_title}}</b>" with our library. We appreciate your enthusiasm and support for our collection.After careful consideration, we regret to inform you that your reservation request for has not been approved. Unfortunately, due to current availability and high demand, we are unable to fulfill your reservation at this time.
We understand this news may be disappointing, and we apologize for any inconvenience this may cause. Please be assured that we are doing our best to make our resources accessible to all our members.
    </p>
</body>
</html>


