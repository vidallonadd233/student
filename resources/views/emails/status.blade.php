<!DOCTYPE html>
<html>
<head>
    <title>Status Update</title>
</head>
<body>
    <h2>Hello {{ $student->first_name }} {{ $student->last_name }},</h2>
    <p>Your application status has been updated to: <strong>{{ $student->status }}</strong>.</p>
    <p>{{ $statusMessage }}</p>
    <br>
    <p>Thank you,<br>{{ config('app.name') }} Team</p>
</body>
</html>
