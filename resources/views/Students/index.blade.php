@extends('layout.app')

@section('title', 'Students List')

@section('content')

    <!-- Success Message -->
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show align-items-center" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div class="container">
        <h1 class="mb-4 text-center fs-3 fw-normal">Students List</h1>

        <!-- Search and Filter Form -->
        <form action="{{ route('students.index') }}" method="GET" class="mb-4 row g-3">
            <div class="col-12 col-md-4">
                <input type="text" name="search" class="form-control"
                       placeholder="Search by Student Number, Grade Level, or Age..."
                       value="{{ request('search') }}">
            </div>
            <div class="col-12 col-md-2">
                <button type="submit" class="btn btn-primary w-100">Search</button>
            </div>
        </form>
    </div>

    <div class="container">
        <div class="table-responsive"> <!-- Make table scrollable on small screens -->
            <table class="table table-borderless table-hover">
                <thead>
                    <tr>
                        <th class="text-center fw-normal">#</th>
                        <th class="text-center fw-normal">Student Number</th>
                        <th class="text-center fw-normal">Grade Level</th>
                        <th class="text-center fw-normal">Age</th>
                        <th class="text-center fw-normal">Gender</th>

                        <th class="text-center fw-normal">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($students as $student)
                        <tr>
                            <td class="text-center fs-6">{{ $loop->iteration }}</td>
                            <td class="text-center fs-6">{{ $student->student_number }}</td>
                            <td class="text-center fs-6">{{ $student->grade_level }}</td>
                            <td class="text-center fs-6">{{ $student->age }}</td>
                            <td class="text-center fs-6">{{ ucfirst($student->gender) }}</td>




                            <td class="text-center fs-6">
                                <div class="d-flex justify-content-center gap-2">
                                    <button class="btn btn-primary btn-sm edit-student-btn" data-bs-toggle="modal" data-bs-target="#editStudentModal">

                                    <i class="bi bi-pencil-square"></i>
                                </button>
                                    <div class="modal fade" id="editStudentModal" tabindex="-1" aria-labelledby="editStudentModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="editStudentModalLabel">Edit Student</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ route('students.update', $student->id) }}" method="POST">

                                                        @csrf
                                                        @method('PUT')

                                                        <input type="hidden" name="id" id="edit-student-id">

                                                        <div class="mb-3">
                                                            <label for="edit-student-number" class="fw-normal">Student Number:</label>
                                                            <input type="number" class="form-control" name="student_number" id="edit-student-number" required>
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="edit-grade-level" class="fw-normal">Grade Level:</label>
                                                            <select class="form-control" name="grade_level" id="edit-grade-level" required>
                                                                <option value="11">Grade 11</option>
                                                                <option value="12">Grade 12</option>
                                                            </select>
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="edit-age" class="fw-normal">Age:</label>
                                                            <input type="number" class="form-control" name="age" id="edit-age" required>
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="edit-gender" class="fw-normal">Gender:</label>
                                                            <select class="form-control" name="gender" id="edit-gender" required>
                                                                <option value="male">Male</option>
                                                                <option value="female">Female</option>
                                                            </select>
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="edit-password" class="fw-normal">New Password (Optional):</label>
                                                            <input type="password" class="form-control" name="password" id="edit-password">
                                                        </div>

                                                        <div class="text-center">
                                                            <button type="submit" class="btn btn-success w-100">Update Student</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <form action="{{ route('students.archive', $student->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-warning btn-sm"
                                            onclick="return confirm('Are you sure you want to archive this student?')">
                                            <i class="bi bi-archive"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center">No students registered yet.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="mt-4 d-flex justify-content-center">
            {{ $students->links('pagination::bootstrap-5') }}
        </div>
    </div>


@endsection

@section('scripts')
    <script>
        // Initialize Bootstrap tooltips
        document.addEventListener("DOMContentLoaded", function () {
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });

            // Handle Edit Student Button Click
            document.querySelectorAll(".edit-student-btn").forEach(button => {
                button.addEventListener("click", function () {
                    let id = this.dataset.id;
                    let studentNumber = this.dataset.student_number;
                    let gradeLevel = this.dataset.grade_level;
                    let age = this.dataset.age;
                    let gender = this.dataset.gender;

                    document.getElementById("edit-student-id").value = id;
                    document.getElementById("edit-student-number").value = studentNumber;
                    document.getElementById("edit-grade-level").value = gradeLevel;
                    document.getElementById("edit-age").value = age;
                    document.getElementById("edit-gender").value = gender;

                    let form = document.getElementById("edit-student-form");
                    form.action = `/students/${id}`;  // Update form action dynamically
                });
            });
        });

        document.addEventListener('DOMContentLoaded', function () {
    const editButtons = document.querySelectorAll('.edit-student-btn');

    editButtons.forEach(button => {
        button.addEventListener('click', function () {
            // Get data from the button attributes
            const studentId = this.dataset.id;
            const studentNumber = this.dataset.student_number;
            const gradeLevel = this.dataset.grade_level;
            const age = this.dataset.age;
            const gender = this.dataset.gender;

            // Set modal fields with student data
            document.getElementById('edit-student-id').value = studentId;
            document.getElementById('edit-student-number').value = studentNumber;
            document.getElementById('edit-grade-level').value = gradeLevel;
            document.getElementById('edit-age').value = age;
            document.getElementById('edit-gender').value = gender;
        });
    });
});

    </script>


@endsection
