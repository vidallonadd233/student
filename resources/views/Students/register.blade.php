<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Registration</title>

    <!-- Bootstrap & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{ asset('assets/css/register.css') }}">
</head>

<body>
    @if(session('toast_success'))
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Success!',
            text: "{{ session('toast_success') }}",
            timer: 3000,
            showConfirmButton: false,
            toast: true,
            position: 'top'
        });
    </script>
    @endif

    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="card shadow-lg rounded-4 w-100" style="max-width: 900px;">
            <div class="row g-0">
                <!-- Logo Section -->
                <div class="col-md-5  text-white d-flex flex-column justify-content-center align-items-center rounded-start-4">
                    <img src="{{ asset('image/logo.png') }}" alt="Logo" class="img-fluid w-50 mb-3">
                    <h5 class="fw-bold text-center">Welcome Future Green Archer!</h5>
                </div>

                <!-- Form Section -->
                <div class="col-md-7 p-5">
                    <h4 class="text-center mb-4 fw-normal">Student Registration</h4>
                    <form action="{{ route('register.store') }}" method="POST" class="needs-validation" enctype="multipart/form-data" novalidate>
                        @csrf

                        <!-- Student Number -->
                        <div class="form-floating mb-3">
                            <input id="student_number"
                                   type="number"
                                   class="form-control @error('student_number') is-invalid @enderror"
                                   name="student_number"
                                   value="{{ old('student_number', 0) }}"
                                   min="0"
                                   onkeydown="preventNegative(event)"
                                   oninput="this.value = Math.max(this.value, 0)"
                                   required
                                   autofocus>
                            <label for="student_number">Student Number</label>
                        </div>


                        <div class="row">
                            <!-- Grade Level -->
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <select class="form-select @error('grade_level') is-invalid @enderror" name="grade_level" id="grade_level" required>
                                        <option value="" disabled selected>Select Grade Level</option>
                                        <option value="11" {{ old('grade_level') == '11' ? 'selected' : '' }}>Grade 11</option>
                                        <option value="12" {{ old('grade_level') == '12' ? 'selected' : '' }}>Grade 12</option>
                                    </select>
                                    <label for="grade_level">Grade Level</label>
                                    @error('grade_level')
                                        <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>

                            </div>


                            <!-- Age -->
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input id="age" type="number" class="form-control @error('age') is-invalid @enderror"
                                           name="age" value="{{ old('age') }}" required>
                                    <label for="age">Age</label>
                                    @error('age')
                                        <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Gender -->
                        <div class="form-floating mb-3">
                            <select class="form-control @error('gender') is-invalid @enderror" name="gender" id="gender" required>
                                <option value="">Select Gender</option>
                                <option value="Male" {{ old('gender') == 'Male' ? 'selected' : '' }}>Male</option>
                                <option value="Female" {{ old('gender') == 'Female' ? 'selected' : '' }}>Female</option>
                                <option value="Other" {{ old('gender') == 'Other' ? 'selected' : '' }}>Other</option>
                            </select>
                            <label for="gender">Gender</label>
                            @error('gender')
                                <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>


                        <!-- Password -->

                        <div class="form-floating mb-3 position-relative">
                            <input type="password" class="form-control @error('password') is-invalid @enderror"
                                   name="password" id="password" placeholder="Password" required>
                            <label for="password">Password</label>
                            <i class="bi bi-eye position-absolute end-0 top-50 translate-middle-y me-3"
                               id="togglePassword1" style="cursor: pointer;"></i>

                            @error('password')
                                <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <div class="form-floating mb-3 position-relative">
                            <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror"
                                   name="password_confirmation" id="password_confirmation" placeholder="Confirm Password" required>
                            <label for="password_confirmation">Confirm Password</label>
                            <i class="bi bi-eye position-absolute end-0 top-50 translate-middle-y me-3"
                               id="togglePassword2" style="cursor: pointer;"></i>

                            @error('password_confirmation')
                                <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                            @enderror

                        </div>

                        <!-- Submit Button -->
                        <div class="d-grid mb-2">
                            <button type="submit" class="btn btn-success">Register</button>
                        </div>

                        <!-- Login Link -->
                        <div class="text-center">
                            <small>Already have an account?
                                <a href="{{ route('logins.submit') }}" class="text-success text-decoration-none">Login</a>
                            </small>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Toggle Password Script -->
    <script>
    // Password toggle functionality
    const togglePassword1 = document.querySelector("#togglePassword1");
    const password1 = document.querySelector("#password");

    const togglePassword2 = document.querySelector("#togglePassword2");
    const password2 = document.querySelector("#password_confirmation");

    togglePassword1.addEventListener("click", function() {
        // Toggle password visibility
        const type = password1.type === "password" ? "text" : "password";
        password1.type = type;
        this.classList.toggle("bi-eye-slash");
    });

    togglePassword2.addEventListener("click", function() {
        // Toggle password visibility
        const type = password2.type === "password" ? "text" : "password";
        password2.type = type;
        this.classList.toggle("bi-eye-slash");
    });

    function preventNegative(e) {
        // Prevent minus sign and arrow down
        if (e.key === "-" || e.key === "ArrowDown") {
            e.preventDefault();
        }
    }
</script>


</body>
</html>
