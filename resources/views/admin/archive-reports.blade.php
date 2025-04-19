@extends('layout.jam')

@section('title', 'Archived Reports')

@section('content')

<div class="container">
    <h1 class="text-center fs-3 fw-normal">Archived Reports</h1>

    @if(session('toast_success'))
    Swal.fire({
        icon: 'success',
        title: 'Success!',
        text: "{{ session('toast_success') }}",
        timer: 3000,
        showConfirmButton: false,
        toast: true,
        position: 'top-end'
    });
@endif
    @if($archivedReports->isEmpty())
        <p class="text-center">This report page is private page.</p>
    @else
        <table class="table table-hover fw-normal">
            <thead class="fw-normal">
                <tr>
                    <th class="fw-normal">ID</th>
                    <th class="fw-normal">Student Number</th>
                    <th class="fw-normal">Age</th>
                    <th class="fw-normal">Report Date</th>
                    <th class="fw-normal">Category</th>
                    <th class="fw-normal">Status</th>
                    <th class="fw-normal">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($archivedReports as $report)
                    <tr>
                        <td>{{ $report->id }}</td>
                        <td>{{ $report->student_number }}</td>
                        <td>{{ $report->age }}</td>
                        <td>{{ $report->report_date }}</td>
                        <td>{{ $report->category }}</td>
                        <td>{{ $report->status }}</td>
                        <td>
                            <!-- Restore Button -->
                            <form action="{{ route('admin.restore-report', $report->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="btn btn-success w-25" title="Restore">
                                    <i class="bi bi-arrow-counterclockwise fs-6"></i>
                                </button>
                            </form>

                            <!-- Delete Permanently Button -->

                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>

@endsection
