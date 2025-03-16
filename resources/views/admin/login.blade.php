@include('landing.letter')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">

    <link href="{{ asset('assets/css/jam.css') }}" rel="stylesheet">
</head>
<body>



@endif

        <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="shadow-lg card w-50">
            <div class="row g-0">
                <!-- Left Side: Logo -->
                <div class="col-md-6 d-flex justify-content-center align-items-center bg-light">
                    <img src="{{ asset('image/logo.png') }}" class="img-fluid"  alt="School Logo " style="width: 40%;">
                </div>
                <!-- Right Side: Login Form -->
                <div class="p-4 col-md-6">
                    <h3 class="mb-4 text-center fw-normal"> Admin Login</h3>
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <!-- Email Address -->
                        <div class="mb-3 form-group">
                            <label for="email">{{ __('Email Address') }}</label>
                            <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required autofocus>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <!-- Password -->
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

                        <!-- JavaScript for Password Toggle -->
                        <script>
                            document.getElementById("togglePassword").addEventListener("click", function() {
                                let passwordField = document.getElementById("password");
                                let icon = this;

                                if (passwordField.type === "password") {
                                    passwordField.type = "text";
                                    icon.classList.remove("bi-eye");
                                    icon.classList.add("bi-eye-slash");
                                } else {
                                    passwordField.type = "password";
                                    icon.classList.remove("bi-eye-slash");
                                    icon.classList.add("bi-eye");
                                }
                            });
                        </script>

                        <!-- Submit Button -->
                        <div class="text-center">
                            <button type="submit" class="btn btn-success w-100">Login</button>
                        </div>

                        <!-- Forgot Password Link -->

                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>






</body>
</html>
