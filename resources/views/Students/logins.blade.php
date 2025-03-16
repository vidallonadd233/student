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

        <div class="container d-flex justify-content-center align-items-center min-vh-100" >
            <div class="shadow-lg card w-75">
                <div class="row g-0">
                    <!-- Left Side: Logo -->
                    <div class="col-md-6 d-flex justify-content-center align-items-center bg-light">
                        <img src="{{ asset('image/logo.png') }}" class="img-fluid img-logo w-50" alt="School Logo" style="max-width: 150px;">
                    </div>

                    <!-- Right Side: Login Form -->
                    <div class="p-4 col-md-6">
                        <div class="card-body">
                            <!-- Session Messages -->
                            @if(session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif

                            @if(session('error'))
                                <div class="alert alert-danger">
                                    {{ session('error') }}
                                </div>
                            @endif


                            <h4 class="mb-3 text-center fw-normal">Student Login</h4>
                            <form action="{{ route('logins.submit') }}" method="POST">
                                @csrf

                                <div class="mb-3 form-group">
                                    <label for="student_number" class="form-label fw-normal">Student Number:</label>
                                    <input type="number" class="form-control @error('student_number') is-invalid @enderror" name="student_number" id="student_number" placeholder="Enter your student number" value="{{ old('student_number') }}" required>
                                    @error('student_number')
                                        <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>

                                <!-- Password field -->
                                <div class="mb-3 form-group position-relative">
                                    <label for="password">{{ __('Password') }}</label>
                                    <div class="position-relative">
                                        <input type="password" name="password" id="password" class="form-control pe-5 @error('password') is-invalid @enderror" required>
                                        <i class="bi bi-eye position-absolute end-0 top-50 translate-middle-y me-3"
                                           id="togglePassword" style="cursor: pointer;"></i>
                                    </div>
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <!-- Submit Button -->
                                <div class="d-flex justify-content-center">
                                    <button type="submit" class="btn btn-success w-75">Login</button>
                                </div>
                            </form>

                            <div class="mt-3 text-center">
                                <a href="{{ route('password.create') }}" class="custom-link text-success">Forgot password</a>
                            </div>

                            <div class="mt-3 text-center">
                                <p>Don’t have an account? <a href="{{ route('register.store') }}" class="text-success custom-link">Sign Up</a></p>
                            </div>
                        </div>
                    </div> <!-- End Right Side -->
                </div>
            </div>
        </div>



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
                document.addEventListener("DOMContentLoaded", function () {
            function adjustMobileView() {
                let screenWidth = window.innerWidth;

                // Adjust input field padding & font size
                if (screenWidth < 576) { // Small screens
                    document.querySelectorAll('.form-control').forEach(el => {
                        el.style.padding = "10px";
                        el.style.fontSize = "14px";
                    });

                    // Adjust logo size
                    let logo = document.querySelector('.img-logo');
                    if (logo) {
                        logo.style.maxWidth = "100px"; // Smaller logo
                    }

                    // Reduce card width for small screens
                    let card = document.querySelector('.card');
                    if (card) {
                        card.style.width = "95%";
                    }
                }
            }

            adjustMobileView(); // Run on page load
            window.addEventListener("resize", adjustMobileView); // Run on window resize
        });
                </script>





        <!-- Bootstrap JS -->

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    </body>
    </html>
