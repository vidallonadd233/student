@extends('layouts.app')

@section('content')
<h1>Archived Reports</h1>

@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if ($reports->isEmpty())
    <p>No archived reports found.</p>
@else
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Student Number</th>
                <th>Category</th>
                <th>Report Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($reports as $report)
                <tr>
                    <td>{{ $report->id }}</td>
                    <td>{{ $report->student_number }}</td>
                    <td>{{ $report->category }}</td>
                    <td>{{ $report->report_date }}</td>
                    <td>
                        <form action="{{ route('report_incidents.restore', $report->id) }}" method="POST">
                            @csrf
                            <button type="submit">Restore</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $reports->links() }}
@endif
@endsection
