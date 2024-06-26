<!-- resources/views/emails/reminder_notification.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Overdue Book Reminder</title>
</head>
<body>
    <p>Dear {{ $user->name }},</p>

    <p>This is a reminder that the book you borrowed from Hekima Library was due on {{ $due_date }}. Please return the book as soon as possible to avoid any penalties.</p>

    <p>Thank you,<br>Hekima Library</p>
</body>
</html>
