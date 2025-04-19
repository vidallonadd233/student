    @include('landing.letter')

    @extends('layout.jam')

    @section('title', 'Calendar Archive')

    @section('content')

    <div class="container">
        <h1 class="text-center fs-3 fw-normal">Schedule</h1>

        @if($archivedSchedules->isEmpty())
            <p>No schedules available.</p>
        @else
            <div class="table-responsive">
                <table class="table table-hover fw-normal">
                    <thead class="fw-normal">
                        <tr>
                            <th class="fw-normal">Student</th>
                            <th class="fw-normal">Grade</th>
                            <th class="fw-normal">Age</th>
                            <th class="fw-normal">Date</th>
                            <th class="fw-normal">Time</th>
                            <th class="fw-normal">Gender</th>
                            <th class="fw-normal">Description</th>
                            <th class="fw-normal">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($archivedSchedules as $schedule)
                            <tr>
                                <td>{{ $schedule->student_number }}</td>
                                <td>{{ $schedule->grade_level }}</td>
                                <td>{{ $schedule->age }}</td>
                                <td>{{ $schedule->date }}</td>
                                <td>{{ $schedule->time }}</td>
                                <td>{{ $schedule->gender }}</td>
                                <td>{{ $schedule->description }}</td>
                                <td>
                                    <form action="{{ route('admin.restore-calendar', $schedule->id) }}" method="POST" class="d-inline">
                                        @csrf

                                        <button type="submit" class="btn btn-success btn-sm" title="Restore">
                                            <i class="bi bi-arrow-counterclockwise fs-5"></i>
                                        </button>
                                    </form>

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>

    <div class="mt-3 d-flex justify-content-center">
        {{ $archivedSchedules->links('pagination::bootstrap-5') }}
    </div>
    @endsection
