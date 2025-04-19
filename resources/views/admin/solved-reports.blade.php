@extends('layout.jam')

@section('title', 'Solved Cases')

@section('content')

<div class="container my-4 ">

    <script>
        @if(Session::has('success'))
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: "{{ Session::get('success') }}",
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000
            });
        @endif

        @if(Session::has('error'))
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: "{{ Session::get('error') }}",
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000
            });
        @endif
    </script>



    <h2 class="mb-4 text-center mt-3 fs-5">Solved Cases</h2>

    <div class="table-responsive">
            <table class="table table-striped fw-normal  m-3">
                <thead class="thead-dark">
                    <tr>
                        <th class="text-center fw-normal">ID</th>
                        <th class="text-center fw-normal">Student Number</th>
                        <th class="text-center fw-normal">Age</th>
                        <th class="text-center fw-normal">Report Date</th>
                        <th class="text-center fw-normal">Category</th>
                        <th class="text-center fw-normal">Description</th>
                        <th class="text-center fw-normal">Location</th>
                        <th class="text-center fw-normal">Person Involved</th>
                        <th class="text-center fw-normal">Remark</th>
                        <th class="text-center fw-normal">Evidence</th>
                        <th class="text-center fw-normal">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($solvedReports as $report)
                        <tr>

                            <td>{{ $report->id }}</td>
                            <td class="text-center">{{ $report->student_number }}</td>
                            <td class="text-center">{{ $report->age }}</td>
                            <td class="text-center">{{ $report->report_date }}</td>
                            <td class="text-center">{{ $report->category }}</td>
                            <td class="text-center">{{ $report->description }}</td>
                            <td class="text-center">{{ $report->location }}</td>
                            <td class="text-center">{{ $report->remark }}</td>
                            <td class="text-center">{{ $report->person_involved }}</td>
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
                                        class="btn btn-sm btn-success">
                                            <i class="bi bi-eye"></i> View Video
                                        </a>
                                    @else
                                        <a href="{{ Storage::url($report->evidence) }}"
                                        target="_blank"
                                        class="btn btn-sm btn-info">
                                            <i class="bi bi-file-earmark"></i> View File
                                        </a>
                                    @endif
                                @else
                                    <span class="text-muted">No Evidence</span>
                                @endif
                            </td>

                            <td>
                                <!-- Archive Button -->
                                <form action="{{ route('admin.archive-report', $report->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="btn btn-warning btn-sm" data-bs-toggle="tooltip" title="Archive">
                                        <i class="bi bi-archive fs-5"></i>
                                    </button>
                                </form>

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
    </div>

    <!-- Pagination -->
    <div class="d-flex justify-content-center mt-3">
        {{ $solvedReports->links() }}
    </div>
</div>

@endsection
