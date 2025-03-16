<!DOCTYPE html>
<html>
<head>
    <title>Welcome to Our Platform!</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding: 20px;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            color: #333;
        }
        p {
            font-size: 16px;
            color: #555;
        }
        .footer {
            margin-top: 20px;
            font-size: 14px;
            color: #888;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Welcome to Our Platform!</h2>
        <p>Dear Student,</p>
        <p>We are excited to welcome you! Below are your registration details:</p>

        <p><strong>Student Number:</strong> {{ $student_number }}</p>
        <p><strong>Age:</strong> {{ $age }}</p>
        <p><strong>Gender:</strong> {{ $gender }}</p>

        <p>If you have any questions, feel free to contact us.</p>

        <div class="footer">
            <p>&copy; {{ date('Y') }} Your School Name. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
