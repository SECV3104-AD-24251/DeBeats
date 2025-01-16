<!DOCTYPE html>
<html>
<head>
    <title>Exam Reminder</title>
</head>
<body>
    <h1>Dear {{ $student->name }},</h1>
    <p>This is a reminder that you have an exam scheduled tomorrow.</p>
    <p><strong>Subject:</strong> {{ $exam->course_name }}</p>
    <p><strong>Date:</strong> {{ \Carbon\Carbon::parse($exam->exam_date)->format('d M Y') }}</p>
    <p><strong>Time:</strong> {{ $exam->start_time }}</p>
    <p>Please ensure that you are well-prepared and on time for your exam.</p>
    <p>Best regards,</p>
    <p>Exam Management Team</p>
</body>
</html>
