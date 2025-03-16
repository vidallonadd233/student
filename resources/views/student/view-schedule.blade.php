@extends('layouts.app')

@section('title', 'Incident Reports') <!-- Override title for this page -->

@section('content') <!-- Page-specific content -->





<div class="container">
    <h2>My Schedule</h2>

    @if ($schedules->isEmpty())
        <p>No schedules available.</p>
    @else
    <table class="table">
        <thead>
            <tr>
                <th>Grade Level</th>
                <th>Age</th>
                <th>Gender</th>
                <th>Date</th>
                <th>Time</th>
                <th>Description</th>
            </tr>
        </thead>
        <tbody>
            @foreach($schedules as $schedule)
                <tr>
                    <td>{{ $schedule->grade_level }}</td>
                    <td>{{ $schedule->age }}</td>
                    <td>{{ $schedule->gender }}</td>
                    <td>{{ $schedule->date }}</td>
                    <td>{{ $schedule->time }}</td>
                    <td>{{ $schedule->description }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>








@endsection
