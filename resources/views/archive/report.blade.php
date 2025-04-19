    @include('landing.letter')

    @extends('layouts.app')

    @section('title', 'Archived Reports')

    @section('content')
    <div class="container mt-5 ">


        @if (session('success'))
        <div class="alert alert-success text-center mx-auto w-50">
                {{ session('success') }}
            </div>
        @endif

        @if ($reports->isEmpty())
            <p class="text-center">This archived page is private page .</p>
        @else
            <form action="{{ route('report_incidents.index') }}" method="GET" class="mt-2 mb-4 row g-3 align-items-center">
                <div class="col-md-6">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control" placeholder="Search by ID or Student Number..." value="{{ request('search') }}">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-search"></i>
                        </button>
                    </div>
                </div>

                <!-- Buttons on the Right -->

            </form>

            <!-- Responsive Table -->
            <div class="mt-4 table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th class="align-middle fw-normal">ID</th>
                            <th class="align-middle fw-normal">Student No.</th>
                            <th class="align-middle fw-normal">Age</th>
                            <th class="align-middle fw-normal">Date</th>
                            <th class="align-middle fw-normal">Category</th>
                            <th class="align-middle fw-normal">Description</th>
                            <th class="align-middle fw-normal">Location</th>

                            <th class="align-middle fw-normal">Person Involved</th>
                            <th class="align-middle fw-normal">Evidence</th>
                            <th class="align-middle fw-normal">Actions</th>
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
                                <td class="text-truncate" style="max-width: 150px;">{{ $report->description }}</td>
                                <td>{{ $report->location }}</td>

                                <td>{{ $report->person_involved }}</td>
                                <td>
                                    @if ($report->evidence)
                                        @php
                                            $fileExtension = strtolower(pathinfo($report->evidence, PATHINFO_EXTENSION));
                                        @endphp

                                        @if (in_array($fileExtension, ['jpeg', 'png', 'jpg', 'gif']))
                                            <img src="{{ asset('storage/' . $report->evidence) }}" alt="Evidence Image" class="rounded img-thumbnail" style="max-width: 50px;">
                                        @elseif (in_array($fileExtension, ['mp4', 'avi', 'mov', 'webm', 'mkv']))
                                            <a href="{{ asset('storage/' . $report->evidence) }}" target="_blank" class="btn btn-sm btn-primary">View Video</a>
                                        @else
                                            <a href="{{ Storage::url($report->evidence) }}" target="_blank" class="btn btn-sm btn-info">View File</a>
                                        @endif
                                    @else
                                        <span class="text-muted">No Evidence</span>
                                    @endif
                                </td>
                                <td class="flex-wrap gap-2 d-flex">
                                    <!-- Restore button -->
                                    <form action="{{ route('report_incidents.restore', $report->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-warning btn-sm">
                                            <i class="bi bi-arrow-clockwise"></i>
                                        </button>
                                    </form>

                                    <!-- Delete button -->

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination links -->
            <div class="mt-4 d-flex justify-content-center">
                {{ $reports->links('pagination::bootstrap-5') }}
            </div>
        @endif
    </div>
    @endsection
