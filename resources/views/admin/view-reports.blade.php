@extends('layout.jam')

@section('title', 'Incident Reports')

@section('content')
<div class="container">
    <h1 class="fw-normal fs-4">View and Monitor Students</h1>

    <!-- Search and Filter Form -->
    <form action="{{ route('admin.viewReports') }}" method="GET" class="mb-4">
        <div class="col-md-6">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Search by ID or Student Number..." value="{{ request('search') }}">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-search"></i>
                </button>
            </div>
        </div>

        </div>
    </form>

    <!-- Table Section -->
    <div class="table-responsive">
        <table class="table table-striped fw-normal">
            <thead class="thead-dark">
                <tr>
                    <th class="text-center fw-normal">Student Number</th>
                    <th class="text-center fw-normal">Age</th>
                    <th class="text-center fw-normal">Report Date</th>
                    <th class="text-center fw-normal">Category</th>
                    <th class="text-center fw-normal">Description</th>
                    <th class="text-center fw-normal">Location</th>
                    <th class="text-center fw-normal">Status</th>
                    <th class="text-center fw-normal">Person Involved</th>
                    <th class="text-center fw-normal">Evidence</th>
                    <th class="text-center fw-normal">Action</th>


                </tr>
            </thead>
            <tbody>
                @forelse($students as $report)
                    <tr>
                        <td class="text-center">{{ $report->student_number }}</td>
                        <td class="text-center">{{ $report->age }}</td>
                        <td class="text-center">{{ $report->report_date }}</td>
                        <td class="text-center">{{ $report->category }}</td>
                        <td>{{ $report->description }}</td>
                        <td>{{ $report->location }}</td>
                        <td class="text-center">
                            <!-- Button to Open the Modal with an Icon -->
                            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#updateStatusModal">
                                <i class="bi bi-pencil-square"></i>
                            </button>

                            <!-- The Modal -->
                            <div class="modal fade" id="updateStatusModal" tabindex="-1" aria-labelledby="updateStatusModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="updateStatusModalLabel">Update Status</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('admin.updateStatus', $report->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="mb-3">
                                                    <label for="status" class="form-label">Status</label>
                                                    <select name="status" class="form-control" required>
                                                        <option value="Unsolved" {{ $report->status === 'Unsolved' ? 'selected' : '' }}>Unsolved</option>
                                                        <option value="Solved" {{ $report->status === 'Solved' ? 'selected' : '' }}>Solved</option>
                                                    </select>
                                                </div>
                                                <button type="submit" class="btn btn-primary">Update</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td class="text-center">{{ $report->person_involved }}</td>
                        <td class="text-center">
                            @if ($report->evidence)
                                @php
                                    $fileExtension = strtolower(pathinfo($report->evidence, PATHINFO_EXTENSION));
                                @endphp
                                @if (in_array($fileExtension, ['jpeg', 'png', 'jpg', 'gif']))
                                    <img src="{{ asset('storage/' . $report->evidence) }}" alt="Evidence Image" class="rounded img-thumbnail" style="max-width: 60px;">
                                @elseif (in_array($fileExtension, ['mp4', 'avi', 'mov', 'webm', 'mkv']))
                                    <a href="{{ asset('storage/' . $report->evidence) }}" target="_blank" class="btn btn-sm btn-success">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                @else
                                    <a href="{{ Storage::url($report->evidence) }}" target="_blank" class="btn btn-sm btn-info">
                                        <i class="bi bi-file-earmark"></i>
                                    </a>
                                @endif
                            @else
                                <span class="text-muted">No Evidence</span>
                            @endif
                        </td>



                        <td>
                            <form action="{{ route('admin.archive-report', $report->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="btn btn-warning btn-sm" data-bs-toggle="tooltip" title="Archive">
                                    <i class="bi bi-archive fs-5"></i>
                                </button>
                            </form>




                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="11" class="text-center">No students found</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <script>
        document.getElementById('search').addEventListener('keyup', function () {
            let searchValue = this.value.toLowerCase();
            let rows = document.querySelectorAll('#reportTable tr');

            rows.forEach(row => {
                let name = row.querySelector('.name').textContent.toLowerCase();
                let studentNumber = row.querySelector('.student_number').textContent.toLowerCase();

                if (name.includes(searchValue) || studentNumber.includes(searchValue)) {
                    row.style.display = '';
                } else {
                    row.style.display  = 'none';
                }
            });
        });
        </script>


    <!-- Pagination Links -->
    <div class="mt-4 d-flex justify-content-center">
        {{ $students->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection
