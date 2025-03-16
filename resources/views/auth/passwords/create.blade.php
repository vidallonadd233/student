@include('landing.letter')
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Login</title>

    <!-- Bootstrap 5.3.3 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/logins.css') }}">
</head>

<body>

    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="card w-75 shadow-lg">
            <div class="row g-0">

                <!-- Left Side: Logo -->
                <div class="col-md-6 d-flex justify-content-center align-items-center bg-light">
                    <img src="{{ asset('image/logo.png') }}" class="img-fluid img-logo w-50" alt="School Logo" style="max-width: 150px;">
                </div>

                <!-- Right Side: Form -->
                <div class="col-md-6 p-4">
                    <h3 class="text-center mb-3 fw-normal">Create New Password</h3>

                    <!-- Display Errors -->
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- Password Reset Form -->
                    <form action="{{ route('password.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="student_number" class="form-label">Student Number</label>
                            <input type="text" class="form-control" name="student_number" id="student_number" required>
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">New Password</label>
                            <input type="password" class="form-control" name="password" id="password" required>
                        </div>

                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">Confirm Password</label>
                            <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" required>
                        </div>

                        <button type="submit" class="btn btn-success w-100">Create Password</button>
                    </form>

                    <!-- Back to Login Link -->
                    <div class="mt-3 text-center">
                        <a href="{{ route('logins.form') }}" class="text-success text-decoration-none">Back to Login</a>

                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
