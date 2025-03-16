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



    @if(session('toast_success'))
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: @json(session('toast_success')),
                timer: 3000,
                showConfirmButton: false,
                toast: true,
                position: 'top-center'
            });
        });
    </script>
@endif

        <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="shadow-lg card ">
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





<script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>



</body>
</html>
