@extends('layout.jam')

@section('title', 'Calendar')

@section('content')

@include('landing.letter')

<div class="container">
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

    <h1 class="text-center fs-3 fw-normal">Calendar</h1>

    <!-- Search and Download Buttons -->
    <form action="{{ route('admin.calendar') }}" method="GET" class="row g-3 align-items-center mb-4 justify-content-between mt-5">
        <!-- Search Bar on the Left -->
        <div class="col-md-6 d-flex">
            <div class="input-group w-100">
                <input type="text" name="search" class="form-control" placeholder="Search by ID or Student Number..." value="{{ request('search') }}">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-search"></i>
                </button>
            </div>
        </div>
    </form>

    @if($events->isEmpty())
        <p>No events available.</p>
    @else
    <div class="table-responsive">
        <table class="table table-hover fw-normal">
            <thead class="fw-normal">
                <tr>
                    <th class="fw-normal">Student Number</th>
                    <th class="fw-normal">Grade Level</th>
                    <th class="fw-normal">Age</th>
                    <th class="fw-normal">Date</th>
                    <th class="fw-normal">Time</th>
                    <th class="fw-normal">Gender</th>
                    <th class="fw-normal">Description</th>
                    <th class="fw-normal">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($events as $event)
                    <tr>
                        <td>{{ $event->student_number }}</td>
                        <td>{{ $event->grade_level }}</td>
                        <td>{{ $event->age }}</td>
                        <td>{{ $event->date }}</td>
                        <td>{{ $event->time }}</td>
                        <td>{{ $event->gender }}</td>
                        <td>{{ $event->description }}</td>
                        <td>
                            <!-- Edit Button -->
                            <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editEventModal"
                                data-id="{{ $event->id }}" data-student_number="{{ $event->student_number }}"
                                data-grade_level="{{ $event->grade_level }}" data-age="{{ $event->age }}"
                                data-gender="{{ $event->gender }}" data-time="{{ $event->time }}"
                                data-date="{{ $event->date }}" data-description="{{ $event->description }}">
                                <i class="bi bi-pencil"></i>
                            </button>

                            <!-- Edit Event Modal -->
                            <div class="modal fade" id="editEventModal" tabindex="-1" aria-labelledby="editEventModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title text-center" id="editEventModalLabel">Edit</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <!-- Edit Form -->
                                            <form id="editEventForm" method="POST" action="{{ route('admin.calendar.update', $event->id) }}">
                                                @csrf
                                                @method('PUT')

                                                <input type="hidden" name="id" id="eventId">

                                                <div class="row">
                                                    <div class="col-md-6 mb-3">
                                                        <label for="student_number" class="form-label">Student Number</label>
                                                        <input type="number" class="form-control" id="student_number" name="student_number" required>
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <label for="grade_level" class="form-label">Grade Level</label>
                                                        <select class="form-select" id="grade_level" name="grade_level" required>
                                                            <option value="" selected disabled>Select Grade Level</option>
                                                            <option value="11">Grade 11</option>
                                                            <option value="12">Grade 12</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-6 mb-3">
                                                        <label for="age" class="form-label">Age</label>
                                                        <input type="number" class="form-control" id="age" name="age" required>
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <label for="gender" class="form-label">Gender</label>
                                                        <select class="form-select" id="gender" name="gender" required>
                                                            <option value="" selected disabled>Select Gender</option>
                                                            <option value="Male">Male</option>
                                                            <option value="Female">Female</option>
                                                            <option value="Other">Other</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-6 mb-3">
                                                        <label for="date" class="form-label">Date</label>
                                                        <input type="date" class="form-control" id="date" name="date" required>
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <label for="time" class="form-label">Time</label>
                                                        <input type="time" class="form-control" id="time" name="time" required>
                                                    </div>
                                                </div>

                                                <div class="mb-3">
                                                    <label for="description" class="form-label">Description</label>
                                                    <textarea class="form-control" id="description" name="description" maxlength="255"></textarea>
                                                </div>

                                                <button type="submit" class="btn btn-primary w-100">Update </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <form action="{{ route('admin.calendar.archive', $event->id) }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-warning btn-sm">
                                    <i class="bi bi-archive"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
        <div class="mt-4 d-flex justify-content-center">
            {{ $events->links('pagination::bootstrap-5') }}
        </div>
    @endif

</div>

@endsection
