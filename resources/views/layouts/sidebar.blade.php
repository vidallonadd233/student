@include('landing.letter')
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard')</title>
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('assets/css/sidebar.css') }}">
</head>

<body>
    <div class="d-flex">
        <!-- Sidebar -->
        <aside id="sidebar" class="sidebar-toggle bg-success">
            <div class="sidebar-logo">
                <img src="{{ asset('image/logo.png') }}" alt="Logo" class="mb-3 border-success" style="width: 70px; height: 70px;">
            </div>
            <ul class="sidebar-nav">

                      <!-- Check if the authenticated user is a student -->




            <li class="sidebar-item">
               <a class="px-3 rounded nav-link text-light d-flex align-items-center" href="{{route('report_incidents.index')}}">
             <span>Report Incidents </span>
            </a>
         </li>



        <li class="sidebar-item">
            <a class="px-3 rounded nav-link text-light d-flex align-items-center" href="{{ route('archive.report') }}">
                <span>Archived</span>
            </a>
        </li>





</li>


                <li class="sidebar-item">
                    <form action="{{ route('logout.student') }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="px-3 bg-transparent border-0 rounded nav-link text-light d-flex align-items-center">

                            <span>Logout</span>
                        </button>
                    </form>
                </li>
            </ul>
        </aside>

        <!-- Main Content -->
        <div class="main">
            <nav class="p-3 navbar navbar-expand bg-success d-flex justify-content-between align-items-center">
                <button class="toggler-btn" type="button">
                    <i class="text-white lni lni-text-align-left"></i>
                </button>
                <h1 class="m-0 text-center text-white flex-grow-1 fs-3 fw-normal">Student Concerns</h1>
            </nav>


    <main class="p-2">
        @yield('content')
    </main>
</div>

<!-- Bootstrap and JavaScript Libraries -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const toggler = document.querySelector(".toggler-btn");
        toggler.addEventListener("click", function () {
            document.querySelector("#sidebar").classList.toggle("collapsed");
        });
    </script>
</body>

</html>
