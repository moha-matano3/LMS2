<!-- resources/views/emails/reminder_notification.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Overdue Book Reminder</title>
</head>
<body>
    <h2>Dear {{ $user->name }},</h2>

    <p>This is a reminder that the book you borrowed titled, <b>{{$book->book_title}}</b> from Hekima Library was due on {{ $due_date }}. Please return the book as soon as possible to avoid any further penalties.</p>

    <p>Thank you,<br>Hekima Library</p>
</body>
</html>
