<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{ asset('assets/css/register.css') }}">


</head>

<body>

    @if(session('toast_success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Success!',
            text: "{{ session('toast_success') }}",
            timer: 3000,
            showConfirmButton: false,
            toast: true,
            position: 'top-center'
        });
    </script>
@endif


    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="row w-100 h-50 justify-content-center">
            <div class="col-lg-8 col-md-12 col-sm-10">
                <div class="shadow-lg card rounded-4">
                    <div class="row g-0">
                        <!-- Left Logo Section -->
                        <div class="text-white col-md-5 d-flex flex-column justify-content-center align-items-center logo-container">
                            <img src="image/logo.png" class="img-fluid w-50">
                        </div>

                        <!-- Right Form Section -->
                        <div class="p-5 col-md-7">
                            <h3 class="mb-4 text-center fs-5 fw-normal">Student Registration</h3>
                            <form action="{{ route('register.store') }}" method="POST" class="needs-validation" enctype="multipart/form-data" novalidate>
                                @csrf

                                <div class="mb-3 form-floating">
                                    <input type="number" class="form-control @error('student_number') is-invalid @enderror"
                                        name="student_number" id="student_number" min="1" value="{{ old('student_number', '1') }}" required>
                                    <label for="student_number">Student Number</label>
                                </div>

                                <div class="row">
                                    <div class="col-12 col-md-6">
                                        <div class="mb-3 form-floating">
                                            <select class="form-select @error('grade_level') is-invalid @enderror" name="grade_level" id="grade_level" required>
                                                <option value="11">Grade 11</option>
                                                <option value="12">Grade 12</option>
                                            </select>
                                            <label for="grade_level">Grade Level</label>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="mb-3 form-floating">
                                            <input type="number" class="form-control @error('age') is-invalid @enderror"
                                                name="age" id="age" min="16" max="100" value="{{ old('age') }}" required>
                                            <label for="age">Age</label>
                                            @error('age')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>


                                        <div class="mb-3 form-floating">
                                            <select class="form-select" name="gender" id="gender" required>
                                                <option value="Male">Male</option>
                                                <option value="Female">Female</option>
                                                <option value="Other">Other</option>
                                            </select>
                                            <label for="gender">Gender</label>
                                        </div>



                                <div class="mb-3 password-toggle position-relative">
                                    <div class="form-floating">
                                        <input type="password" class="form-control @error('password') is-invalid @enderror"
                                            name="password" id="password" placeholder="Enter password" required>
                                        <label for="password">Password</label>
                                        <i class="bi bi-eye position-absolute end-0 top-50 translate-middle-y me-3"
                                            id="togglePassword" style="cursor: pointer;"></i>
                                    </div>
                                </div>

                                <div class="text-center">
                                    <button type="submit" class="btn btn-success w-100">Register</button>
                                </div>

                                <div class="mt-3 text-center">
                                    <small>Already have an account? <a href="{{ route('logins.submit') }}" class="text-success" style="text-decoration: none;">Login</a></small>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <!-- Bootstrap JS -->

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>


    <script>
        document.getElementById("togglePassword").addEventListener("click", function () {
            let passwordInput = document.getElementById("password");
            let toggleIcon = this.querySelector("i");

            if (passwordInput.type === "password") {
                passwordInput.type = "text";
                toggleIcon.classList.remove("bi-eye");
                toggleIcon.classList.add("bi-eye-slash");
            } else {
                passwordInput.type = "password";
                toggleIcon.classList.remove("bi-eye-slash");
                toggleIcon.classList.add("bi-eye");
            }
        });
        </script>


<script>
    function validateStudentNumber(input) {
        // Allow only numbers (remove non-numeric characters)
        input.value = input.value.replace(/[^0-9]/g, '');
    }
    </script>

</body>
</html>
