<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    <title>Incident Reports</title>
    <style>
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .logo {
            width: 100px;
            height: auto;
        }
        .contact-info {
            text-align: center;
            margin-top: 10px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
    </style>
</head>
<body>
    <div class="container mt-4">
        <div class="header">
            <img src="image/logo.png" alt="PALIPARAN 3 SENIOR HIGH Logo" class="logo">
            <h1>Incident Reports</h1>
        </div>

        <div class="contact-info mb-4">
            <p class="mb-0">PALIPARAN 3 SENIOR HIGH</p>
            <p class="mb-0">Block 194, Phase V, Brgy. Paliparan III</p>
            <p class="mb-0">✉ pal3shs.depeddasma.edu.ph</p>
        </div>

        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>Student Number</th>
                        <th>Age</th>
                        <th>Report Date</th>
                        <th>Category</th>
                        <th>Description</th>
                        <th>Location</th>
                        <th>Status</th>
                        <th>Person Involved</th>
                        <th>Evidence</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($reports as $report)
                        <tr>
                            <td>{{ $report->student_number }}</td>
                            <td>{{ $report->age }}</td>
                            <td>{{ $report->report_date }}</td>
                            <td>{{ $report->category }}</td>
                            <td>{{ $report->description }}</td>
                            <td>{{ $report->location }}</td>
                            <td>{{ $report->status }}</td>
                            <td>{{ $report->person_involved }}</td>
                            <td>{{ $report->evidance }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>