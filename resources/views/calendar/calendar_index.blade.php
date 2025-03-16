@include('landing.letter')

@extends('layout.jam')

@section('title', 'Incident Reports')

@section('content')




<div class="d-flex me-2" style="border-radius: 20%;">
    <a href="{{ route('admin.calendar.pdf') }}" class="btn btn-success" target="_blank">
        <i class="bi bi-file-earmark-pdf"></i>
    </a>
</div>




<div class="container">
    <h1 class="text-center fs-3 fw-normal">Schedule</h1>

    @if($schedule->isEmpty())
        <p>No schedules available.</p>
    @else
        <table class="table table-hover fw-normal">
            <thead class="fw-normal">
                <tr>
                    <th class="fw-normal">Student_number</th>
                    <th class="fw-normal">Grade_level</th>
                    <th  class="fw-normal" >Age</th>
                    <th class="fw-normal"   >Date</th>
                    <th class="fw-normal"   >Time</th>
                    <th  class="fw-normal"  >Gender</th>
                    <th class="fw-normal"   >Description</th>
                    <th  class="fw-normal" >Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($schedule as $schedule)
                    <tr>
                        <td>{{ $schedule->student_number }}</td>
                        <td>{{ $schedule->grade_level }}</td>
                        <td>{{ $schedule->age }}</td>
                        <td>{{ $schedule->date }}</td>
                        <td>{{ $schedule->time }}</td>
                        <td>{{ $schedule->gender }}</td>
                        <td>{{ $schedule->description }}</td>
                        <td>
                            <!-- Delete Form -->
                            <a href="{{ route('admin.calendar.edit', $schedule->id) }}" class="btn btn-success btn-sm"><i class="bi bi-pencil-square"></i></a>
                            <form action="{{ route('calendar.archive', $schedule->id) }}" method="POST" style="display: inline;">
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
    @endif
</div>

@endsection
