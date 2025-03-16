        @include('landing.letter')

        @extends('layouts.app') <!-- Extends the main layout -->

        @section('title', 'Incident Reports') <!-- Override title for this page -->

        @section('content') <!-- Page-specific content -->

        @if(session('toast_success'))
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: "{{ session('toast_success') }}",
                    timer: 3000,
                    showConfirmButton: false,
                    toast: true,
                    position: 'top-center'
                });
            });
        </script>
    @endif

        <div class="container mt-4">
            <h1 class="mb-3">Student Reports</h1>

            <form action="{{ route('report_incidents.index') }}" method="GET" class="mb-4 row g-3 align-items-center justify-content-between">

                <!-- Search Bar on the Left -->
                <div class="col-md-6">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control" placeholder="Search by ID or Student Number..." value="{{ request('search') }}">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-search"></i>
                        </button>
                    </div>
                </div>

                <!-- Buttons on the Right -->
                <div class="gap-2 col-md-auto d-flex">
                    <!-- Export to PDF Button -->

                    <!-- Create New Report Button -->



                    <!-- Button to open the modal for creating a new report -->
                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#createReportModal">
                        New Report
                    </button>

                </div>

            </form>


                <!-- Modal for Creating Report -->
                <div class="modal fade" id="createReportModal" tabindex="-1" aria-labelledby="createReportModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="createReportModalLabel">Create New Report Incident</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('report_incidents.store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row g-3">
                                        <!-- Student Number and Age on the same line -->
                                        <div class="col-md-6">
                                            <label for="student_number" class="form-label">Student Number</label>
                                            <input type="number" class="form-control" id="student_number" name="student_number" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="age" class="form-label">Age</label>
                                            <input type="number" class="form-control" id="age" name="age" required>
                                        </div>

                                        <!-- Report Date and Category on the same line -->
                                        <div class="col-md-6">
                                            <label for="report_date" class="form-label">Report Date</label>
                                            <input type="date" class="form-control" id="report_date" name="report_date" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="category" class="form-label">Category</label>
                                            <select class="form-control" id="category" name="category" required>
                                                <option value="">Select Category</option>
                                                <option value="Physical">Physical</option>
                                                <option value="Verbal">Verbal</option>
                                                <option value="Cyberbullying">Cyberbullying</option>
                                                <option value="Social">Social</option>
                                                <option value="Other">Other</option>
                                            </select>
                                        </div>

                                        <!-- Description and Location on the same line -->
                                        <div class="col-md-6">
                                            <label for="description" class="form-label">Description</label>
                                            <textarea class="form-control" id="description" name="description" required></textarea>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="location" class="form-label">Location</label>
                                            <input type="text" class="form-control" id="location" name="location" required>
                                        </div>

                                        <!-- Person Involved and Evidence on the same line -->
                                        <div class="col-md-6">
                                            <label for="person_involved" class="form-label">Person Involved</label>
                                            <input type="text" class="form-control" id="person_involved" name="person_involved" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="evidence" class="form-label">Evidence (Photo or Video)</label>
                                            <input type="file" class="form-control" id="evidence" name="evidence" accept="image/*,video/*">
                                            @error('evidence')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <!-- Status -->

                                    </div>
                                    <button type="submit" class="mt-4 btn btn-success">Submit Report</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            <!-- Reports Listing -->
            <div class="row">
                <div class="col-12">
                    @if ($reports->isEmpty())
                        <div class="text-center alert alert-info">No reports available.</div>
                    @else
                        <div class="table-responsive">
                            <table class="table text-center align-middle table-striped">
                                <thead class="table-light">
                                    <tr>
                                        <th class="align-middle fw-normal" style="width: 5%;">ID</th>
                <th class="align-middle fw-normal" style="width: 10%;">Student Number</th>
                <th class="align-middle fw-normal" style="width: 5%;">Age</th>
                <th class="align-middle fw-normal" style="width: 10%;">Report Date</th>
                <th class="align-middle fw-normal" style="width: 10%;">Category</th>
                <th class="align-middle fw-normal" style="width: 15%;">Description</th>
                <th class="align-middle fw-normal" style="width: 10%;">Location</th>

                <th class="align-middle fw-normal" style="width: 12%;">Person Involved</th>
                <th class="align-middle fw-normal" style="width: 10%;">Evidence</th>
                <th class="align-middle fw-normal" style="width: 10%;">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($reports as $report)
                                        <tr>
                                            <td>{{ $report->id }}</td>
                                            <td>{{ $report->student_number }}</td>
                                            <td>{{ $report->age }}</td>
                                            <td>{{ $report->report_date }}</td>
                                            <td>{{ $report->category }}</td>
                                            <td>{{ $report->description }}</td>
                                            <td>{{ $report->location }}</td>

                                            <td>{{ $report->person_involved }}</td>
                                            <td class="text-center">
                                                @if ($report->evidence)
                                                @php
                                                    $fileExtension = strtolower(pathinfo($report->evidence, PATHINFO_EXTENSION));
                                                @endphp

                                                @if (in_array($fileExtension, ['jpeg', 'png', 'jpg', 'gif']))
                                                    <img src="{{ asset('storage/' . $report->evidence) }}"
                                                         alt="Evidence Image"
                                                         class="rounded img-thumbnail"
                                                         style="max-width: 60px;">
                                                @elseif (in_array($fileExtension, ['mp4', 'avi', 'mov', 'webm', 'mkv']))
                                                    <a href="{{ asset('storage/' . $report->evidence) }}"
                                                       target="_blank"
                                                       class="btn btn-sm btn-primary">
                                                        <i class="bi bi-eye"></i>
                                                    </a>
                                                @else
                                                    <a href="{{ asset('storage/' . $report->evidence) }}"
                                                       target="_blank"
                                                       class="btn btn-sm btn-info">
                                                        <i class="bi bi-file-earmark"></i>
                                                    </a>
                                                @endif
                                            @else
                                                <span class="text-muted">No Evidence</span>
                                            @endif


                                            </td>

                                            <td>
                                                <div class="gap-2 d-flex justify-content-center">
                                                    <!-- Archive Button -->

                                                    <!-- Edit Button -->
                                                    <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#editReportModal-{{ $report->id }}">
                                                        <i class="bi bi-pencil fs-5"></i>
                                                    </button>



                                                    <!-- Archive Button -->
                                                    <form action="{{ route('report_incidents.archive', $report->id) }}" method="POST">
                                                        @csrf
                                                        <button type="submit" class="btn btn-danger">
                                                            <i class="bi bi-archive"></i>
                                                        </button>
                                                    </form>

                                                <!-- Edit Report Modal -->
                                                <div class="modal fade" id="editReportModal-{{ $report->id }}" tabindex="-1" aria-labelledby="editReportModalLabel-{{ $report->id }}" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="editReportModalLabel-{{ $report->id }}">Edit Incident Report</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <!-- Form to Edit the Report -->
                                                                <form action="{{ route('report_incidents.update', $report->id) }}" method="POST" enctype="multipart/form-data">
                                                                    @csrf
                                                                    @method('PUT')

                                                                        <!-- Student Number -->
                                                                        <div class="row g-3">
                                                                            <!-- Student Number and Age on the same line -->
                                                                            <div class="col-md-6">
                                                                                <label for="student_number" class="form-label">Student Number</label>
                                                                                <input type="number" class="form-control" id="student_number" name="student_number" required>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <label for="age" class="form-label">Age</label>
                                                                                <input type="number" class="form-control" id="age" name="age" required>
                                                                            </div>

                                                                            <!-- Report Date and Category on the same line -->
                                                                            <div class="col-md-6">
                                                                                <label for="report_date" class="form-label">Report Date</label>
                                                                                <input type="date" class="form-control" id="report_date" name="report_date" required>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <label for="category" class="form-label">Category</label>
                                                                                <select class="form-control" id="category" name="category" required>
                                                                                    <option value="">Select Category</option>
                                                                                    <option value="Physical">Physical</option>
                                                                                    <option value="Verbal">Verbal</option>
                                                                                    <option value="Cyberbullying">Cyberbullying</option>
                                                                                    <option value="Social">Social</option>
                                                                                    <option value="Other">Other</option>
                                                                                </select>
                                                                            </div>

                                                                            <!-- Description and Location on the same line -->
                                                                            <div class="col-md-6">
                                                                                <label for="description" class="form-label">Description</label>
                                                                                <textarea class="form-control" id="description" name="description" required></textarea>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <label for="location" class="form-label">Location</label>
                                                                                <input type="text" class="form-control" id="location" name="location" required>
                                                                            </div>

                                                                            <!-- Person Involved and Evidence on the same line -->
                                                                            <div class="col-md-6">
                                                                                <label for="person_involved" class="form-label">Person Involved</label>
                                                                                <input type="text" class="form-control" id="person_involved" name="person_involved" required>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <label for="evidence" class="form-label">Evidence (Photo or Video)</label>
                                                                                <input type="file" class="form-control" id="evidence" name="evidence" accept="image/*,video/*">
                                                                                @error('evidence')
                                                                                    <div class="text-danger">{{ $message }}</div>
                                                                                @enderror
                                                                            </div>

                                                                    <!-- Submit Buttons -->
                                                                    <div class="gap-2 d-flex justify-content-end">
                                                                        <button type="submit" class="btn btn-success">Update Report</button>
                                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                                    </div>

                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>




                                            </td>
                                                <!-- Delete Button -->

                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="mt-4 d-flex justify-content-center">
            {{ $reports->links('pagination::bootstrap-5') }}
        </div>

        @endsection
