<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Incident Reports</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
</head>
<body>
  <div class="container mt-4">
    <div class="text-center mb-4">
      <img src="image/logo.png" alt="PALIPARAN 3 SENIOR HIGH Logo" class="img-fluid" style="width: 100px;">
      <h1 class="mt-3">Incident Reports</h1>
    </div>

    <div class="text-center mb-4">
      <p class="mb-0">PALIPARAN 3 SENIOR HIGH</p>
      <p class="mb-0">Block 194, Phase V, Brgy. Paliparan III</p>
      <p class="mb-0">✉ pal3shs.depeddasma.edu.ph</p>
    </div>

    <div class="table-responsive">
      <table class="table table-striped table-bordered">
        <thead class="thead-dark">
          <tr>
            <th>Student Number</th>
            <th>Section</th>
            <th>Age</th>
            <th>Date</th>
            <th>Time</th>
            <th>Gender</th>
            <th>Description</th>
          </tr>
        </thead>
        <tbody>
          @foreach($schedules as $schedule)
          <tr>
            <td>{{ $schedule->student_number }}</td>
            <td>{{ $schedule->section }}</td>
            <td>{{ $schedule->age }}</td>
            <td>{{ $schedule->date }}</td>
            <td>{{ $schedule->time }}</td>
            <td>{{ $schedule->gender }}</td>
            <td>{{ $schedule->description }}</td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js" integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/" crossorigin="anonymous"></script>
</body>
</html>