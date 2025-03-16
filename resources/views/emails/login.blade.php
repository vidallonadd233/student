<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Notification</title>
</head>
<body>
    <h1>Hello, {{ $user->name ?? 'User' }}</h1>

    <p>We detected a login to your account on the <strong>Anti-Bullying Incident Reporting and Monitoring Platform</strong> using your email: <strong>{{ $user->email }}</strong>.</p>

    <p>If this was you, no further action is needed.</p>

    <p>If you did not authorize this login, please reset your password immediately and contact our support team for assistance.</p>

    <p>Thank you for using our platform.</p>

    <p>Best regards,</p>
    <p>{{ config('app.name') }} Team</p>
</body>
</html>

