@include('landing.letter')
@extends('layout.app')

@section('title', 'Incident Reports') <!-- Override title for this page -->

@section('content') <!-- Page-specific content -->

    <!-- Success Message -->
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="container">
        <!-- Search and Filter Form -->
        <form action="{{ route('admin.students') }}" method="GET" class="row g-3 align-items-center">
            <div class="col-md-4">
                <input
                    type="text"
                    name="search"
                    class="form-control"
                    placeholder="Search by ID, Student Number, or Age..."
                    value="{{ request('search') }}"
                >
            </div>


        </form>
    </div>

    <div class="container">
        @if (session('status'))
            <div class="alert alert-success">{{ session('status') }}</div>
        @endif

        <table class="table table-borderless table-hover">
            <thead>
                <tr>
                    <th class="fw-normal text-center ">#</th>
                    <th class="fw-normal text-center">Student Number</th>
                    <th class="fw-normal text-center">Grade Level</th>
                    <th class="fw-normal text-center">Age</th>
                    <th class="fw-normal text-center">Gender</th>
                    <th class="fw-normal text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($students as $student)
                    <tr>
                        <td class="fs-6 text-center">{{ $loop->iteration }}</td>
                        <td class="fs-6 text-center">{{ $student->student_number }}</td>
                        <td class="fs-6 text-center">{{ $student->grade_level }}</td>
                        <td class="fs-6 text-center">{{ $student->age }}</td>
                        <td class="fs-6 text-center">{{ ucfirst($student->gender) }}</td>
                        <td class="d-flex justify-content-center align-items-center gap-2">
                            <!-- Edit Button -->
                            <a href="#" class="btn btn-sm btn-success" data-bs-toggle="tooltip" title="Edit">
                                <i class="bi bi-pencil-square"></i>
                            </a>

                            <!-- Archive Button -->
                            <form action="{{ route('admin.c', $student->id) }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-warning" data-bs-toggle="tooltip" title="Archive">
                                    <i class="bi bi-archive fs-5"></i>
                                </button>
                            </form>

                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">No students registered yet.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <!-- Pagination -->

    </div>

    <script>
        // Initialize tooltips
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
    </script>
@endsection
