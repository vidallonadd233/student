@include('landing.letter')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Incident Report</title>
</head>
<body>
    <h1>Incident Report Notification</h1>
    <p>Dear Admin,</p>
    <p>A register  has been submitted:</p>
    <p><strong>Description:</strong> {{ $report->description }}</p>
    <p><strong>Location:</strong> {{ $report->location ?? 'N/A' }}</p>


    <p>Thank you.</p>
</body>
</html>
