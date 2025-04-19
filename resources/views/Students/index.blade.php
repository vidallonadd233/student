@extends('layout.app')

@section('title', 'Students List')

@section('content')
@if (session('toast_success'))
    <div class="alert alert-success alert-dismissible fade show align-items-center" role="alert">
        {{ session('toast_success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif


<div class="position-fixed bottom-0 end-0 p-3" style="z-index: 1055;">
    @if (session('success'))
        <div class="toast align-items-center text-bg-success border-0 show" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body">
                    {{ session('success') }}
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
    @elseif (session('error'))
        <div class="toast align-items-center text-bg-danger border-0 show" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body">
                    {{ session('error') }}
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
    @endif
</div>

<div class="container">
    <h1 class="mb-4 text-center fs-3 fw-normal">Students List</h1>

    <!-- Search Form -->
    <form action="{{ route('students.index') }}" method="GET" class="mb-4 row g-3 align-items-center justify-content-between">
        <div class="col-md-6">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Search by ID or Student Number..." value="{{ request('search') }}">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-search"></i>
                </button>
            </div>
        </div>
    </form>

    <!-- Students Table -->
    <div class="table-responsive">
        <table class="table table-borderless table-hover">
            <thead>
                <tr>
                    <th class="text-center fw-normal">#</th>
                    <th class="text-center fw-normal">Student Number</th>
                    <th class="text-center fw-normal">Grade Level</th>
                    <th class="text-center fw-normal">Age</th>
                    <th class="text-center fw-normal">Gender</th>
                    <th class="text-center fw-normal">Status</th>
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
                            <!-- Status Badge -->
                            <div class="dropdown">
                                <button class="badge dropdown-toggle
                                    {{ $student->status === 'approved' ? 'bg-success' :
                                       ($student->status === 'rejected' ? 'bg-danger' : 'bg-secondary') }}"
                                    type="button" id="dropdownMenuButton-{{ $student->id }}"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    {{ ucfirst($student->status) }}
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton-{{ $student->id }}">
                                    <li>
                                        <button class="dropdown-item text-success" data-bs-toggle="modal" data-bs-target="#approveModal-{{ $student->id }}">
                                            Approve
                                        </button>
                                    </li>
                                    <li>
                                        <button class="dropdown-item text-danger" data-bs-toggle="modal" data-bs-target="#rejectModal-{{ $student->id }}">
                                            Reject
                                        </button>
                                    </li>
                                </ul>
                            </div>


                            <!-- Approve Modal -->

                            <div class="modal fade" id="approveModal-{{ $student->id }}" tabindex="-1" aria-labelledby="approveLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <form action="{{ route('students.updateStatus', $student->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-header bg-success text-white">
                                                <h5 class="modal-title" id="approveLabel">Confirm Approval</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                Are you sure you want to approve this student?
                                            </div>
                                            <div class="modal-footer d-flex justify-content-between">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                <button type="submit" name="status" value="approved" class="btn btn-success w-50">Yes, Approve</button>
                                            </div>

                                        </form>
                                    </div>
                                </div>
                            </div>

                            <!-- Reject Modal -->

                            <div class="modal fade" id="rejectModal-{{ $student->id }}" tabindex="-1" aria-labelledby="rejectLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <form action="{{ route('students.updateStatus', $student->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-header bg-danger text-white">
                                                <h5 class="modal-title" id="rejectLabel">Confirm Rejection</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                Are you sure you want to reject this student?
                                            </div>
                                            <div class="modal-footer d-flex justify-content-between">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                <button type="submit" name="status" value="rejected" class="btn btn-danger">Yes, Reject</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </td>




                        <td>
                            <div class="d-flex justify-content-center gap-2">
                                <!-- Edit Button -->
                                <button class="btn btn-primary btn-sm edit-student-btn"
                                        data-bs-toggle="modal"
                                        data-bs-target="#editStudentModal"
                                        data-id="{{ $student->id }}"
                                        data-student_number="{{ $student->student_number }}"
                                        data-grade_level="{{ $student->grade_level }}"
                                        data-age="{{ $student->age }}"
                                        data-gender="{{ $student->gender }}">
                                    <i class="bi bi-pencil-square"></i>
                                </button>

                                <!-- Archive Form -->
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

<!-- Edit Student Modal -->
<div class="modal fade" id="editStudentModal" tabindex="-1" aria-labelledby="editStudentModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Student</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="edit-student-form" method="POST">
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

                    <div class="text-center">
                        <button type="submit" class="btn btn-success w-100">Update Student</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>




@endsection


<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Handle Edit Student Button Click
        document.querySelectorAll(".edit-student-btn").forEach(button => {
            button.addEventListener("click", function () {
                document.getElementById("edit-student-id").value = this.dataset.id;
                document.getElementById("edit-student-number").value = this.dataset.student_number;
                document.getElementById("edit-grade-level").value = this.dataset.grade_level;
                document.getElementById("edit-age").value = this.dataset.age;
                document.getElementById("edit-gender").value = this.dataset.gender;

                // Update form action
                document.getElementById("edit-student-form").action = `/students/${this.dataset.id}`;
            });
        });

        // Initialize Bootstrap tooltips
        const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        tooltipTriggerList.map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl));
    });


    const confirmModal = document.getElementById('confirmModal');
    confirmModal.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget; // Button that triggered the modal
        const actionUrl = button.getAttribute('data-action'); // Extract info from data-* attributes
        const status = button.getAttribute('data-status');

        // Update the modal's content
        const modalAction = document.getElementById('modalAction');
        modalAction.textContent = status === 'approved' ? 'approve' : 'reject';

        // Update the form action and status
        const confirmForm = document.getElementById('confirmForm');
        confirmForm.action = actionUrl;
        document.getElementById('modalStatus').value = status;
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var toastEl = document.querySelector('.toast');
        if (toastEl) {
            var toast = new bootstrap.Toast(toastEl, {
                delay: 3000
            });
            toast.show();
        }
    });
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
