<!DOCTYPE html>
<html>
<head>
    <title>Test Reminder</title>
</head>
<body>
    <h1>Dear {{ $student->name }},</h1>
    <p>This is a reminder that you have a test scheduled tomorrow.</p>
    <p><strong>Subject:</strong> {{ $test->course_name }}</p>
    <p><strong>Date:</strong> {{ \Carbon\Carbon::parse($test->exam_date)->format('d M Y') }}</p>
    <p><strong>Time:</strong> {{ $test->selected_time }}</p>
    <p>Please ensure that you are well-prepared and on time for your test.</p>
    <p>Best regards,</p>
    <p>Test Management Team</p>
</body>
</html>
