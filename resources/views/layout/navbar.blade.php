<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-success">
        <div class="container-fluid">
            <!-- Brand Logo -->
            <a class="navbar-brand ms-3" href="{{ route('home') }}">
                <div class="logo-container w-100">
                    <img src="image/logo.png" alt="logo" class="logo-img ">
                </div>
            </a>


            <!-- Navbar Toggler for Mobile View -->
            <button
                class="navbar-toggler"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navbarNavDropdown"
                aria-controls="navbarNavDropdown"
                aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Navbar Links and Content -->
            <div class="collapse navbar-collapse justify-content-end" id="navbarNavDropdown">
                <ul class="navbar-nav">
                    <!-- Main Navigation Links -->
                    <li class="nav-item">
                        <a class="nav-link text-white {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">
                            Home
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="text-white nav-link" href="{{ route('about') }}">About</a>
                    </li>


                    <!-- Login Dropdown -->
                    <li class="nav-item dropdown">
                        <a class="text-white nav-link dropdown-toggle" href="#" id="loginDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Login
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="loginDropdown">
                            <!-- Guest: Student Login -->
                            <li><a class="dropdown-item" href="{{ route('logins.form') }}">Student</a></li>
                            @auth
                            @if(Auth::user()->is_admin)
                                <a class="dropdown-item" href="{{ route('admin.dashboard') }}">Admin</a>
                            @else
                                <!-- Optionally, you can show something else or nothing at all -->
                                <!-- <a class="dropdown-item" href="#">You are not an Admin</a> -->
                            @endif
                        @else
                            <!-- If not authenticated, show a login link or any other relevant link -->
                            <a class="dropdown-item" href="{{ route('login') }}">Admin</a>
                        @endauth
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>

</html>
