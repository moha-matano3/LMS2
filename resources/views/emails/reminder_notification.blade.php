<!-- resources/views/emails/reminder_notification.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Overdue Book Reminder</title>
</head>
<body>
    <p>Dear {{ $user->name }},</p>

<<<<<<< HEAD
    <p>This is a reminder that the book titled, "<b>{{$book->book_title}}</b>" you borrowed from Hekima Library was due on {{ $due_date }}. Please return the book as soon as possible.</p>
=======
    <p>This is a reminder that the book you borrowed titled, {{$book->book_title}} from Hekima Library was due on {{ $due_date }}. Please return the book as soon as possible to avoid any further penalties.</p>
>>>>>>> 8926d30645d2e56ef1407863373001f79f2e495c

    <p>Thank you,<br>Hekima Library</p>
</body>
</html>
