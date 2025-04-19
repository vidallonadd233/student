
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
                <a href="{{ route('admin.dashboard') }}">
                <img src="{{ asset('image/logo.png') }}" alt="Logo" class="mb-3 border-success" style="width: 70px; height: 70px;">
                </a>
            </div>
            <ul class="sidebar-nav">
                <!-- Sidebar items -->
                <li class="sidebar-item">
                    <a class="px-3 rounded nav-link text-light d-flex align-items-center" href="{{ route('admin.dashboard') }}">
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="px-3 rounded nav-link text-light d-flex align-items-center" href="{{ route('students.index') }}">
                        <span>Students</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="px-3 rounded nav-link text-light d-flex align-items-center" href="{{ route('admin.viewReports') }}">
                        <span>Report</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="px-3 rounded nav-link text-light d-flex align-items-center" href="{{ route('admin.activity-log') }}">
                        <span>Activity Log</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="{{ route('admin.solvedReports') }}" class="px-3 rounded nav-link text-light d-flex align-items-center">
                        <span>Solved Cases</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="px-3 rounded nav-link text-light d-flex align-items-center" href="{{ route('student.calendar_events') }}">
                        <span>Schedule</span>
                    </a>
                </li>


                <li class="sidebar-item">
                    <a class="px-3 rounded nav-link text-light d-flex align-items-center" href="{{ route('admin.calendar') }}">
                        <span>Calendar</span>
                    </a>
                </li>

                <li class="sidebar-item">
                    <!-- Archive Menu Toggle -->
                    <a href="#archiveSubmenu" data-bs-toggle="collapse" aria-expanded="false" class="px-3 rounded nav-link text-light d-flex align-items-center">
                        <span>Archive</span>
                        <i class="bi bi-chevron-down ms-auto"></i>
                    </a>
                    <!-- Submenu with Archive links -->
                    <ul class="collapse list-unstyled" id="archiveSubmenu">

                        <li>
                            <a href="{{ route('admin.archive-reports') }}" class="nav-link px-4 text-white">Archived Reports</a>
                        </li>


                        <li>
                            <a href="{{ route('students.showArchived') }}" class="nav-link px-4 text-white">Students</a>
                        </li>
                        <li>
                            <a href="{{ route('admin.archives.calendar') }}" class="nav-link px-4 text-white">Calendar</a>
                        </li>
                    </ul>
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
            <nav class="navbar navbar-expand">
                <button class="toggler-btn" type="button">
                    <i class="lni lni-text-align-left"></i>
                </button>
                <div class="navbar-nav ms-auto d-flex align-items-center">
                    <!-- Notification Bell -->

                    <!-- Profile Dropdown -->
                    <div class="nav-item ">
                        <a class="nav-link " href="#" id="profileDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            @if(Auth::guard('admin')->check())
                                {{ Auth::guard('admin')->user()->email }}
                            @endif
                        </a>

                    </div>
                </div>
            </nav>
            <main class="p-2">
                @yield('content')
            </main>
        </div>
    </div>

    <!-- Notifications Modal -->
    <div class="modal fade" id="notificationsModal" tabindex="-1" aria-labelledby="notificationsModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="notificationsModalLabel">Unread Notifications</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @if(isset($unreadNotifications) && $unreadNotifications->isEmpty())
                        <p>You have no unread notifications.</p>
                    @else
                        <ul class="list-group">
                            @if(isset($unreadNotifications))
                                @foreach($unreadNotifications as $notification)
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        {{ $notification->data['message'] }} <!-- Customize this based on your notification structure -->
                                        <a href="{{ route('notifications.markAsRead', $notification->id) }}" class="btn btn-sm btn-primary">Mark as read</a>
                                    </li>
                                @endforeach
                            @endif
                        </ul>
                    @endif
                </div>
            </div>
        </div>
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
