<!DOCTYPE html>
<html>
<head>
    <title>Report Incidents</title>
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
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
    </style>
</head>
<body>
    <div class="header">
        <img src="image/logo.png" alt="PALIPARAN 3 SENIOR HIGH Logo" class="logo">
        <h1>Incident Reports</h1>
    </div>

    <div class="contact-info">
        <p>PALIPARAN 3 SENIOR HIGH</p>
        <p>Block 194, Phase V, Brgy. Paliparan III</p>
        <p>✉ pal3shs.depeddasma.edu.ph</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>ID</th>
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

                <tr>
                    <td>{{ $report->id }}</td>
                    <td>{{ $report->student_number }}</td>
                    <td>{{ $report->age }}</td>
                    <td>{{ $report->report_date }}</td>
                    <td>{{ $report->category }}</td>
                    <td>{{ $report->description }}</td>
                    <td>{{ $report->location }}</td>
                    <td>{{ $report->status }}</td>
                    <td>{{ $report->person_involved }}</td>
                    <td>{{ $report->evidence }}</td>
                </tr>

        </tbody>
    </table>
</body>
</html>
